<?php

namespace App\Http\Controllers\Clientes;

use App\Http\Controllers\Controller;
use JWTAuth;

class HomeController extends Controller {

	/*
	*
	* Retorna os status das linhas do cliente
	*
	*/
	public function getLinhasStats(){
		$stats = exec("rasterisk -x 'sip show peers'", $output, $resul);
		dd($resul, $output);
	}
}