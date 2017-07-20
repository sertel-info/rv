<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SessionController;
use App\Models\Configuracoes;

class ConfigGeralController extends Controller
{   
	public function __construct(Configuracoes $conf){
		$this->entity = $conf;
	}

	public function index(Request $request){
		$configuracoes = $this->entity->first();
		return view("rv.configuracoes.geral.index", ['configuracoes'=>$configuracoes]);
	}

	public function update(Request $request){
		$conf = $this->entity->first();

		$conf->prefx_aplicacoes = $request->prefx_aplicacoes;
		$conf->atalho_cadeado = $request->atalho_cadeado;
		$conf->atalho_siga_me = $request->atalho_siga_me;

		try{
			DB::transaction(function() use ($conf){
				$conf->save();
			});

            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rv.configuracoes.geral');


        } catch (\Exception $ex){
           SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");

           return redirect()->back()->withInput();
        }
		
		
	}
}