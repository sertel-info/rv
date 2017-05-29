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
    
    public function index(){
    	$configuracoes = $this->entity->first();


    	return view("rv.configuracoes.index", ['active'=>'configuracoes',
    											'panel_title'=>'Configurações',
    											'configuracoes'=>$configuracoes]);
    }

    public function update(Request $request){
    	try{
			$conf = $this->entity->first();

    	    $conf->update($request->only($this->entity->getFillable()));
            
            event(new ItensModificados());

            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rv.configuracoes.index');


        } catch (\Exception $ex){
           SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");

           return redirect()->back()->withInput();
        }
    }
}
