<?php

namespace App\Listeners\Filas;

use App\Events\Filas\FilaModificada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Filas;
use App\Helpers\AsteriskFileParsers\Queues;

class AtualizarFilas
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  FilaModificada  $event
     * @return void
     */
    public function handle(FilaModificada $event)
    {   
        $parser = new Queues();

        $filas = Filas::with('linhas.autenticacao')->with('assinante')->get();
        
        foreach($filas as $fila){
            $parser->addSession($fila->nome, "rv_queues");

            $fila_attrs = array(
                                "strategy"=>$fila->tipo,
                                "autopause"=>"no",
                                "maxlen"=>"0",
                                "timeout"=>$fila->tempo_chamada,
                                "retry"=>"5",
                                "announce-frequency"=>"0",
                                "periodic-announce-frequency"=>"0",
                                "announce-holdtime"=>"yes",
                                "announce-round-seconds"=>"0",
                                "reportholdtime"=>"no",
                                "memberdelay"=>"0"
                                );

            if($fila->regra_transbordo == 1){
                
                $fila_attrs["joinempty"] = "unavailable";
                $fila_attrs["leavewhenempty"] = "unavailable";

            }

            $parser->addFila($fila_attrs, "rv_queues");

            $members = array();

            foreach($fila->linhas as $linha){
                $parser->addMember("SIP/".$linha->autenticacao->login_ata.",".(intval($linha->pivot->posicao)+1) ,"rv_queues");
            }
        }

        $parser->setFile(config('asterisk.queues_file'));
        $parser->write("rv_queues");
        $parser->commit();

        exec("rasterisk -x reload");
    }
}
