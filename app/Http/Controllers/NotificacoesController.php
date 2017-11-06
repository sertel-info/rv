<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validators\Notificacoes\NotificacoesRequest;
use App\Models\Notificacoes\Notificacoes;
use DB;

class NotificacoesController extends Controller
{   
	public function __construct(Notificacoes $notificacoes){
		$this->entity = $notificacoes;
	}

	public function store(NotificacoesRequest $request){
		try{

			$notification = new Notificacoes;
			$form_data = $this->getRequestData($request);
			$notification->fill($form_data);

			DB::transaction(function() use ($notification){
				$notification->save();
			});

            return response('', 200);

        } catch (\Exception $ex){
           return response('', 500);
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


	public function update(NotificacoesRequest $request){
		try{
			$notification = $this->entity->find($request->n);
			$form_data = $this->getRequestData($request);
			$notification->fill($form_data);

			DB::transaction(function() use ($notification){
				$notification->save();
			});

            return response('', 200);

        } catch (\Exception $ex){

           return response('', 500);
        }

	}

	public function destroy(Request $request){
		try{
			$grupo = $this->entity->find($request->id);
			$grupo->delete();
			return response('', 200);
		} catch(\Exception $e){
			return response("", 500);
		}
	}

	public function get(Request $request){
		try{

			$notif = Notificacoes::find($request->n);
			return response()->json(['notif'=> $notif], 200);

		} catch (\Exception $e){
			return response('', 500);
		}
	}
}