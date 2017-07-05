<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assinantes\Assinantes;
use Datatables;
use DB;
use Auth;

class GruposAtendimentoDatatables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData()
{	
	$grupos = Auth::user()->assinante
						  ->grupos()
						  ->withIdMd5()
						  ->with(['linhas'=>function($query){
						  		$query->orderBy('posicao', 'asc');
						  		$query->select('nome');
						  }])
						  ->get();

    return Datatables::of($grupos)
    				 ->make(true);
}

}