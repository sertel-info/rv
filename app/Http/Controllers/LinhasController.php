<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Linhas\Linhas;
use App\Http\Requests\Validators\LinhasValidator;
use App\Events\ItensModificados;
use App\Events\LinhaAtualizada;
use Auth;

class LinhasController extends Controller
{   

    public function __construct(Linhas $linhas){
        $this->entity = $linhas;
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
        $assinantes = \App\Models\Assinantes\Assinantes::select(DB::Raw("IF(ISNULL(nome), nome_fantasia, nome) as nome, MD5(id) as id_md5"))
                                                        ->orderBy("nome", "asc")
                                                        ->get()
                                                        ->mapWithKeys(function($item){
                                                            return [$item->id_md5=>$item->nome];
                                                        });


        return view("rv.linhas.create", ["active"=>"lin_criar",
                                         "panel_title"=>"Criar Linha",
                                         "assinantes"=>$assinantes,
                                         "codecs"=>$this->getCodecsList(),
                                         "rotas"=>$this->getTroncosList()]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinhasValidator $request)
    {   

        $dados = $this->getDataObject($request);

        $assinante = \App\Models\Assinantes\Assinantes::where(DB::raw('MD5(id)', $request->assinante))->first();

        if($dados['facilidades']['atend_automatico_tipo'] == 'ura'){
            
            if(isset($assinante->ura->id))
                $dados['facilidades']['atend_automatico_destino'] = md5($assinante->ura->id);
            else
                $dados['facilidades']['atend_automatico_destino'] = null;

        }

        $linha = $this->entity->create($dados['basicos'])
                                            ->assinante()
                                            ->associate($assinante);

        $autenticacao = new \App\Models\Linhas\DadosAutenticacaoLinhas($dados['autenticacao']);
        $configuracoes = new \App\Models\Linhas\DadosConfiguracoesLinhas($dados['configuracoes']);
        $facilidades = new \App\Models\Linhas\DadosFacilidadesLinhas($dados['facilidades']);
        $permissoes = new \App\Models\Linhas\DadosPermissoesLinhas($dados['permissoes']);
        $did = new \App\Models\Linhas\Dids($dados['did']);

        $trans_resul = DB::transaction(function() use ($autenticacao, 
                                          $configuracoes, 
                                          $facilidades, 
                                          $permissoes,
                                          $linha,
                                          $request,
                                          $did){
            try{
                $linha->autenticacao()->save($autenticacao);
                $linha->configuracoes()->save($configuracoes);
                $linha->facilidades()->save($facilidades);
                $linha->permissoes()->save($permissoes);

                if($request->status_did){
                    $linha->did()->save($did);
                }

                return 1;
            }catch(\Exception $e){
                return 0;
            }
        });
        
        if($trans_resul){
            event(new ItensModificados());

            \App\Http\Controllers\SessionController::flashMessage('success',
                                                                    'Sucesso',
                                                                    'Linha cadastrada com sucesso.');

            return redirect()->route("rv.linhas.manage");
        } else {
            \App\Http\Controllers\SessionController::flashMessage('danger',
                                                                    'Error',
                                                                    'Um erro inesperado ocorreu por favor tente novamente.');

            return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     *to
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        return view("rv.linhas.manage", ["active"=>"lin_gerenciar",
                                         "panel_title"=>"Gerenciar Linhas"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $assinantes = \App\Models\Assinantes\Assinantes::select(DB::Raw("IF(ISNULL(nome), nome_fantasia, nome) as nome, MD5(id) as id_md5"))
                                                        ->orderBy("nome", "asc")
                                                        ->get()
                                                        ->mapWithKeys(function($item){
                                                            return [$item->id_md5=>$item->nome];
                                                        });

        $linha = $this->entity->select(DB::Raw("*, linhas.id as id, dids.id as id_did, MD5(assinante_id) as assinante_id"))
                              ->where(DB::raw("md5(linhas.id)"), $id)
                             ->leftjoin("dados_autenticacao_linhas",
                                         "dados_autenticacao_linhas.linha_id",
                                         "linhas.id")
                             ->leftjoin("dados_configuracoes_linhas",
                                         "dados_configuracoes_linhas.linha_id",
                                         "linhas.id")
                             ->leftjoin("dados_facilidades_linhas",
                                         "dados_facilidades_linhas.linha_id",
                                         "linhas.id")
                             ->leftjoin("dados_permissoes_linhas",
                                         "dados_permissoes_linhas.linha_id",
                                         "linhas.id")
                             ->leftjoin("dids",
                                         "dids.linha_id",
                                         "linhas.id")
                             ->first();

        $codecs_added = $linha->codecs;
        $codecs = array_diff($this->getCodecsList(), $codecs_added);

        $rotas_added = json_decode($linha->rotas_saida);
        $rotas = array_diff($this->getTroncosList(), $rotas_added !== null ? $rotas_added : []);

        return view("rv.linhas.edit", ["active"=>"lin_gerenciar",
                                         "panel_title"=>"Editar Linha",
                                         "linha"=>$linha,
                                         "assinantes"=>$assinantes,
                                         "codecs_added"=>$codecs_added,
                                         "codecs"=>$codecs,
                                         "rotas"=>$rotas,
                                         "rotas_added"=>$rotas_added]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinhasValidator $request)
    {   
        $id = md5($request->_id);
        $dados = $this->getDataObject($request);

        $linha = \App\Models\Linhas\Linhas::where(DB::raw('MD5(id)'), $id)
                                          ->with("autenticacao")
                                          ->with("configuracoes")
                                          ->with("facilidades")
                                          ->with("permissoes")
                                          ->first();

        $assinante = $linha->assinante;

        $trans_resul = DB::transaction(function() use($linha, $dados, $request, $assinante){
            try{

                if($dados['facilidades']['atend_automatico_tipo'] == 'ura'){
                    if(isset($assinante->ura->id))
                        $dados['facilidades']['atend_automatico_destino'] = md5($assinante->ura->id);
                    else
                        $dados['facilidades']['atend_automatico_destino'] = null;
                }
                
                $linha->update($dados['basicos']);
                $linha->autenticacao->update($dados['autenticacao']);
                $linha->configuracoes->update($dados['configuracoes']);
                $linha->facilidades->update($dados['facilidades']);
                $linha->permissoes->update($dados['permissoes']);

                if($request->status_did){
                    \App\Models\Linhas\Dids::updateOrCreate(['linha_id'=>$linha->id], $dados['did']);
                } else {
                    \App\Models\Linhas\Dids::where("linha_id", $linha->id)->delete();
                }

                return 1;
            }catch(\Exception $e){
                return 0;
            }
        });
        
        if($trans_resul){
            event(new ItensModificados());

            \App\Http\Controllers\SessionController::flashMessage('success',
                                                                    'Sucesso',
                                                                    'Linha atualizada com sucesso.');

            return redirect()->route("rv.linhas.manage");
        } else {
            \App\Http\Controllers\SessionController::flashMessage('danger',
                                                                    'Error',
                                                                    'Um erro inesperado ocorreu por favor tente novamente.');

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
        $linha = $this->entity->where(DB::raw('MD5(id)'), $request->id)
                              ->first();

        $status = $linha->delete();
        
        event(new ItensModificados());

        return json_encode(['status'=>$status]);
    }

    public function get(Request $request){
       $linha = $this->entity->select(DB::raw("*, MD5(linhas.id) as id_md5"))
                             ->with(['autenticacao'=>function($query){
                                    $query->select(DB::raw("'Autenticação' as table_name,
                                                             usuario as 'usuário',
                                                              numero as 'número', 
                                                              login_ata, senha,ip, 
                                                              porta,
                                                              id, 
                                                              linha_id"));
                             }])
                             ->with(['configuracoes'=>function($query){
                                 $query->select(DB::raw("*, IF(dados_configuracoes_linhas.ring_falso, 'ativo', 'inativo') as 'ring_falso',
                                                IF(dados_configuracoes_linhas.nat, 'ativo', 'inativo') as 'nat',
                                                UPPER(envio_dtmf) as envio_dtmf,
                                                'Configurações' as table_name"));
                             }])
                             ->with(['facilidades'=>function($query){
                                 $query->select(DB::raw("id, linha_id, cadeado_pin, num_siga_me, 
                                                        IF(dados_facilidades_linhas.caixa_postal, 'ativo', 'inativo') as 'caixa_postal',
                                                        IF(dados_facilidades_linhas.gravacao, 'ativo', 'inativo') as 'gravação',
                                                        IF(dados_facilidades_linhas.cadeado_pessoal, 'ativo', 'inativo') as 'cadeado_pessoal',
                                                        IF(dados_facilidades_linhas.siga_me, 'ativo', 'inativo') as 'siga_me',
                                                        'Facilidades' as table_name"));
                             }])
                             ->with(['permissoes'=>function($query){
                                 $query->select(DB::raw("id, linha_id, 
                                                IF(dados_permissoes_linhas.ligacao_fixo, 'ativo', 'inativo') as 'ligação_fixo',
                                                IF(dados_permissoes_linhas.ligacao_internacional, 'ativo', 'inativo') as 'ligação_internacional',
                                                IF(dados_permissoes_linhas.ligacao_movel, 'ativo', 'inativo') as 'ligação_móvel',
                                                IF(dados_permissoes_linhas.ligacao_ip, 'ativo', 'inativo') as 'ligação_ip',
                                                IF(dados_permissoes_linhas.status, 'ativo', 'inativo') as 'status',
                                                'Permissões' as table_name"));
                             }])
                             ->first()
                             ->toArray();

        $linha['codecs'] = implode(", ",json_decode($linha['codecs']));
        return json_encode($linha);
    }

    public function datatables(){
        $linhas = $this->entity->select(DB::raw('md5(linhas.id) as id_md5, 
                                                IF(ISNULL(assinantes.nome), assinantes.nome_fantasia, assinantes.nome) as nome_assinante,
                                                linhas.nome as nome,
                                                case funcionalidade when "portal_voz" then "Portal de Voz"
                                                                    when "linha_ip" then "Linha IP"
                                                                    when "callingguard" then "Callingguard"
                                                                    end as funcionalidade
                                                '))
                               ->with('assinante')
                               ->leftjoin("dados_facilidades_linhas",
                                          "dados_facilidades_linhas.linha_id",
                                          "linhas.id")
                               ->leftjoin("assinantes",
                                          "assinantes.id",
                                          "linhas.assinante_id")
                               ->get();

        return json_encode(['data'=>$linhas]);

    }

    public function getCodecsList(){
        return ["ulaw",
                "alaw",
                "g722",
                "g723",
                "g726",
                "g729",
                "gsm",
                "speex",
                "slin",
                "h261",
                "h263",
                "h263p",
                "h264",
                "ilbc"
                ];
    }

    public function getTroncosList(){
        $arquivo = "/var/lib/asterisk/agi-bin/ramal_virtual/rv_troncos.ini";
        
        if(!file_exists($arquivo)){
            return [];
        }

        $troncos = parse_ini_file($arquivo, true);

        if(!$troncos){
            return [];
        }
        
        $troncos_linha = $this->entity->find(19)->configuracoes->rotas_saida;

        return array_keys($troncos);
    }


    public function getDataObject($request){
        $autenticacao = $request->only("login_ata",
                                        "usuario",
                                        "senha",
                                        "ip",
                                        "porta");


        $configuracoes = $request->only("callerid",
                                        "envio_dtmf",
                                        "ring_falso",
                                        "call_group",
                                        "pickup_group",
                                        "nat",
                                        "rotas_saida");

        $facilidades = $request->only("gravacao",
                                      "cadeado_pessoal",
                                      "siga_me",
                                      "caixa_postal",
                                      "cadeado_pin",
                                      "monitoravel",
                                      "pode_monitorar",
                                      "cx_postal_email",
                                      "cx_postal_pw",
                                      "num_siga_me",
                                      "atend_automatico",
                                      "atend_automatico_tipo",
                                      "atend_automatico_destino");

        if($facilidades['caixa_postal'] === null){
            $facilidades['cx_postal_email'] = null;
            $facilidades['cx_postal_pw'] = null;
        }

        if($facilidades['siga_me']  === null){
            $facilidades['num_siga_me'] = null;
        }

        $permissoes = $request->only("ligacao_fixo",
                                    "ligacao_internacional",
                                    "ligacao_movel",
                                    "ligacao_ip",
                                    "status");

       

        $dados_basicos = $request->only("tecnologia",
                                        "ddd_local",
                                        "nome",
                                        "funcionalidade",
                                        "status_did",
                                        "codecs",
                                        "cli",
                                        "simultaneas"
                                        );


        $dados_basicos['assinante_id'] = \App\Models\Assinantes\Assinantes::where( DB::raw("MD5(id)"), $request->assinante_id)
                                          ->first()
                                          ->id;


        $did = $request->only("usuario_did",
                              "senha_did",
                              "ip_did",
                              "extensao_did");

        return ['autenticacao'=>$autenticacao,
                'configuracoes'=>$configuracoes,
                'facilidades'=>$facilidades,
                'permissoes'=>$permissoes,
                'basicos'=>$dados_basicos,
                'did'=>$did];
    }
}
