<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audios;
use App\Models\Saudacoes;
use App\Http\Requests\Validators\SaudacoesValidator;
use DB;
use Auth;

class SaudacoesController extends Controller
{
    
    function __construct(Saudacoes $saud){
        $this->entity = $saud;
    }

    public function index(Request $request){
    	return view('rvc.saudacoes.index', ['active'=>'saudacoes', 'panel_title'=>"Saudações"]);
    }

    public function create(){
    	return view("rvc.saudacoes.create");
    }

    public function store(SaudacoesValidator $request){

      try{ 

            DB::transaction(function() use ($request){
                $assinante = Auth::User()->assinante;

                $audio = $assinante->audios()->create($this->getAudioData($request['arquivo_audio']));
                $this->moveAudio($request['arquivo_audio'], $audio);

                $assinante->saudacoes()->create([
                                                               'nome'=>$request->nome,
                                                               'tipo_audio'=>$request->tipo_audio,
                                                               'audio_id'=>$audio->id,
                                                               'ativo'=>$request->ativo
                                                             ]);
                
                \App\Http\Controllers\SessionController::flashMessage('success',
                                                                      'Sucesso',
                                                                      'Saudação criada com sucesso');
            });
            
            return redirect()->route('rvc.saudacoes.index');
            
        }  catch (Exception $e){

            \App\Http\Controllers\SessionController::flashMessage('danger',
                                                                    'Error',
                                                                    'Um erro inesperado ocorreu por favor tente novamente.');

            return redirect()->back()->withInput();
        }

    }

    public function update(SaudacoesValidator $request){
 
      try{

          DB::transaction(function() use ($request){
             
            $saudacao = $this->entity->whereRaw("MD5(id) = '".$request->s."'")->first();

            /** Melhorar exclusão de áudios, pois eu repeti o código em vários lugares diferentes
                Tanto aqui quanto na URAController
             **/

            if($request->hasFile("arquivo_audio")){
                   /* exclui arquivo de áudio antigo*/
                  $audio_antigo = $saudacao->audio;
                  $caminho = pathinfo($audio_antigo->caminho);
                  unlink($caminho['dirname']."/".$caminho['basename']);

                  //link symbolico
                  $asterisk_audio_path = config("asterisk.audios_path") . "/" . $caminho['basename'];
                  unlink($asterisk_audio_path);
                  /******/

                  $audio_novo = Auth::user()->assinante->audios()->create($this->getAudioData($request['arquivo_audio']));
                  $this->moveAudio($request['arquivo_audio'], $audio_novo);

                  $saudacao->audio_id = $audio_novo->id;
            }

            $saudacao->fill([
                             "nome"=>$request->nome,
                             "tipo_audio"=>$request->tipo_audio,
                             "ativo"=>$request->ativo,
                            ]);

            $saudacao->save();

            if($request->hasFile("arquivo_audio")){
              $audio_antigo->delete();
            }

            \App\Http\Controllers\SessionController::flashMessage('success',
                                                                  'Sucesso',
                                                                  'Saudação criada com sucesso');
            
          });

          return redirect()->route('rvc.saudacoes.index');

      } catch (Exception $e){

        \App\Http\Controllers\SessionController::flashMessage('danger',
                                                              'Error',
                                                              'Um erro inesperado ocorreu por favor tente novamente.');

        return redirect()->back()->withInput();
      }
    }

    public function edit(Request $request){
        $saudacao = $this->entity->whereRaw("MD5(id) = '".$request->id."'")->withIdMd5()->with("audio")->first();
      
        return view('rvc.saudacoes.edit', ['saudacao' => $saudacao]);
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

    public function moveAudio($audio_importado, $audio){
        if(!file_exists(storage_path('audios_saudacoes'))){
          mkdir(storage_path('audios_saudacoes'));
        }

        $audio_movido = $audio_importado->move(storage_path('audios_saudacoes'), $audio->nome.".".$audio->extensao);

        $astk_audio_path = config('asterisk.audios_path');
        
        if(!file_exists($astk_audio_path)){
           mkdir($astk_audio_path);
        }

        symlink($audio_movido->getPathName(), $astk_audio_path.'/'.$audio->nome.".".$audio->extensao);
    }

    public function destroy(Request $request){
        try{
          $saudacao = $this->entity->where(DB::raw('MD5(id)'), $request->id)->first();

          /* exclui arquivo de áudio antigo */
          $caminho = pathinfo($saudacao->audio->caminho);
          //unlink($caminho['dirname']."/".$caminho['basename']);

          /*link simbólico*/
          $asterisk_audio_path = config("asterisk.audios_path") . "/" . $caminho['basename'];
          //unlink($asterisk_audio_path);
         
          /******/

          $status = $saudacao->delete();
          
          return json_encode(['status'=>$status]);

        }  catch (\Exception $e){
          return json_encode(['status'=>0]);

        }
        
    }

    public function getMine(Request $request){
      $saudacoes = Auth::User()->assinante->saudacoes()->withIdMd5()->get();
      return json_encode($saudacoes);
    }

    public function getAudioBlob(Request $request){
      if($request->f !== null){
          $audio_model = Auth::user()->assinante->audios()->whereRaw("MD5(id) = '".$request->f."'")->first();
          $file = $audio_model->caminho;

          $headers = array('Content-Type'=>'audio/x-wav');

          return response()->file($file, $headers);
      }
    }
}
