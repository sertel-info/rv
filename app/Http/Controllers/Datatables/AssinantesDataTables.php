<?php

namespace App\Http\Controllers\Datatables;

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

/*public function index(){
    return $this->render('users');
}*/

/**
 * Process datatables ajax request.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function anyData()
{
    $assinantes = Assinantes::select(DB::raw("IF(tipo,concat(nome, ' ',sobrenome),nome_fantasia) as nome_completo,
                                                        IF(tipo=1,'PF','PJ') as tipo,
                                                        MD5(id) as id_md5,
                                                        plano
                                                    "))
                                    ->with(["planos"=>function($query){
                                            $query->select("nome", "id");
                                     }])
                                    ->get();

    return Datatables::of($assinantes)->make(true);
}

}