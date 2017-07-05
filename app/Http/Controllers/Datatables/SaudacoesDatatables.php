<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assinantes\Assinantes;
use Datatables;
use DB;
use Auth;

class SaudacoesDatatables extends Controller
{

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData()
{	
	$saudacoes = Auth::user()->assinante
							  ->saudacoes()
							  ->withIdMd5()
							  ->get();

    return Datatables::of($saudacoes)
    				 ->make(true);
}

}