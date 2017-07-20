<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigNotificacoesController extends Controller
{   
	public function __construct(){

	}

	public function index(Request $request){
		return view("rv.configuracoes.notificacoes.index");
	}

	public function update(Request $request){
		

		try{
			DB::transaction(function() use ($conf){
			});

            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rv.configuracoes.notificacoes');

        } catch (\Exception $ex){
           SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");

           return redirect()->back()->withInput();
        }

	}

	public function create(Request $request){
		return view('rv.configuracoes.notificacoes.create');

	}
}