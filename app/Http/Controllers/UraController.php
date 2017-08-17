<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uras;
use App\Models\Audios;
use Auth;
use App\Http\Requests\Validators\UraUpdateValidator;
use DB;
use App\Events\UraAtualizada;

class UraController extends Controller
{
    function __construct(Uras $ura, Audios $audios){
        $this->entity = $ura;
        $this->audioEntity = $audios;
    }


    public function index(Request $request){
        $assinante = Auth::user()->assinante;
        $linhas = $assinante->linhas()->select("nome")->withIdMd5()->get();
        $grupos = $assinante->grupos()->select("nome")->withIdMd5()->get();
        $filas = $assinante->filas()->select("nome")->withIdMd5()->get();

        $ura = $assinante->ura()->with('audio')->first();
        
        $linhas = $linhas->mapWithKeys(function($linha){
          return [$linha->id_md5=>$linha->nome];
        });

        $grupos = $grupos->mapWithKeys(function($grupo){
          return [$grupo->id_md5=>$grupo->nome];
        });

        $filas = $filas->mapWithKeys(function($grupo){
          return [$grupo->id_md5=>$grupo->nome];
        });

        $select_opts = array();
        $ura_btns = ['0','1','2','3','4','5','6','7','8','9', 'tralha', 'asteristico'];
        
        if($ura !== null){
            foreach($ura_btns as $btn){
              
              if($ura->__get('dig_'.$btn.'_tipo') == 'ramal'){
                 $select_opts[$btn] = $linhas;
              } 
              
              else if($ura->__get('dig_'.$btn.'_tipo') == 'grupo'){
                 $select_opts[$btn] = $grupos;
              
              } else if($ura->__get('dig_'.$btn.'_tipo') == 'fila'){
                 $select_opts[$btn] = $filas;
              }
            }
        }
        
        return view("rvc.ura.index", ['active'=>'ura',
                                      'ura'=>$ura,
                                      'linhas_arr'=>$linhas,
                                      'select_opts'=>$select_opts,
                                      'panel_title'=>'Uras']);
    }
    

    public function create(Request $request){
    }


    public function store(Request $request){
    }


    public function update(UraUpdateValidator $request){

       $assinante = Auth::user()->assinante;
       $dados_transaction = array();
       //$ura_relation = $assinante->ura();
      try{
         if(($ura = $assinante->ura()->first()) !== null){
             $ura->fill($request->only($this->entity->getFillable()));

         } else {
            
             $ura = new $this->entity();
             $ura->fill($request->only($this->entity->getFillable()));
             $ura->assinante_id = $assinante->id;

         }

         //se houver audio na request
         if($request->hasFile('arquivo_audio')){
            $audio_importado = $request->file("arquivo_audio");

            /* Se houver um audio antigo, deleta-o */
            if(($audio_antigo = $ura->audio()->first()) !== null){
                
                $caminho = pathinfo($audio_antigo->caminho);
                unlink($caminho['dirname']."/".$caminho['basename']);
                
                /*link simbólico*/
                $asterisk_audio_path = config("asterisk.audios_path") . "/" . $caminho['basename'];
                unlink($asterisk_audio_path);
                /******/
                
                $audio_antigo->delete();

            } 

            $audio_assoc_arr = $this->getAudioData($audio_importado);

            $audio_novo = new Audios();
            $audio_novo->fill($audio_assoc_arr);
            $audio_novo->assinante_id = $ura->assinante_id;
     
            $dados_transaction['audio_novo'] = $audio_novo;
            $dados_transaction['audio_importado']=$audio_importado;
         }
         
         $dados_transaction['ura']= $ura;
       

            DB::transaction(function() use ($dados_transaction){
                   $ura = $dados_transaction['ura'];
                   
                   if(isset($dados_transaction['audio_importado'])){
                      $audio_novo = $dados_transaction['audio_novo'];
                      $audio_novo->save();
                      $ura->audio_id = $audio_novo->id;
                      $this->convertAndMoveAudio($dados_transaction['audio_importado'], $audio_novo);
                   }

                   $ura->save();

                   \App\Http\Controllers\SessionController::flashMessage('success',
                                                                         'Sucesso',
                                                                         'Ura atualizada com sucesso.');

                   //event(new UraAtualizada($assinante->id, $ura->id));

            });
                
       } catch (\Exception $e){
        dd($e);
        \App\Http\Controllers\SessionController::flashMessage('danger',
                                                               'Ops !',
                                                               'Um erro inesperado ocorreu, por favor, tente novamente.');

       }
        
        return redirect()->route('rvc.ura.index');
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

        exec("sox "."/tmp/".$basename_audio." -r 8000 -c 1 -s ".storage_path().config('uras.pasta_redirect')."/".$basename_audio);

        unlink("/tmp/".$basename_audio);
        
        symlink($audio_movido->getPathName(), $astk_audio_path.'/'.$audio->nome.".wav");
    }


    public function destroy(Request $request){  
    }


    public function getMine(Request $request){
        $ura = Auth::user()->assinante()->ura()->first();
        
        return json_encode($ura);
    }


    public function getAudioBlob($audio_id){
        
        $audio = Auth::user()->assinante
                             ->ura
                             ->audio()
                             ->whereRaw("MD5(id) = '".$audio_id."'")
                             ->first();

        $headers = array('Content-Type'=>'audio/x-wav');

        return response()->file($audio->caminho, $headers);
    }

    public function getUrasOf($id){
      $uras = \App\Models\Assinantes\Assinantes::whereRaw("MD5(id) = '".$id."'")->first()
                                                    ->ura()
                                                    ->select('id', 'nome')
                                                    ->withIdMd5()
                                                    ->get();
      return json_encode($uras);
    }
}
