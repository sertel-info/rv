<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Linhas\Linhas;
use App\Models\Planos\Planos;
use App\Http\Requests\Validators\Linhas\LinhasRequest;
use App\Events\ItensModificados;
use App\Events\LinhaAtualizada;
use Auth;

class LinhasController extends Controller
{   

    public function __construct(Linhas $linhas){
        $this->entity = $linhas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinhasRequest $request)
    {   
  

        $dados = $this->getDataObject($request);

        $assinante = \App\Models\Assinantes\Assinantes::where(DB::raw('MD5(id)', $request->assinante))
                                                        ->first();

        if($dados['facilidades']['atend_automatico_tipo'] == 'ura'){
            
            if(isset($assinante->ura->id))
                $dados['facilidades']['atend_automatico_destino'] = md5($assinante->ura->id);
            else
                $dados['facilidades']['atend_automatico_destino'] = null;

        }

        $autenticacao = new \App\Models\Linhas\DadosAutenticacaoLinhas($dados['autenticacao']);
        $configuracoes = new \App\Models\Linhas\DadosConfiguracoesLinhas($dados['configuracoes']);
        $facilidades = new \App\Models\Linhas\DadosFacilidadesLinhas($dados['facilidades']);
        $permissoes = new \App\Models\Linhas\DadosPermissoesLinhas($dados['permissoes']);
        $did = new \App\Models\Linhas\Dids($dados['did']);

        try{
            DB::beginTransaction();
            
            $linha = $this->entity->create($dados['basicos'])
                                            ->assinante()
                                            ->associate($assinante);

            $linha->autenticacao()->save($autenticacao);
            $linha->configuracoes()->save($configuracoes);
            $linha->facilidades()->save($facilidades);
            $linha->permissoes()->save($permissoes);
            $linha->did()->save($did);

            event(new ItensModificados());
            DB::commit();
            return response('', 200);
        }catch(\Exception $e){
            DB::rollback();
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
    public function update(LinhasRequest $request)
    {   
        $dados = $this->getDataObject($request);

        $linha = \App\Models\Linhas\Linhas::where('id', $request->l)
                                          ->with("autenticacao")
                                          ->with("configuracoes")
                                          ->with("facilidades")
                                          ->with("permissoes")
                                          ->first();

        //$assinante = $linha->assinante;
       /*if($dados['facilidades']['atend_automatico_tipo'] == 'ura'){
            if(isset($assinante->ura->id))
                $dados['facilidades']['atend_automatico_destino'] = md5($assinante->ura->id);
            else
                $dados['facilidades']['atend_automatico_destino'] = null;
        }*/

        try{
            DB::beginTransaction();
      
            $linha->update($dados['basicos']);
            $linha->autenticacao->update($dados['autenticacao']);
            $linha->configuracoes->update($dados['configuracoes']);
            $linha->facilidades->update($dados['facilidades']);
            $linha->permissoes->update($dados['permissoes']);
            $linha->did->update($dados['did']);

            event(new ItensModificados());
            DB::commit();
            
            return response('', 200);

        }  catch(\Exception $e){
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
            
            $linha = $this->entity->where('id', $request->id)
                                  ->first();
            
            DB::beginTransaction();                                  
            
            $status = $linha->delete();
            
            event(new ItensModificados());

            DB::commit();
            
            return response('', 200);
        } catch(Exception $e){
            DB::rollback();
            return response('', 500);
        }

    }

    public function get(Request $request){
       try{
            $linha = $this->entity->with('autenticacao')
                                  ->with('did')
                                  ->with('configuracoes')
                                  ->with('facilidades')
                                  ->with('permissoes')
                                  ->find($request->l);

            return response()->json(["linha"=>$linha], 200);

        } catch (Exception $e){

            return response(400);
       }
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

    /*public function getTroncosList(){
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
    }*/


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
                                        "status_did",
                                        "codecs",
                                        "cli",
                                        "simultaneas",
                                        "plano"
                                        );
       
        $dados_basicos['assinante_id'] = $request->assinante;
        /*$dados_basicos['assinante_id'] = \App\Models\Assinantes\Assinantes::where( DB::raw("MD5(id)"), $request->assinante_id)
                                          ->first()
                                          ->id;*/


        $did = $request->only("usuario_did",
                              "senha_did",
                              "ip_did",
                              "extensao_did",
                              "status_did");

        return ['autenticacao'=>$autenticacao,
                'configuracoes'=>$configuracoes,
                'facilidades'=>$facilidades,
                'permissoes'=>$permissoes,
                'basicos'=>$dados_basicos,
                'did'=>$did];
    }
}
