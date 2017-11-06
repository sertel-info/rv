<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Validators\Planos\PlanosRequest;
use App\Models\Planos\Planos;
use DB;

class PlanosController extends Controller
{   

    public function __construct(Planos $planos){
        $this->entity = $planos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanosRequest $request)
    {

        try{
           
            DB::beginTransaction();
            $this->entity->create(["nome"=>$request->nome,
                                   //"tipo"=>$request->tipo,
                                   "tipo" => "pre", // prende o plano ao tipo pré, pois é o único que tem suporte atualmente
                                   "valor_sms"=>$request->valor_sms,
                                   "valor_fixo_local"=>$request->valor_fixo_local,
                                   "valor_fixo_ddd"=>$request->valor_fixo_ddd,
                                   "valor_movel_local"=>$request->valor_movel_local,
                                   "valor_movel_ddd"=>$request->valor_movel_ddd,
                                   "valor_ddi"=>$request->valor_ddi,
                                   "valor_ip"=>$request->valor_ip,
                                   "valor_movel_entrante"=>$request->valor_movel_entrante,
                                   "valor_fixo_entrante"=>$request->valor_fixo_entrante,
                                   "simultaneas"=>$request->simultaneas,
                                   "descricao"=>$request->descricao
                                    ]);
            DB::commit();

            return response('', 200);

        } catch (\Exception $ex){
            return response('', 500);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanosRequest $request)
    {
        try{
            $plano = $this->entity->find($request->p);
            DB::beginTransaction();
            $plano->update(["nome"=>$request->nome,
                            //"tipo"=>$request->tipo,
                            "valor_sms"=>$request->valor_sms,
                            "valor_fixo_local"=>$request->valor_fixo_local,
                            "valor_fixo_ddd"=>$request->valor_fixo_ddd,
                            "valor_movel_local"=>$request->valor_movel_local,
                            "valor_movel_ddd"=>$request->valor_movel_ddd,
                            "valor_ddi"=>$request->valor_ddi,
                            "valor_ip"=>$request->valor_ip,
                            "valor_movel_entrante"=>$request->valor_movel_entrante,
                            "valor_fixo_entrante"=>$request->valor_fixo_entrante,
                            "simultaneas"=>$request->simultaneas,
                            "descricao"=>$request->descricao
                            ]);


            DB::commit();
            return response('', 200);

        } catch (\Exception $ex){
           dd($ex);
           DB::rollback();
           return response('', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        try{
           
            $plano = $this->entity->find($request->id);
                                 
            $status = $plano->delete();
            return response('', 200);
        
        } catch (\Exception $e){
            return response('', 500);
        }
       
    }

    public function getAll(Request $request){
        $planos = $this->entity->select("id","nome")->orderBy("nome", "asc")->get();
        return response()->json(["data"=>$planos]);
    }

    public function get(Request $request){
        try{
            
            $plano = $this->entity->find($request->p);
            return response()->json(["plano"=>$plano], 200);
       
        } catch (\Exception $e){
            return response('', 500);
        }

    }
  
}
