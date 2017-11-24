<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\Models\Uras;
use App\Models\Audios;
use JWTAuth;
use App\Http\Requests\Validators\UraRequest;
use DB;
use App\Events\UraAtualizada;
use App\Http\Controllers\Controller;

class UrasController extends Controller
{
    function __construct(Uras $ura){
        $this->entity = $ura;
    }

    public function store(UraRequest $request){
       $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;

       try{

          $ura = new Uras($this->formRequestToArray($request));
          $ura->assinante_id = $assinante->id;
          $audio_importado = $request->file("arquivo_audio");

          DB::beginTransaction();

          $audio_assoc_arr = $this->getAudioData($audio_importado);

          $audio = new Audios();
          $audio->fill($audio_assoc_arr);
          $audio->assinante_id = $ura->assinante_id;

          $audio->save();
          $this->convertAndMoveAudio($audio_importado, $audio);

          $ura->audio_id = $audio->id;
          $ura->save();

          DB::commit();

       } catch (\Exception $e){

        DB::rollback();
        return response('', 500);

       }
  
    }

    public function update(UraRequest $request){
      $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
     //$dados_transaction = array();
    
      try{
         //como o usuário só pode ter uma ura, pega a primeira ou cria uma nova
         $ura = $assinante->uras()->first() ?: new Uras();
         
         $ura->fill($this->formRequestToArray($request));
         $ura->assinante_id = $assinante->id;

         $audio_importado = $request->file("arquivo_audio");

         $audio_antigo = $ura->audio()->first();
         
         DB::beginTransaction();
         /* 
          * Se o usuário inserir um novo áudio
          */
         if($audio_importado !== null){

           /*
            * Se já existia um áudio ligado a ura, deleta-o
            */
           if($audio_antigo !== null){
             /*Deleta os arquivos do áudio*/
             $caminho = pathinfo($audio_antigo->caminho);
             unlink($caminho['dirname']."/".$caminho['basename']);
               
             /*Deleta o link simbólico*/
             $asterisk_audio_path = config("asterisk.audios_path") . "/" . $caminho['basename'];
             unlink($asterisk_audio_path);

             $audio_antigo->delete();
           }

           //pega um array associativo com os dados do áudio
           //[nome_original, nome, caminho, extensao]
           $audio_assoc_arr = $this->getAudioData($audio_importado);

           $audio_novo = new Audios();
           $audio_novo->fill($audio_assoc_arr);
           $audio_novo->assinante_id = $ura->assinante_id;
         }
         
         if(isset($audio_novo)){
            $audio_novo->save();
            $ura->audio_id = $audio_novo->id;
            $this->convertAndMoveAudio($audio_importado, $audio_novo);
         } 
         
         $ura->save();

         DB::commit();

        return response('', 200);
      
       } catch (\Exception $e){

        DB::rollback();
        return response('', 500);

       }
    }

    /* Retorna os dados de uma ura*/
    public function get(Request $request){
      try{
        $ura = $this->entity->find($request->u);

        return response()->json($ura, 200);
      
      } catch (\Exception $e){
        return response('', 500);
      }
    }

    /*
    * Recebe a request e retorna os dados preparados
    * para serem passados para o método fill() do model Uras
    */
    public function formRequestToArray($request){
      return array(
                  'tipo_audio'=>"obrigatorio",
                  'nome'=>$request->nome,
                  'dig_0_destino'=>$request->get("digito_0"),
                  'dig_1_destino'=>$request->get("digito_1"),
                  'dig_2_destino'=>$request->get("digito_2"),
                  'dig_3_destino'=>$request->get("digito_3"),
                  'dig_4_destino'=>$request->get("digito_4"),
                  'dig_5_destino'=>$request->get("digito_5"),
                  'dig_6_destino'=>$request->get("digito_6"),
                  'dig_7_destino'=>$request->get("digito_7"),
                  'dig_8_destino'=>$request->get("digito_8"),
                  'dig_9_destino'=>$request->get("digito_9"),
                  'dig_asteristico_destino'=>$request->get("digito_ast"),
                  'dig_tralha_destino'=>$request->get("digito_tralha"));
    }


    public function getAudioData($audio_importado){

       $nome_original = $audio_importado->getClientOriginalName();
       $extensao = last(explode('.', $nome_original));
       $nome_novo_arquivo = md5($audio_importado->getFilename().time());
       $pasta_redirect = config('uras.pasta_redirect');

       return ["nome_original"=>$nome_original,
               "nome"=>$nome_novo_arquivo,
               "caminho"=> storage_path() . $pasta_redirect. '/' . $nome_novo_arquivo . '.' . $extensao,
               "extensao"=>$extensao
               ];
    }


    public function convertAndMoveAudio($audio_importado, $audio){
        $basename_audio = $audio->nome.".".$audio->extensao;
        $audio_movido = $audio_importado->move("/tmp/", $basename_audio);

        $astk_audio_path = config('asterisk.audios_path');
        
        if(!file_exists($astk_audio_path)){
           mkdir($astk_audio_path);
        }

        $lara_strg_path = storage_path().config('uras.pasta_redirect');
       
        if(!file_exists($lara_strg_path))
          mkdir($lara_strg_path);

        exec("sox "."/tmp/".$basename_audio." -r 8000 -c 1 -s ".$lara_strg_path."/".$basename_audio);

        unlink("/tmp/".$basename_audio);
        
        symlink($audio_movido->getPathName(), $astk_audio_path.'/'.$audio->nome.".wav");
    }

    public function getAudioBlob(Request $request){
        $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
        $audio = $assinante->uras()
                             ->find($request->u)
                             ->audio()
                             ->first();

        $headers = array('Content-Type'=>'audio/x-wav',
                         'Cache-Control'=>'no-cache');

        return response()->file($audio->caminho, $headers);
    }

    /*
    * Retorna as opções possíveis para aura
    */

    public function getOptions(Request $request){
   
        $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
        $ramais = $assinante->linhas()->select("nome", "id")->get();
        $filas = $assinante->filas()->select("nome", "id")->get();
        $grupos = $assinante->grupos()->select("nome", "id")->get();

        return response()->json([
                                  "ramais"=>$ramais,
                                  "filas"=>$filas,
                                  "grupos"=>$grupos
                                ], 200);
    }


    public function destroy(Request $request){
        try{
          $ura = $this->entity->find($request->id);
          $audio = $ura->audio()->first();

          DB::beginTransaction();
          /*Deleta os arquivos do áudio*/
          $caminho = pathinfo($audio->caminho);
          unlink($caminho['dirname']."/".$caminho['basename']);
               
          /*Deleta o link simbólico*/
          $asterisk_audio_path = config("asterisk.audios_path") . "/" . $caminho['basename'];
          unlink($asterisk_audio_path);

          $audio->delete();
          $ura->delete();

          DB::commit();

          return response('', 200);

        } catch (\Exception $e){
          DB::rollback();
          dd($e);
          return response('', 500);
        }
    }
}
