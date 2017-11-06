<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Controllers\Controller;
use DB;
use App\Models\GruposAtendimento;
use App\Http\Requests\Validators\GruposAtendimentoRequest;

class GruposAtendimentoController extends Controller
{   
    function __construct(GruposAtendimento $grps){
        $this->entity = $grps;
    }

    public function store(GruposAtendimentoRequest $request){
        
        try{
            $assinante = JWTAuth::toUser($request->cookie("token"))
                                  ->assinante;

        	  DB::beginTransaction();

            $grupo = $assinante->grupos()->create([
        								 "tipo"=>$request->tipo,
        								 "nome"=>$request->nome,
                         "tempo_chamada"=>$request->tempo_chamada
        								]);
            
            if($request->linhas == null){
                $request->linhas = [];
            }

            $linhas_grupos = [];
            foreach($request->linhas as $key=>$linha){
                $linhas_grupos[$linha] = ['posicao'=>$key+1];
            }

            $grupo->linhas()->attach($linhas_grupos);
            DB::commit();
            /*foreach($request->linhas as $key=>$md5_id){
                $linha = $assinante->linhas()->where(DB::Raw('MD5(id)'), $md5_id)->first();

                \App\Models\GruposLinhas::create([
                        'linha_id'=>$linha->id,
                        'grupo_id'=>$grupo->id,
                        'posicao'=>$key
                    ]);
            }*/

      } catch(\Exception $e){
        dd($e);
        DB::rollback();
        return response('', 500);
      }

    }

    public function update(GruposAtendimentoRequest $request){
        try{
         
          $assinante = JWTAuth::toUser($request->cookie("token"))
                                  ->assinante;
        

          $grupo = $assinante->grupos()->find($request->g);

          DB::beginTransaction();

          $grupo->update([
                          "tipo"=>$request->tipo,
                          "nome"=>$request->nome,
                          "tempo_chamada"=>$request->tempo_chamada
                          ]);

          
          $linhas_grupos = [];
          foreach($request->linhas as $key=>$linha){
              $linhas_grupos[$linha] = ['posicao'=>$key+1];
          }

          $grupo->linhas()->sync($linhas_grupos);

          DB::commit();

          return response('', 200);
        } catch(\Exception $e){
           DB::rollback();
           return response('', 500);
        }

        return redirect()->route('rvc.grupos_atendimento.index');
    }

    public function destroy(Request $request){
        try{
         
          $grupo = $this->entity->find($request->id);
          $grupo->delete();
          return response('', 200);
        
        } catch(\Exception $e){
          return response('', 500);
        }
    }

    public function get(Request $request){
       try{
         
         $assinante = JWTAuth::toUser($request->cookie("token"))
                                  ->assinante;
         
         $grupo = $assinante->grupos()
                             ->with(['linhas'=>function($query){
                                    $query->select('linhas.id');
                               }])
                             ->where('id', $request->g)
                             ->first();

         $grupo->ids_linhas = $grupo->linhas->pluck('id');

         return response()->json(['grupo'=>$grupo], 200);
       } catch(\Exception $e){
         return response('', 500);
       }
      



    }

    /*
    public function edit(Request $request){
        $assinante = Auth::user()->assinante;

        $grupo =  $assinante->grupos()->with(['linhas'=>function($query){
                                                        $query->select("nome");
                                                        $query->withIdMd5();
                                                    }])
                                                    ->withIdMd5()
                                                    ->where(DB::raw('MD5(grupos_atendimento.id)'), $request->id)
                                                    ->first();

        $linhas_sem_grupo = $assinante->linhas()
                                      ->withCount("grupo")
                                      ->withIdMd5()
                                      ->get()
                                      ->where("grupo_count", "=", 0);

        return view('rvc.grupos_atendimento.edit', ["grupo"=>$grupo,
                                                    "linhas_added"=>$grupo->linhas,
                                                    "linhas"=>$linhas_sem_grupo]);
    }
*/
/*
    public function getGruposOf($id){

      if(Auth::user()->role == 0){
         $grupos = \App\Models\Assinantes\Assinantes::whereRaw("MD5(id) = '".$id."'")->first()
                                                    ->grupos()
                                                    ->select('id', 'nome')
                                                    ->withIdMd5()
                                                    ->get();
         return json_encode($grupos);
      }
     

    }*/
}
