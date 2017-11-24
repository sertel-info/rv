<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\Models\Audios;
use App\Models\Saudacoes;
use App\Http\Requests\Validators\SaudacoesRequest;
use DB;
use JWTAuth;
use App\Http\Controllers\Controller;

class SaudacoesController extends Controller
{
    
    function __construct(Saudacoes $saud){
        $this->entity = $saud;
    }

    public function store(SaudacoesRequest $request){

      try{ 
            $assinante = JWTAuth::toUser($request->cookie("token"))->assinante;

            DB::beginTransaction();
            
            $audio = $assinante->audios()
                               ->create(
                                  $this->getAudioData($request->file('arquivo_audio'))
                                );

            $this->convertAndMoveAudio($request['arquivo_audio'], $audio);

            $assinante->saudacoes()->create([
                                              'nome'=>$request->nome,
                                              'tipo_audio'=>$request->tipo_audio,
                                              'audio_id'=>$audio->id,
                                              'ativo'=>$request->ativo
                                            ]);
        
            DB::commit();

            return response('', 200);
            
        }  catch (Exception $e){
            DB::rollback();
            return responde('', 500);
        }

    }

    public function update(SaudacoesRequest $request){
 
      try{
            $assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
            $saudacao = $this->entity->find($request->s);

            /** Melhorar exclusão de áudios, pois eu repeti o código em vários lugares diferentes
                Tanto aqui quanto na URAController
             **/
            DB::beginTransaction();

            if($request->hasFile("arquivo_audio")){
                   /* exclui arquivo de áudio antigo*/
                  $audio_antigo = $saudacao->audio;
                  $caminho = pathinfo($audio_antigo->caminho);
                  unlink($caminho['dirname']."/".$caminho['basename']);

                  //link symbolico
                  $asterisk_audio_path = config("asterisk.audios_path") . "/" . $caminho['basename'];
                  unlink($asterisk_audio_path);
                  /******/

                  $audio_novo = $assinante->audios()
                                          ->create(
                                            $this->getAudioData($request->file('arquivo_audio'))
                                          );
                  $this->convertAndMoveAudio($request['arquivo_audio'], $audio_novo);

                  $saudacao->audio_id = $audio_novo->id;
            }

            $saudacao->fill([
                             "nome"=>$request->nome,
                             "tipo_audio"=>$request->tipo_audio,
                             "ativo"=>$request->ativo,
                            ]);

            $saudacao->save();
            if($request->hasFile("arquivo_audio"))
              $audio_antigo->delete();

            DB::commit();

           return response('', 200);

      } catch (Exception $e){
           DB::rollback();
           dd($e);
           return response('', 500);
      }
    }


    public function getAudioData($audio_importado){

       $nome_original = $audio_importado->getClientOriginalName();
       $extensao = last(explode('.', $nome_original));
       $nome_novo_arquivo = md5($audio_importado->getFilename().time());
       $pasta_redirect = config('saudacoes.redirect_path');

       return ["nome_original"=>$nome_original,
               "nome"=>$nome_novo_arquivo,
               "caminho"=> storage_path() . $pasta_redirect. '/' . $nome_novo_arquivo . '.' . $extensao,
               "extensao"=>$extensao
               ];
    }

    public function convertAndMoveAudio($audio_importado, $audio){
        if(!file_exists(storage_path('audios_saudacoes'))){
          mkdir(storage_path('audios_saudacoes'));
        }

        $basename_audio = $audio->nome.".".$audio->extensao;
        $audio_movido = $audio_importado->move("/tmp", $basename_audio);

        $astk_audio_path = config('asterisk.audios_path');
        
        if(!file_exists($astk_audio_path)){
           mkdir($astk_audio_path);
        }

        exec("sox "."/tmp/".$basename_audio." -r 8000 -c 1 -s ".storage_path('audios_saudacoes')."/".$basename_audio);
        symlink($audio_movido->getPathName(), $astk_audio_path.'/'.$audio->nome.".".$audio->extensao);
        unlink("/tmp/".$basename_audio);
    }

    public function destroy(Request $request){
        try{
          DB::beginTransaction();

          $saudacao = $this->entity->find($request->id);

          /* exclui arquivo de áudio antigo */
          $caminho = pathinfo($saudacao->audio->caminho);
          unlink($caminho['dirname']."/".$caminho['basename']);

          /*link simbólico*/
          $asterisk_audio_path = config("asterisk.audios_path") . "/" . $caminho['basename'];
          unlink($asterisk_audio_path);
          /******/


          $saudacao->delete();
          
          DB::commit();

          return response('', 200);

        }  catch (\Exception $e){
          DB::rollback();

          return response('', 500);
        }
        
    }

    public function getAudioBlob(Request $request){
      try{
          
          $assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
          $audio_model = $assinante->saudacoes->find($request->s)
                                               ->audio()->first();
          $file = $audio_model->caminho;

          $headers = array('Content-Type'=>'audio/x-wav');

          return response()->file($file, $headers);        
        
        } catch(\Exception $e){
    
          return response('', 500);
        }

    }

    public function get(Request $request){
       try{

          $saudacao = $this->entity->find($request->s);
          return response()->json($saudacao, 200);

       } catch(\Exception $e){
         return response('', 500);
       }
    }
}
