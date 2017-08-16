<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planos\Planos;
use DB;

class PlanosController extends Controller
{   

    public function __construct(Planos $planos){
        $this->pla_model = $planos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("rv.planos.create", ["panel_title"=>"Cadastrar Plano",
                                         "active"=>"pla_criar"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try{
            $this->pla_model->create(["nome"=>$request->nome,
                                      "tipo"=>$request->tipo,
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

            SessionController::flashMessage("success", "Sucesso ", "Plano cadastrado com sucesso");

            return redirect()->route('rv.planos.create');

        } catch (\Exception $ex){

           SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");

           return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view("rv.planos.manage", ['active'=>'pla_gerenciar',
                                         'panel_title'=>'Gerenciar planos']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $plano = '';

        try{
            $plano = $this->pla_model->where(DB::raw('MD5(id)'), $id)->first();

            return view("rv.planos.edit", ["panel_title"=>"Editar Plano",
                                            "active"=>"pla_gerenciar",
                                            "plano"=>$plano]);
       
        } catch(\Exception $ex){
            SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");
            return redirect()->route('rv.planos.manage');
        }

      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $plano = $this->pla_model->find($id);

        try{
            $plano->update(["nome"=>$request->nome,
                            "tipo"=>$request->tipo,
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

            SessionController::flashMessage("success", "Sucesso ", "Plano atualizado com sucesso");

            return redirect()->route('rv.planos.manage');

        } catch (\Exception $ex){

           SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");

           return redirect()->back()->withInput();
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
        $plano = $this->pla_model->where(DB::raw('MD5(id)'), $request->id)
                                ->first();
        $status = $plano->delete();
        return json_encode(['status'=>$status]);
    }

    public function datatables(){
        $planos = $this->pla_model->select(DB::raw('*, MD5(id) as id_md5, 
                                                    CASE tipo WHEN "pre" THEN "PRÉ-PAGO" ELSE "PÓS-PAGO" END as tipo'))->get();
        return json_encode(["data"=>$planos]);
    }

    public function get(Request $request){
        if($request->ajax()){
            $plano = $this->pla_model->select(DB::raw('nome as Nome,
                                                       concat(valor_sms, " R$") as "Valor do SMS",
                                                       concat(valor_fixo_local, " R$") as "Valor para fixo local",
                                                       concat(valor_fixo_ddd, " R$") as "Valor para fixo DDD",
                                                       concat(valor_movel_local, " R$") as "Valor para móvel local",
                                                       concat(valor_movel_ddd, " R$") as "Valor para móvel DDD",
                                                       concat(valor_ddi, " R$") as "Valor do DDI",
                                                       concat(valor_ip, " R$") as "Valor para IP",
                                                       simultaneas as "Ligações Simultâneas",
                                                       descricao as Descrição,
                                                       CASE tipo WHEN "pre"
                                                                 THEN "PRÉ-PAGO" 
                                                                 ELSE "PÓS-PAGO" 
                                                                 END as Tipo'))
                                     ->where(DB::raw('MD5(id)'), $request->id)
                                     ->first();

            return json_encode($plano);
        }
    }
}
