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
                                            }])
                                            ->get();

        foreach($linhas as $linha){
            //gera os extensions do dialplan
            $autenticacao = $linha->autenticacao;
            $did = $linha->did;


            $this->parser->addExtension('_0'.$autenticacao->login_ata,
                                            '1',
                                            "AGI(ramal_virtual/rv_internas.php)",
                                            "ramal_virtual_internas"
                                            );
            if($did){

                $this->parser->addRegistry($did->usuario_did,
                                            $did->senha_did,
                                            $did->ip_did,
                                            $did->extensao_did);


                $this->parser->addExtension('_'.$did->extensao_did,
                                            '1',
                                            'AGI(ramal_virtual/rv_entrada.php)',
                                            "ramal_virtual_entrada"
                                            );

                /*$this->parser->addExtension('_'.$did->extensao_did,
                                            'h',
                                            "Hangup() \n",
                                            "ramal_virtual_entrada"
                                            );*/

            }

            
            $callerid = $linha->configuracoes->callerid ? $linha->configuracoes->callerid : $autenticacao->login_ata;

            $sip_ramais_arr = array("username"=>$autenticacao->usuario,
                                    "secret"=>$autenticacao->senha,
                                    "nat"=>'force_rport,comedia',
                                    "callerid"=>"\"".$linha->assinante->nome."\"".
                                    "<".$callerid.">",
                                    "type"=>"friend",
                                    "context"=>"sertel",
                                    "call-limit"=>$linha->simultaneas,
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

            /** VOICE MAILS **/
            if($linha->facilidades->caixa_postal == 1){
              $vm = $autenticacao->login_ata.' => '.$linha->facilidades->cx_postal_pw.',,'.
                    $linha->nome.',,'.
                    "attach=yes|saycid=yes|envelope=yes|tz=brazil|delete=no";

              $this->parser->addVoiceMail($vm, "rv_correio_voz");
            }
            

        }

        /** RAMAL VIRTUAL SAÍDA **/

       /* $this->parser->addExtension('_z.',
                                      '1',
                                      "AGI(ramal_virtual/rv_saida.php)",
                                      "ramal_virtual_saida"
                                      );

        $this->parser->addExtension('_z.',
                                      'h,1',
                                      "Hangup() \n",
                                      "ramal_virtual_saida"
                                      );*/

        /** RAMAL VIRTUAL APLICAÇÂO **/
        $configs = \App\Models\Configuracoes::first();

        $this->parser->addExtension('_'.$configs->prefx_aplicacoes.'.',
                                      '1',
                                      "AGI(ramal_virtual/rv_aplicacao.php)",
                                      "ramal_virtual_aplicacao"
                                      );
        /*
        $this->parser->addExtension('h',
                                    'n',
                                    'ExecIf($["${CDR(type)}" = "sainte" & "${CDR(disposition)}" = "ANSWERED"]?AGI(ramal_virtual/rv_calcula_tarifa.php))',
                                    "ramal_virtual_hangup"
                                    ); 

        $this->parser->addExtension('h',
                                    '1',
                                    'ExecIf($["${CDR(type)}" = "interna" | "${CDR(type)}" = "entrante"]?'.
                                                                'AGI(ramal_virtual/rv_envia_email.php))',
                                    "ramal_virtual_hangup"
                                    ); 
        */

 

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
}
