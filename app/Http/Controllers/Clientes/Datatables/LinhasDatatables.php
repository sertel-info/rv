<?php

namespace App\Http\Controllers\Clientes\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Linhas\Linhas;
use ReactTable;
use DB;
use JWTAuth;

class LinhasDatatables extends Controller
{

	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function anyData(Request $request)
	{	
		$assinante = JWTAuth::toUser($request->cookie('token'))->assinante;

		$linhas_query = $assinante->linhas();

		$rt = new ReactTable();
		$rt->setData($linhas_query->forPage($request->curr_page, $request->itens_per_page)->get());
		$rt->setTotalRecords($linhas_query->count());
		return $rt->getResponse();
	}

}