<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Assinantes\Assinantes;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\Validators\Assinantes\AssinantesRequest;

class AssinantesController extends Controller
{   

    public function __construct(Assinantes $assinantes){
        $this->entity = $assinantes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 

    public function store(AssinantesRequest $request)
    {   
        $dados = $this->getDataObjects($request);
        //$reg_ctrl = new RegisterController();

        $assinante = new $this->entity($dados['basicos']);
        $contato = new \App\Models\Assinantes\DadosContatoAssinante($dados['contato']);
        $financeiro = new \App\Models\Assinantes\DadosFinanceiroAssinante($dados['financeiro']);
        $facilidades = new \App\Models\Assinantes\DadosFacilidadesAssinante($dados['facilidades']);
        

        $acesso = new \App\User($dados['acesso']);

        try{
            DB::beginTransaction();

            $assinante->save();
            $assinante->contato()->save($contato);
            $assinante->financeiro()->save($financeiro);
            $assinante->facilidades()->save($facilidades);
            $assinante->acesso()->save($acesso);
            

            DB::commit();
            return response('', 200);
        } catch(\Exception $e){
            DB::rollback();
            dd($e);
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
    public function update(AssinantesRequest $request)
    {    
        $id = $request->a;
        $dados = $this->getDataObjects($request);
        $assinante = $this->entity->where('id', $id)
                                  ->with("contato")
                                  ->with("financeiro")
                                  ->with("planos")
                                  ->with("facilidades")
                                  ->with("acesso")
                                  ->first();

        try{

            DB::beginTransaction();

            $assinante->update($dados['basicos']);
            
            $assinante->contato()->updateOrCreate(['assinante_id'=>$assinante->id],$dados['contato']);
            
            $assinante->financeiro()->updateOrCreate(['assinante_id'=>$assinante->id],$dados['financeiro']);

            $assinante->facilidades()->updateOrCreate(['assinante_id'=>$assinante->id],$dados['facilidades']);

            $assinante->acesso()->updateOrCreate(['assinante_id'=>$assinante->id],$dados['acesso']);

            DB::commit();
            return response('', 200);
        } catch(\Exception $e){
            DB::rollback();
            dd($e);
            return response('', 400);
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
           $assinante = $this->entity->where('id', $request->id)
                                   ->first();

           $assinante->delete();

           return response()->json('', 200);

        } catch (\Exception $e){
           return response()->json('', 500);
        }
       
    }


    /**
     * Retorna todos os assinantes, com seus nomes e ids os assinantes;
     * Usada majoritariamente em <select>
     *
     * @param  Request $request 
     * @return Json encoded assinantes
     */
    public function getAll(Request $request){
        $assinantes = Assinantes::select('id', DB::raw('IF(nome IS NULL, nome_fantasia, nome) as nome'))
                                  ->orderBy('nome','asc')
                                  ->get();

        return json_encode(["data"=>$assinantes]);
    }


    public function getDataObjects($request){
        if($request->tipo == "PF"){
            $dados_basicos = $request->only("plano",
                                            "cpf",
                                            "nome",
                                            "sobrenome",
                                            "rg");

            $dados_basicos['tipo'] = 1;

        } else {
            
            $dados_basicos = $request->only("nome_fantasia",
                                            "razao_social",
                                            "cnpj",
                                            "inscricao_estadual",
                                            "plano");

            $dados_basicos['tipo'] = 0;

        }

        $dados_contato = $request->only("cep",
                                        "endereco",
                                        "complemento",
                                        "bairro",
                                        "cidade",
                                        "estado",
                                        "pais",
                                        "email",
                                        "site",
                                        "telefone",
                                        "fax",
                                        "celular");

        $dados_financeiros = $request->only("dias_bloqueio",
                                            "alerta_saldo",
                                            "espaco_disco",
                                            "dia_vencimento");

        $facilidades = $request->only("correio_voz",
                                      "grupos_atendimento",
                                      "fila",
                                      "ura",
                                      "gravacoes",
                                      "saudacoes",
                                      "acesso_extrato",
                                      "acesso_cx_postal",
                                      "acesso_siga_me",
                                      "acesso_cadeado",
                                      "acesso_at_automatico");

        $dados_acesso = array("name"=>$request->nome_acesso,
                              "email"=>$request->email_acesso,
                              "role"=>1,
                              "status"=>$request->status
                              );

        if($request->senha_acesso !== "DeFPassWord"){
            $dados_acesso['password'] = $request->senha_acesso;
        }

        return ["acesso"=>$dados_acesso,
                "financeiro"=>$dados_financeiros,
                "facilidades"=>$facilidades,
                "contato"=>$dados_contato,
                "basicos"=>$dados_basicos];
    }


    public function get(Request $request){
       try{
            $assinante = $this->entity->with('contato')
                                   ->with("facilidades")
                                   ->with("acesso")
                                   ->with('financeiro')
                                   ->with('planos')
                                   ->where('id', $request->a)
                                   ->first();

            return response()->json(["assinante"=>$assinante], 200);
       
       } catch (\Exception $e){
            return response()->json([], 500);
       }
    }
    
}
