<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Configuracoes;
use DB;
use App\Http\Controllers\SessionController;

class ConfigVoiceMailController extends Controller
{   
	public function __construct(Configuracoes $config){
		$this->entity = $config;
	}

	public function index(Request $request){
		$configuracoes = $this->entity->select("voice_mail_assunto_padrao", 
												"voice_mail_remetente_padrao",
												"voice_mail_mensagem_padrao")
												->first();

		return view("rv.configuracoes.voice_mail.index", ['configuracoes'=>$configuracoes]);
	}

	public function update(Request $request){
		$conf = $this->entity->first();

		$conf->voice_mail_remetente_padrao = $request->voice_mail_remetente_padrao;
		$conf->voice_mail_assunto_padrao = $request->voice_mail_assunto_padrao;
		$conf->voice_mail_mensagem_padrao = $request->voice_mail_mensagem_padrao;

		try{
			DB::transaction(function() use ($conf){
				$conf->save();
			});

            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rv.configuracoes.voice_mail');


        } catch (\Exception $ex){
           SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");

           return redirect()->back()->withInput();
        }
		
		
	}
}