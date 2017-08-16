<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Gravacoes;
use Auth;
use DB;

class GravacoesController extends Controller
{
    
    function __construct(Gravacoes $gravacoes){
    	$this->entity = $gravacoes;
    }

    public function index(){
    	return view('rvc.gravacoes.index', ['active'=>'gravacoes',
    										'panel_title'=>'Gravações']);
    }

    public function getUsuario(){
    	 return User::where('id', Auth::id())->with('assinante.linhas.facilidades',
    	 											'assinante.linhas.configuracoes',
    	 											'assinante.linhas.autenticacao')
                                             ->first();
    }


    public function downloadGravacao(Request $request){
        $linhas = $this->getUsuario()->assinante->linhas;
        $linhas_callerid = $linhas->pluck('configuracoes.callerid')->toArray();
        $linhas_login_ata = $linhas->pluck('autenticacao.login_ata')->toArray();
        $linhas_dids = $linhas->pluck('dids.extensao_did')->toArray();
        $identificadores_linhas = array_unique(array_merge($linhas_callerid, $linhas_login_ata, $linhas_dids));

        $gravacao = $this->entity->where('unique_id', $request->f)
                                 ->leftjoin('cdr', 'cdr.uniqueid', '=', 'gravacoes.unique_id')
                                 ->first();

        if(!(in_array($gravacao->src, $identificadores_linhas) ||
             in_array($gravacao->dst, $identificadores_linhas) ||
             in_array($gravacao->exten, $identificadores_linhas) ||
             in_array($gravacao->callerid, $identificadores_linhas))){

             abort(403, 'Ação não autorizada');
        }

    	try{
	    	
	    	$headers = array('Content-Type'=>'audio/mpeg');
            $file_name = basename($gravacao->arquivo);
	    	return response()->download($gravacao->arquivo, $file_name, $headers);
	    
	    } catch (\Exception $e){
	    	abort(404);
	    }
    }


    public function getBlob($id){
        $linhas = $this->getUsuario()->assinante->linhas;
        $linhas_callerid = $linhas->pluck('configuracoes.callerid')->toArray();
        $linhas_login_ata = $linhas->pluck('autenticacao.login_ata')->toArray();
        $linhas_dids = $linhas->pluck('dids.extensao_did')->toArray();
        $identificadores_linhas = array_unique(array_merge($linhas_callerid, $linhas_login_ata, $linhas_dids));

 		$gravacao = $this->entity->where('unique_id', $id)
                                 ->leftjoin('cdr', 'cdr.uniqueid', '=', 'gravacoes.unique_id')
                                 ->first();

        if(!(in_array($gravacao->src, $identificadores_linhas) ||
             in_array($gravacao->dst, $identificadores_linhas) ||
             in_array($gravacao->exten, $identificadores_linhas) ||
             in_array($gravacao->callerid, $identificadores_linhas))){

             abort(403, 'Ação não autorizada');
        }

    	$headers = array('Content-Type'=>'audio/x-wav');
    	
        $file = pathinfo($gravacao->arquivo);
    	return response()->file($file['dirname'] .'/'. $file['filename'] . '.wav', $headers);
    }

    public function corrigir(){
        $gravacoes = \App\Models\Gravacoes::leftjoin('cdr', 'cdr.uniqueid', '=', 'gravacoes.unique_id')
                                            ->where('data', '0000-00-00 00:00:00')->get();


        foreach($gravacoes as $g){
            $g->update(['data'=>$g->calldate]);
        }
    }

}
