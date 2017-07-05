<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Validators\FilasValidator;
use App\Events\Filas\FilaModificada;
use App\Models\Filas;
use DB;

class FilasController extends Controller
{
    function __construct(Filas $filas){
        $this->entity = $filas;
    }

    public function index(Request $request){
    	return view("rvc.filas.index", ['active'=>'filas', 'panel_title'=>'Filas']);
    }

    public function create(Request $request){

    	$linhas = Auth::user()->assinante->linhas()
                                         ->withCount("grupo")
                                         ->withIdMd5()
                                         //->where('filas_count', '=', 0)
                                         ->get();
                                         

    	return view("rvc.filas.create", ['linhas'=>$linhas]);
    }

    public function store(FilasValidator $request){

        try{

            DB::transaction(function() use ($request){
                $assinante = Auth::user()->assinante;

                $fila = $assinante->filas()->create(["nome"=>$request->nome,
                                                        "tipo"=>$request->tipo,
                                                        "tempo_chamada"=>$request->tempo_chamada,
                                                        "regra_transbordo"=>$request->regra_transbordo
                                                      ]);

                

                $linhas = Auth::user()->assinante->linhas()->whereIn(DB::raw('MD5(id)'), $request->linhas)->get();

                foreach($linhas as $key=>$linha){
                    $fila->linhas()->attach($linha->id, ['posicao'=>$key]);
                }

                event( new FilaModificada() );
            });

            \App\Http\Controllers\SessionController::flashMessage('success',
                                                                  'Sucesso',
                                                                  'Linha cadastrada com sucesso.');

            //event(new FilaModificada()); 
            return redirect()->route("rvc.filas.index");

        } catch (Exception $e){

            \App\Http\Controllers\SessionController::flashMessage('danger',
                                                                    'Error',
                                                                    'Um erro inesperado ocorreu por favor tente novamente.');

            return redirect()->back()->withInput();
        }
    }

    public function edit(Request $request){
        $assinante = Auth::user()->assinante;

        $fila =  $assinante->filas()->with(['linhas'=>function($query){
                                                        $query->select("nome");
                                                        $query->withIdMd5();
                                                    }])
                                                    ->withIdMd5()
                                                    ->where(DB::raw('MD5(filas.id)'), $request->id)
                                                    ->first();

        $linhas_sem_grupo = $assinante->linhas()
                                      ->withIdMd5()
                                      ->whereNotIn('id', $fila->linhas()->get()->pluck('id'))
                                      ->get();

        return view('rvc.filas.edit', ["fila"=>$fila,
                                        "linhas_added"=>$fila->linhas,
                                        "linhas"=>$linhas_sem_grupo]);
    }

    public function update(FilasValidator $request){

        try{

            DB::transaction(function() use ($request){
                $assinante = Auth::user()->assinante;

                $fila = $assinante->filas()->whereRaw("MD5(id) = '".$request->f."'")->first();
                $linhas = $assinante->linhas()->whereIn(DB::raw("MD5(id)"), $request->linhas)->get();

                $fila->update(["nome"=>$request->nome,
                                                        "tipo"=>$request->tipo,
                                                        "tempo_chamada"=>$request->tempo_chamada,
                                                        "regra_transbordo"=>$request->regra_transbordo
                                                      ]);
                $new_lines = array();

                foreach($linhas as $posicao=>$linha){
                    $new_lines[$linha->id] = ['posicao'=>$posicao];
                }

                $fila->linhas()->sync($new_lines);

                event( new FilaModificada() );
            });

            \App\Http\Controllers\SessionController::flashMessage('success',
                                                                  'Sucesso',
                                                                  'Linha cadastrada com sucesso.');

            //event(new FilaModificada()); 
            return redirect()->route("rvc.filas.index");

        } catch (Exception $e){

            \App\Http\Controllers\SessionController::flashMessage('danger',
                                                                    'Error',
                                                                    'Um erro inesperado ocorreu por favor tente novamente.');

            return redirect()->back()->withInput();
        }
    }

    public function destroy(Request $request){
        $grupo = $this->entity->where(DB::raw('MD5(id)'), $request->id)
                              ->first();

        $status = $grupo->delete();

        return json_encode(['status'=>$status]);
    }

    public function getMine(Request $request){

        $filas = Auth::user()->assinante->filas()->withIdMd5()->get();
   
        return json_encode($filas);
    }

    public function getFilasOf($id){

        $filas = \App\Models\Assinantes\Assinantes::whereRaw("MD5(id) = '".$id."'")->first()
                                                    ->filas()
                                                    ->select('id', 'nome')
                                                    ->withIdMd5()
                                                    ->get();

        return json_encode($filas);
        
    }
}
