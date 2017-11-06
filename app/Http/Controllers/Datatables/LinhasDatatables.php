<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Linhas\Linhas;
use ReactTable;
use DB;
use Auth;

class LinhasDatatables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData(Request $request)
{	
	$linhas = Linhas::withIdMd5()->with(["assinante"=>function($query){
		$query->selectRaw("*, IF(ISNULL(nome), nome_fantasia, nome) as nome, MD5(id) as id_md5");
	}]);
	$rt = new ReactTable();
	$rt->setData($linhas->forPage($request->curr_page, $request->itens_per_page)->get());
	$rt->setTotalRecords(Linhas::count());
	return $rt->getResponse();
}

}