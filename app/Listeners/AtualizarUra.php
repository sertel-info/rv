<?php

namespace App\Listeners;

use App\Events\LinhaCriada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helpers\AsteriskFileParser;
use App\Models\Uras;
use App\Events\LinhaAtualizada;
use DB;
use App\Models\Ramais;

class AtualizarUras
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
     * @param  LinhaAtualizada  $event
     * @return void
     */
    public function handle(UraAtualizada $event)
    {      
        $uras = Ura::where('status', '=' , 1)->get();
        $digitos = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'asteristico', 'tralha'];    
        
        foreach($uras as $ura){
            $session = "URA-".$ura->id;


            foreach($digitos as $d){

                switch($ura->get('dig_'.$d.'_tipo')){
                    case 'ramal':
                        $destino = Ramais::where("MD5(id)", "=", $ura->get('dig_'.$d.'_tipo'))
                                            ->with("autenticacao")
                                            ->first();
                                            
                        $this->parser->addExtension('_0'.$linha->autenticacao->login_ata,
                                                    '1',
                                                    "Dial(SIP/".$destino->autenticacao->login_ata.".php)",
                                                    $session
                                                    );
                    break;
                    case 'grupo':

                    break;
                    case 'fila':

                    break;
                }

            }    
        }

        exec("rasterisk -x reload");
    }

    
}
