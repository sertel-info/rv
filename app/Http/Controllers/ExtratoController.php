<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cdr;
use App\User;
use Auth;
use DB;

class ExtratoController extends Controller
{
    
    function __construct(Cdr $cdr){
    	$this->entity = $cdr;
    }

    public function index(){
    	$linhas = $this->getUsuario()->assinante->linhas;

    	return view('rvc.extrato.index', ['active'=>'extrato',
    									  'panel_title'=>'Extrato',
    									  'linhas'=>$linhas]);
    }


    public function dataTables($id){
        try{
            $linha = \App\Models\Linhas\Linhas::where(DB::raw('md5(id)'), $id)
                                    ->with('autenticacao')
                                    ->with('configuracoes')
                                    ->with('did')
                                    ->first();


            $identificadores_linhas = $this->getIdentificadoresLinha($linha);

            $gravacoes = $this->entity->where(function ($query) use ($identificadores_linhas){
                                            $query->whereIn('dst', $identificadores_linhas)
                                                   ->orWhere(function($query) use ($identificadores_linhas){
                                                        $query->whereIn('src', $identificadores_linhas);
                                                   });
                                   
                          })->get();

            $status = 1;
        } catch(\Exception $e){
            $status = 0;
        }
        
    	return json_encode(['data'=>$gravacoes,
                            'status'=>1]);
    }

    public function getIdentificadoresLinha($linha){
        $array_ids = array();

        if(isset($linha->did))
            array_push($array_ids, $linha->did->extensao_did);

        if(isset($linha->autenticacao))
            array_push($array_ids, $linha->autenticacao->login_ata);

        if(isset($linha->configuracoes))
            array_push($array_ids, $linha->configuracoes->callerid);

        $identificadores_linhas = array_unique($array_ids);

        $identificadores_linhas = array_filter($identificadores_linhas, function($el){
            return $el !== null && !empty($el);
        });

       return $identificadores_linhas;
    }


    public function getUsuario(){
    	 return User::where('id', Auth::id())->with('assinante.linhas.facilidades',
    	 											'assinante.linhas.configuracoes',
    	 											'assinante.linhas.autenticacao')
                                             ->first();
    }

    public function show($id){
        $linha = $this->getUsuario()->assinante->linhas()->where(DB::Raw('MD5(id)'), $id)->first();
        return view('rvc.extrato.show', ['linha'=>$linha, 'active'=>'extrato']);
    }
}
