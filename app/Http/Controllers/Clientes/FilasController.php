<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use JWTAuth;
use App\Http\Requests\Validators\FilasValidator;
use App\Events\Filas\FilaModificada;
use App\Models\Filas;
use DB;
use App\Http\Controllers\Controller;

class FilasController extends Controller
{
    function __construct(Filas $filas){
        $this->entity = $filas;
    }

    public function store(FilasValidator $request){

        try{
            $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;

            $linhas_coll = collect($request->linhas);
            $linhas_to_attach = $linhas_coll->mapWithKeys(function($linha_id, $index){
                                                return [$linha_id => ['posicao'=>$index]];
                                              });

           
            DB::beginTransaction();

            $fila = $assinante->filas()->create(["nome"=>$request->nome,
                                                 "tipo"=>$request->tipo,
                                                 "tempo_chamada"=>$request->tempo_chamada,
                                                 "regra_transbordo"=>$request->regra_transbordo
                                                ]);

            $fila->linhas()->attach($linhas_to_attach);

            //event( new FilaModificada() );
            
            DB::commit();

            return response('', 200);

        } catch (\Exception $e){
            DB::rollback();
            return response('', 500);
        }
    }

    public function update(FilasValidator $request){

        try{

            $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;

            $fila = $assinante->filas()->find($request->f);

            $linhas_coll = collect($request->linhas);
            $linhas_to_attach = $linhas_coll->mapWithKeys(function($linha_id, $index){
                                                return [$linha_id => ['posicao'=>$index]];
                                              });

            DB::beginTransaction();
            
            $fila->update(["nome"=>$request->nome,
                           "tipo"=>$request->tipo,
                           "tempo_chamada"=>$request->tempo_chamada,
                           "regra_transbordo"=>$request->regra_transbordo
                          ]);
 
            $fila->linhas()->sync($linhas_to_attach);

            //event( new FilaModificada() );
          
            DB::commit();

            return response("", 200);

        } catch (\Exception $e){
            DB::rollback();
            dd($e);
            return response('', 500);
        }
    }

    public function destroy(Request $request){
        try{
            
            $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
            $fila = $assinante->filas()->find($request->id);
            $fila->delete();
            //event( new FilaModificada() );
            
            return response('', 200);
        } catch (\Exception $e){
            return response('', 500);
        }
    }

    public function get(Request $request){
        try{
            
            $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
            $fila = $assinante->filas()->with(['linhas'=>function($query){
                                                $query->select("id");
                                             }])
                                      ->find($request->f);

            $fila_arr = $fila->toArray();
            $fila_arr['ids_linhas'] = $fila->linhas->pluck("id")->toArray();
            unset($fila_arr['linhas']);

            return response()->json(["fila"=>$fila_arr], 200);
            
        } catch (\Exception $e){
            return response('', 500);
        }
    }
}
