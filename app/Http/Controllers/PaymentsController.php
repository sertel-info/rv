<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments\MpPayments;
use App\Models\Payments\MpPreferences;
use App\Models\Assinantes\Assinantes;
use App\Eventts\Creditos\CreditosAdicionados;
use DB;
use MP;
use Auth;

class PaymentsController extends Controller
{   

	public function index(Request $request){
		return view("rvc.pagamentos.mercado", ['valores_possiveis'=>config('payments.valores_possiveis')]);
	}

	public function create(Request $request) {
		$assinante = Auth::user()->assinante;
		
		if(!in_array(intval($request->valor_creditos), config('payments.valores_possiveis'))){
			abort(500);
		}

		$mp = new MP( config('payments.CLIENT_ID'), config('payments.CLIENT_SECRET') );

		$preference_data = $this->getPreferenceData($request, $assinante);
		$preference = $mp->create_preference($preference_data);

		if($preference['status'] !== 201){
			return back();
		}

		$pref_model = new MpPreferences();
		$pref_model->mp_pref_id = $preference['response']['id'];
		$pref_model->assinante_id = $assinante->id;
	

		DB::transaction(function() use ($pref_model){
			$pref_model->save();
		});

		return redirect($preference['response'][config('payments.init_point')]);
	}


	public function receiveNotification(Request $request){
		
		$mp = new MP( config('payments.CLIENT_ID'), config('payments.CLIENT_SECRET') );
		try{

			if($request->topic == "payment"){
				//$mp = new MP( config('payments.CLIENT_ID'), config('payments.CLIENT_SECRET') );

				$payment_data = $mp->get(
									    array(
									        "uri" => "/collections/notifications/".$request->id,
									        "params" => array(
									            "access_token" => config("payments.access_token")
									        )
									        )
									    );
				
				if(!$payment_data['status'] == 200){
					abort(500);
				}

				$current_mp_status = $payment_data['response']['collection']['status'];

				$payment = MpPayments::firstOrNew(["mp_id"=>$request->id]);

				if($payment->rv_status == "payed"){
					return response("", 200);
				}

				$current_rv_status = $payment->rv_status;

				$payment->mp_id = $request->id;
				$payment->mp_status = $current_mp_status;
				$payment->rv_status = $current_mp_status;
				$payment->assinante_id = $request->a_id;

				$financeiro_assinante = Assinantes::where("id", $request->a_id)
														->first()
														->financeiro()
														->first();

				if($current_mp_status == "approved"){
					$qtd_creditos = floatval($payment_data['response']['collection']['transaction_amount']);
					$financeiro_assinante->creditos = floatval($financeiro_assinante->creditos) + $qtd_creditos;

					$payment->rv_status = "payed";
				}

				DB::transaction(function() use ($financeiro_assinante, $payment){
					$financeiro_assinante->save();
					$payment->save();
				});
				
			}
			
			event(CreditosAdicionados(Auth::User()->assinante, $request));
			return response('', 200);

		} catch (\Exception $e){

			return response('', 500);			
		}
	}


	public function finish(Request $request){
		return view("rvc.pagamentos.finish", ['status'=>$request->status]);
	}


	private function getPreferenceData ($request, $assinante){
		$notification_url_data = $data = array('a_id'=>$assinante->id);              
		return  array (
				    "items" => array (
				        array (
				            "title" => "Créditos Ramal Virtual",
				            //"quantity" => intval($request->valor_creditos),
				            "quantity" => intval($request->valor_creditos),
				            "currency_id" => "BRL",
				            "unit_price" => 1
				        )
				    ),
				    "payer" => array( 
				    		"name"=> $assinante->tipo == 1 ? $assinante->nome  : $assinante->nome_fantasia ,
				    		"surname"=> $assinante->tipo == 1 ? $assinante->sobrenome  : "",
				    		),
		    		"payment_methods"=> array(
		    				"installments"=>1
		    				),
		    		"notification_url"=> config("payments.notification_url")."?".http_build_query($notification_url_data),
		    		"back_urls"=> array("success"=> config("payments.back_urls.success"),
		    							"pending"=> config("payments.back_urls.pending"),
		    							"failure"=> config("payments.back_urls.failure")
		    					  )

				);
	}


	public function test(Request $request){
		$mp = new MP( config('payments.CLIENT_ID'), config('payments.CLIENT_SECRET') );



	}

}