<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Filas;
use Auth;

class FilasDataTables extends Controller
{

/**
 * Displays datatables front end view
 *
 * @return \Illuminate\View\View
 */
public function index(){
    return $this->render('users');
}

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData()
{
    $filas = Auth::user()->assinante
						  ->filas()
						  ->withIdMd5()
						  ->with(['linhas'=>function($query){
						  		$query->orderBy('posicao', 'asc');
						  		$query->select('nome');
						  }])
						  ->get();

    return Datatables::of($filas)->make(true);
}

}