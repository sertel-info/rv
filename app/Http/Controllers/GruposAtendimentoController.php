<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\GruposAtendimento;
use App\Http\Requests\Validators\GruposAtendimentoValidator;

class GruposAtendimentoController extends Controller
{   
    function __construct(GruposAtendimento $grps){
        $this->entity = $grps;
    }
    
    public function index(Request $request){
    	return view("rvc.grupos_atendimento.index", ["active"=>"grupos_atend", "panel_title"=>"Grupos de Atendimento"]);
    }

    public function create(){
    	$linhas = Auth::user()->assinante->linhas()
                                         ->withCount("grupo")
                                         ->withIdMd5()
                                         ->get()
                                         ->where('grupo_count', '=', 0);

    	return view('rvc.grupos_atendimento.create', ['linhas'=>$linhas]);
    }

    public function store(GruposAtendimentoValidator $request){
        $assinante = Auth::user()->assinante;

    	  $grupo = $assinante->grupos()->create([
    								 "tipo"=>$request->tipo,
    								 "nome"=>$request->nome,
                                     "tempo_chamada"=>$request->tempo_chamada
    								]);
        
        if($request->linhas == null){
            $request->linhas = [];
        }

        foreach($request->linhas as $key=>$md5_id){
            $linha = $assinante->linhas()->where(DB::Raw('MD5(id)'), $md5_id)->first();

            \App\Models\GruposLinhas::create([
                    'linha_id'=>$linha->id,
                    'grupo_id'=>$grupo->id,
                    'posicao'=>$key
                ]);
        }

    	return redirect()->route('rvc.grupos_atendimento.index');
    }

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

    public function update(GruposAtendimentoValidator $request){
        $assinante = Auth::user()->assinante;
        $linhas_assinante = $assinante->linhas();

        $grupo = $assinante->grupos()
                           ->where(DB::raw("MD5(id)"), $request->id)
                           ->first();

        //remover as relações das linhas que saíram
        $linhas_para_remover = $grupo->linhas()
                                     ->whereNotIn(DB::raw('MD5(linhas.id)'),$request->linhas)
                                     ->get();

        $linhas_para_remover->each(function($el){
                                        $el->pivot->delete();
                                     });

        $status = $grupo->update([
                                  "tipo"=>$request->tipo,
                                  "nome"=>$request->nome,
                                  "tempo_chamada"=>$request->tempo_chamada
                                 ]);

        if($request->linhas == null){
            $request->linhas = [];
        }
        
        $linhas = $linhas_assinante->whereIn(DB::Raw('MD5(id)'), $request->linhas)
                                   ->get();
        
        foreach($linhas as $key=>$linha){

                \App\Models\GruposLinhas::UpdateOrCreate(
                    ['linha_id'=>$linha->id],
                    [
                      'linha_id'=>$linha->id,
                      'grupo_id'=>$grupo->id,
                      'posicao'=>$key
                    ]);
        }

        return redirect()->route('rvc.grupos_atendimento.index');
    }

    public function destroy(Request $request){
        $fila = $this->entity->where(DB::raw('MD5(id)'), $request->id)
                                  ->first();

        $status = $fila->delete();

        return json_encode(['status'=>$status]);
    }

    public function getMine(Request $request){

      $grupos = Auth::user()->assinante->grupos()->withIdMd5()->get();
      
      return json_encode($grupos);

    }

    public function getGruposOf($id){

      if(Auth::user()->role == 0){
         $grupos = \App\Models\Assinantes\Assinantes::whereRaw("MD5(id) = '".$id."'")->first()
                                                    ->grupos()
                                                    ->select('id', 'nome')
                                                    ->withIdMd5()
                                                    ->get();
         return json_encode($grupos);
      }
     

    }
}
