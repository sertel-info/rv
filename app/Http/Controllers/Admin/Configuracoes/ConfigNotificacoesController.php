<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SessionController;
use App\Http\Requests\Validators\Notificacoes\NotificacoesCreateValidator;
use App\Http\Requests\Validators\Notificacoes\NotificacoesUpdateValidator;
use App\Models\Notificacoes\Notificacoes;
use DB;

class ConfigNotificacoesController extends Controller
{   
	public function __construct(Notificacoes $notificacoes){
		$this->entity = $notificacoes;
	}

	public function index(Request $request){
		return view("rv.configuracoes.notificacoes.index");
	}

	public function create(){
		return view('rv.configuracoes.notificacoes.create');
	}

	public function edit(Request $request){
		$notificacao = $this->entity->where(DB::raw("md5(id)"), $request->n)->withIdMd5()->first();
		return view('rv.configuracoes.notificacoes.edit', ['notificacao'=>$notificacao]);
	}

	public function store(NotificacoesCreateValidator $request){
		try{

			$notification = new Notificacoes;
			$form_data = $this->getRequestData($request);
			$notification->fill($form_data);

			DB::transaction(function() use ($notification){
				$notification->save();
			});

            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rv.configuracoes.notificacoes');

        } catch (\Exception $ex){
           SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");
           return redirect()->back()->withInput();
        }

	}

	public function getRequestData(Request $request){

		$data = $request->only($this->entity->getFillable());

		if($request->ativar_email == null || $request->ativar_email == 0){
			$data['email_assunto'] = null;
			$data['email_corpo'] = null;
		}

		return $data;
	}


	public function update(NotificacoesUpdateValidator $request){
		try{
			$notification = $this->entity->where(DB::raw('md5(id)'), $request->n)->first();
			$form_data = $this->getRequestData($request);
			$notification->fill($form_data);

			DB::transaction(function() use ($notification){
				$notification->save();
			});

            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rv.configuracoes.notificacoes');

        } catch (\Exception $ex){
           SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");

           return redirect()->back()->withInput();
        }

	}

	public function destroy(Request $request){

		$grupo = $this->entity->where(DB::raw('MD5(id)'), $request->id)
                              ->first();

        $status = $grupo->delete();

        return json_encode(['status'=>$status]);

	}

}