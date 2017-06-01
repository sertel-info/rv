<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Assinantes\Assinantes;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\AtualizacoesCreditos;

class AssinantesController extends Controller
{   

    public function __construct(Assinantes $assinantes){
        $this->entity = $assinantes;
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
        $planos = \App\Models\Planos\Planos::select('id', 'nome')
                                            ->get()
                                            ->mapWithKeys(function($item){
                                                return [$item->id=>$item->nome];
                                            });


        return view("rv.assinantes.create", ["panel_title"=>"Cadastrar Assinante",
                                             "active"=>"ass_criar",
                                             "planos"=>$planos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 

    public function store(Request $request)
    {   
        $dados = $this->getDataObjects($request);
        //$reg_ctrl = new RegisterController();

        $assinante = new $this->entity($dados['basicos']);
        $contato = new \App\Models\Assinantes\DadosContatoAssinante($dados['contato']);
        $financeiro = new \App\Models\Assinantes\DadosFinanceiroAssinante($dados['financeiro']);
        $facilidades = new \App\Models\Assinantes\DadosFacilidadesAssinante($dados['facilidades']);
        
        /*if($reg_ctrl->validator($request)){
            $reg_ctrl->create($dados['acesso']);
        }*/

        $acesso = new \App\User($dados['acesso']);

        $trans_resul = DB::transaction(function() use ($assinante,
                                                         $contato,
                                                         $financeiro,
                                                         $facilidades,
                                                         $acesso
                                                         ){
            try{
                $assinante->save();
                $assinante->contato()->save($contato);
                $assinante->financeiro()->save($financeiro);
                $assinante->facilidades()->save($facilidades);
                $assinante->acesso()->save($acesso);
                return 1;
            } catch(\Exception $e){
                dd($e);
                return 0;
            }
            
        });
       
        if($trans_resul){
            \App\Http\Controllers\SessionController::flashMessage('success',
                                                                    'Sucesso',
                                                                    'Assinante cadastrado com sucesso.');

            return redirect()->route("rv.assinantes.manage");
        } else {

            \App\Http\Controllers\SessionController::flashMessage('danger',
                                                                    'Error',
                                                                    'Um erro inesperado ocorreu por favor tente novamente.');

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
        return view("rv.assinantes.manage", ['active'=>'ass_gerenciar',
                                             'panel_title'=>"Gerenciar Assinantes"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

            $planos = \App\Models\Planos\Planos::select('id', 'nome')
                                            ->get()
                                            ->mapWithKeys(function($item){
                                                return [$item->id=>$item->nome];
                                            });

            $assinante = $this->entity->select("*", "assinantes.id as id",
                                                    "users.name as nome_acesso",
                                                    "users.email as email_acesso",
                                                    "password as password")
                                      ->where(DB::raw('MD5(assinantes.id)'), $id)
                                      ->leftjoin('dados_contato_assinantes',
                                                 'assinantes.id', '=',
                                                 'dados_contato_assinantes.assinante_id')
                                      ->leftjoin("dados_facilidades_assinantes",
                                                 'assinantes.id', '=',
                                                 'dados_facilidades_assinantes.assinante_id')
                                      ->leftjoin("users",
                                                 'assinantes.id', '=',
                                                 'users.assinante_id')
                                      ->leftjoin("dados_financeiro_assinantes",
                                                 'assinantes.id', '=',
                                                 'dados_financeiro_assinantes.assinante_id')
                                      ->first();

            return view("rv.assinantes.edit", ["panel_title"=>"Editar Assinante",
                                               "active"=>"pla_gerenciar",
                                               "assinante"=>$assinante,
                                               "planos"=>$planos]);
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
        $dados = $this->getDataObjects($request);
        $assinante = $this->entity->where(DB::raw('MD5(assinantes.id)'), $id)
                                  ->with("contato")
                                  ->with("financeiro")
                                  ->with("planos")
                                  ->with("facilidades")
                                  ->with("acesso")
                                  ->first();

        $trans_resul = DB::transaction(function() use ($assinante, $dados) {
            try{

                $assinante->update($dados['basicos']);
                $assinante->contato->update($dados['contato']);
                $assinante->financeiro->update($dados['financeiro']);
                $assinante->facilidades->update($dados['facilidades']);
                $assinante->acesso->update($dados['acesso']);

                return 1;
            } catch(\Exception $e){
                return 0;
            }
        });
       
        if($trans_resul){
            \App\Http\Controllers\SessionController::flashMessage('success',
                                                                    'Sucesso',
                                                                    'Assinante atualizado com sucesso.');

            return redirect()->route("rv.assinantes.manage");
        } else {
            \App\Http\Controllers\SessionController::flashMessage('danger',
                                                                  'Erro',
                                                                    'Um erro inesperado ocorreu por favor tente novamente.');

            return redirect()->back()->withInput();
        }
    }

    public function getCredits(Request $request){
        if(!$request->ajax()){
            return json_encode(['status'=>0]);
        } 

        $id = $request->u; 

        $assinante = $this->entity->where(DB::raw('MD5(assinantes.id)'), $id)
                                                            ->with('financeiro')
                                                            ->first();

        if($assinante){
            return json_encode(['status'=>1, 'credits'=>$assinante->financeiro->creditos]);
        }

        return json_encode(['status'=>0]);

    }

    /** A variável operation é o md5 da palavra "mais" ou da palavra "menos" **/
    public function updateCredits(Request $request){
        try{
            $user = $request->u;
            $valor_mais = $request->c_add;
            $valor_menos = $request->c_rmv;
            $operacao = $request->o;

            $assinante = $this->entity->where(DB::raw('MD5(assinantes.id)'), $user)
                                                                ->with('financeiro')
                                                                ->first();

            $qtd_creditos_atual = $assinante->financeiro->creditos;
            
            if($operacao == md5('mais')){
              $qtd_creditos_nova = floatval($qtd_creditos_atual)+floatval($valor_mais);

              $assinante->atualizacoesCreditos()->create([
                    'value'=>$valor_mais
                ]);

            } else if($operacao == md5('menos')){
              $qtd_creditos_nova = floatval($qtd_creditos_atual)-floatval($valor_menos);

              $assinante->atualizacoesCreditos()->create([
                    'value'=>(floatval($valor_menos) * (-1))
                ]);

              if($qtd_creditos_nova < 0){
                 return json_encode(["status"=>-1, 
                                      "novo_valor"=>$qtd_creditos_nova]);
              }
            }
            
            $assinante->financeiro->update(['creditos'=>$qtd_creditos_nova]);
            
            return json_encode(["status"=>1, 
                                  "novo_valor"=>$qtd_creditos_nova]);

        } catch (\Exception $e){
            return $e->getMessage();
            return json_encode(["status"=>0, 
                                  "novo_valor"=>$qtd_creditos_nova]);            
        }
        

        
        //$assinante->financeiro->creditos->decrease(floatval($valor_menos));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $assinante = $this->entity->where(DB::raw('MD5(id)'), $request->id)
                                  ->first();

        $status = $assinante->delete();

        return json_encode(['status'=>$status]);
    }

    public function datatables(Request $request){
        if($request->ajax()){

           $assinantes = $this->entity->select(DB::raw("IF(tipo,concat(nome, ' ',sobrenome),nome_fantasia) as nome_completo,
                                                        IF(tipo=1,'PF','PJ') as tipo,
                                                        MD5(id) as id_md5,
                                                        1 as plano
                                                    "))
                                    ->with(["planos"=>function($query){
                                            $query->select("nome", "id");
                                     }])
                                    ->get();

            return json_encode(['data'=>$assinantes]); 
        }
    }

    public function get(Request $request){
        //plano, tipo, facilidades, status
        $assinante = $this->entity->select(DB::raw('assinantes.id,
                                                    IF(assinantes.tipo, "PF", "PJ") as tipo,
                                                    nome_fantasia,
                                                    razao_social as razão_social,
                                                    cnpj,
                                                    inscricao_estadual,
                                                    rg,
                                                    assinantes.nome,
                                                    sobrenome,
                                                    cpf,
                                                    planos.nome as plano'))
                                    ->with(["contato"=>function($query){
                                        $query->select(DB::raw('id, assinante_id, cep,
                                                          endereco as endereço,
                                                          complemento,
                                                          bairro,
                                                          cidade,
                                                          estado,
                                                          pais as país,
                                                          email
                                                          site,
                                                          telefone,
                                                          fax,
                                                          celular,
                                                          "Contato" as table_name'));
                                    }])
                                    ->with(["facilidades"=>function($query){
                                         $query->select(DB::raw('id, assinante_id,
                                                            IF(acesso_ramais, "ativo", "inativo") as acesso_ramais,
                                                            IF(acesso_dids, "ativo", "inativo") as acesso_dids,
                                                            IF(portal_voz, "ativo", "inativo") as portal_voz,
                                                            IF(sala_conferencia, "ativo", "inativo") as sala_conferência,
                                                            IF(fila_atendimento, "ativo", "inativo") as fila_atendimento,
                                                            IF(ura_atendimento, "ativo", "inativo") as ura_atendimento,
                                                            IF(envio_sms, "ativo", "inativo") as envio_sms,
                                                            IF(acesso_callshop, "ativo", "inativo") as acesso_callshop,
                                                            "Facilidades" as table_name'));
                                    }])
                                    ->with(["acesso"=>function($query){
                                        $query->select(DB::raw('assinante_id,
                                                           usuario as usuário,
                                                           senha,
                                                           IF(status, "ativo", "inativo"),
                                                           "Acesso" as table_name'));
                                    }])
                                    ->with(["financeiro"=>function($query){
                                        $query->select(DB::raw('
                                                            assinante_id,
                                                            dias_bloqueio,
                                                            DATE_FORMAT(dia_vencimento, "%d/%m/%Y") as dia_vencimento,
                                                            espaco_disco,
                                                            CONCAT(limite_credito, " R$") as limite_crédito,
                                                            CONCAT(alerta_saldo, " R$") as alerta_saldo,
                                                            "Financeiro" as table_name
                                                            '));
                                    }])
                                    ->leftjoin('planos', 'assinantes.plano', 'planos.id')
                                    ->first();

        return $assinante->toJson();
    }

    public function getDataObjects($request){
        if($request->tipo){
            $dados_basicos = $request->only("plano",
                                            "cpf",
                                            "nome",
                                            "sobrenome",
                                            "rg",
                                            "tipo");

            $dados_basicos['creditos'] = isset($request->creditos_iniciais) ?
                                                $request->creditos_iniciais :
                                                $request->creditos;

        } else {
            
            $dados_basicos = $request->only("nome_fantasia",
                                            "razao_social",
                                            "cnpj",
                                            "inscricao_estadual",
                                            "plano",
                                            "tipo");
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
                                            "limite_credito",
                                            "alerta_saldo",
                                            "espaco_disco",
                                            "dia_vencimento");

        $facilidades = $request->only("acesso_ramais",
                                        "portal_voz",
                                        "sala_conferencia",
                                        "fila_atendimento",
                                        "ura_atendimento",
                                        "envio_sms");

        $dados_acesso = array("name"=>$request->nome_acesso,
                                "email"=>$request->email_acesso,
                                "password"=>$request->senha_acesso,
                                "role"=>1);


        return ["acesso"=>$dados_acesso,
                "financeiro"=>$dados_financeiros,
                "facilidades"=>$facilidades,
                "contato"=>$dados_contato,
                "basicos"=>$dados_basicos];
    }
}
