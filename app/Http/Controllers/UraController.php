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
       //$ura_relation = $assinante->ura();

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

       }
       
       try{

          DB::transaction(function() use ($audio_novo, $ura, $audio_importado){
                 
                 if(isset($audio_importado)){
                    $audio_novo->save();
                    $ura->audio_id = $audio_novo->id;
                    $this->moveAudio($audio_importado, $audio_novo);
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


    public function moveAudio($audio_importado, $audio){
        $audio_movido = $audio_importado->move(storage_path('audios_ura'), $audio->nome.".".$audio->extensao);

        $astk_audio_path = config('asterisk.audios_path');
        
        if(!file_exists($astk_audio_path)){
           mkdir($astk_audio_path);
        }

        symlink($audio_movido->getPathName(), $astk_audio_path.'/'.$audio->nome.".".$audio->extensao);
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
