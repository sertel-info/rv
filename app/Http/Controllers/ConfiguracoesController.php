<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracoes;
use App\Http\Controllers\SessionController;
use App\Events\ItensModificados;

class ConfiguracoesController extends Controller
{	
	function __construct(Configuracoes $cfg){
		$this->entity = $cfg;
	}
    
    public function get(){
    	$configuracoes = $this->entity->firstOrCreate([], [
            'prefx_aplicacoes' => "",
            'atalho_siga_me' => "",
            'atalho_cadeado' => "",
            'voice_mail_remetente_padrao' => "",
            'voice_mail_assunto_padrao' => "",
            'voice_mail_mensagem_padrao' => ""
        ]);
        
        return response()->json(['configuracoes'=>$configuracoes], 200);
    }

    public function update(Request $request){
    	try{
			$conf = $this->entity->first();

    	    $conf->update($request->only($this->entity->getFillable()));
            
            event(new ItensModificados());

            return response('', 200);

        } catch (\Exception $ex){
           return response('', 500);
        }
    }
}
