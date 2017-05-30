<?php

namespace App\Http\Controllers\Datatables\Clientes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assinantes\Assinantes;
use Datatables;
use DB;

class AssinantesDataTables extends Controller
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
    $users = Assinantes::select(DB::raw('IF(nome is null, nome_fantasia, nome) as nome'),
    							DB::raw('MD5(id) as id_md5'),
    							DB::raw("IF(tipo = 0, 'PF', 'PJ') as tipo")
    							)
    					->with('planobj')
    					->get();

    dd($users);
    return Datatables::of($users)->make(true);
}

}