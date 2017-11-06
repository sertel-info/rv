<?php

namespace App\Listeners;

use App\Events\ItensModificados;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helpers\AsteriskFileParser;
use DB;

class AtualizaArquivos
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AsteriskFileParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Handle the event.
     *
     * @param  ItensModificados  $event
     * @return void
     */
    public function handle(ItensModificados $event)
    {   
        $linhas = \App\Models\Linhas\Linhas::with("autenticacao")
                                            ->with("configuracoes")
                                            ->with("facilidades")
                                            ->with("permissoes")
                                            ->with("did")
                                            ->with(["assinante"=>function($query){
                                                $query->select(DB::raw('id, IF(assinantes.nome is null, assinantes.nome_fantasia, assinantes.nome) as nome'));

                                                $query->with('facilidades');
                                            }])
                                            ->get();
        foreach($linhas as $linha){
            //gera os extensions do dialplan 
                   
            $this->parser->addExtension('_0'.$linha->autenticacao->login_ata,
                                            '1',
                                            "AGI(ramal_virtual/rv_internas.php)",
                                            "ramal_virtual_internas"
                                            );
            /** DID **/
            $did = $linha->did;
            if($did){
                $this->updateDid($did);
            }

            $this->updateSipRamais($linha);

            /** VOICE MAILS **/
            if($linha->facilidades->caixa_postal == 1){
                $this->updateVoiceMail($linha);
            }
        }
  
        /** EXTENSÃO PARA CHAMAR O HANGUP **/

        $this->parser->addInclude("ramal_virtual_hangup", "ramal_virtual_internas", "extension");
        $this->parser->addInclude("ramal_virtual_hangup", "ramal_virtual_entrada", "extension");

        /** RAMAL VIRTUAL APLICAÇÂO **/
        $configs = \App\Models\Configuracoes::first();

        $this->parser->addExtension('_'.$configs->prefx_aplicacoes.'.',
                                      '1',
                                      "AGI(ramal_virtual/rv_aplicacao.php)",
                                      "ramal_virtual_aplicacao"
                                      );


        $this->parser->setFile(config('app.asterisk_files')['extension']);
        $this->parser->write('extension');
        
        $this->parser->setFile(config('app.asterisk_files')['registry']);
        $this->parser->write('registry');
          
        $this->parser->setFile(config('app.asterisk_files')['sip_ramais']);
        $this->parser->write('sip_ramal');

        $this->parser->setFile(config('app.asterisk_files')['voice_mail']);
        $this->parser->write('voice_mail');

        $this->parser->commit();
          
        exec("rasterisk -x reload");
    }

    public function updateSipRamais($linha){
        $callerid = $linha->configuracoes->callerid ? $linha->configuracoes->callerid : $autenticacao->login_ata;
        $autenticacao = $linha->autenticacao;

        $sip_ramais_arr = array("username"=>$autenticacao->usuario,
                                "secret"=>$autenticacao->senha,
                                "nat"=>'force_rport,comedia',
                                "qualify"=>'yes',
                                "callerid"=>"\"".$linha->assinante->nome."\"".
                                "<".$callerid.">",
                                "type"=>"friend",
                                "context"=>"sertel",
                                "call-limit"=>$linha->simultaneas,
                                "accountcode"=>$autenticacao->usuario,
                                "port"=>$autenticacao->porta,
                                "host"=>"dynamic",
                                "disallow"=>"all",
                                "dtmf_mode"=>$linha->configuracoes->envio_dtmf,
                                "codecs"=>$linha->codecs,
                                );

        if($linha->configuracoes->call_group !== null)
            $sip_ramais_arr["callgroup"] = $linha->configuracoes->call_group;

        if($linha->configuracoes->pickup_group !== null)
            $sip_ramais_arr["pickupgroup"] = $linha->configuracoes->pickup_group;

        $this->parser->addSipRamal($autenticacao->login_ata, $sip_ramais_arr);
    }

    public function updateDid($did){
        if(!$did->status_did)
            return;
        
        $this->parser->addRegistry($did->usuario_did,
                                    $did->senha_did,
                                    $did->ip_did,
                                    $did->extensao_did);

        $this->parser->addExtension('_'.$did->extensao_did,
                                            '1',
                                            'AGI(ramal_virtual/rv_entrada.php)',
                                            "ramal_virtual_entrada"
                                            );
    }

    public function updateVoiceMail($linha){
        $vm = $linha->autenticacao->login_ata.' => '.$linha->facilidades->cx_postal_pw.',,'.
                    $linha->nome.',,'.
                    "attach=yes|saycid=yes|envelope=yes|tz=brazil|delete=no";

        $this->parser->addVoiceMail($vm, "rv_correio_voz");
    }
}
