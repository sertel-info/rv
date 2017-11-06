<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\User;
use App\Models\Gravacoes;
use JWTAuth;
use DB;
use App\Http\Controllers\Controller;

class GravacoesController extends Controller
{
    
    function __construct(Gravacoes $gravacoes){
    	$this->entity = $gravacoes;
    }

    /*public function getUsuario(){
    	 return User::where('id', Auth::id())->with('assinante.linhas.facilidades',
    	 											'assinante.linhas.configuracoes',
    	 											'assinante.linhas.autenticacao')
                                             ->first();
    }*/


    public function download(Request $request){
        $assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
        $linhas = $assinante->linhas;
        //$linhas_callerid = $linhas->pluck('configuracoes.callerid')->toArray();
        //$linhas_login_ata = $linhas->pluck('autenticacao.login_ata')->toArray();
        //$linhas_dids = $linhas->pluck('dids.extensao_did')->toArray();
        //$identificadores_linhas = array_unique(array_merge($linhas_callerid, $linhas_login_ata, $linhas_dids));

        try{
            
            $gravacao = $this->entity->where('unique_id', $request->f)
                                 ->leftjoin('cdr', 'cdr.uniqueid', '=', 'gravacoes.unique_id')
                                 ->where(function($query) use ($linhas){
                                        $query->whereIn("accountcode", $linhas->pluck("autenticacao.login_ata")->toArray());
                                        $query->orWhereIn("peeraccount", $linhas->pluck("autenticacao.login_ata")->toArray());
                                 })
                                 ->first();

	    	$headers = array('Content-Type'=>'audio/x-wav');
            $file = pathinfo($gravacao->arquivo);
            
            return response()->file($file['dirname'] .'/'. $file['filename'] . '.wav', $headers);
	    
	    } catch (\Exception $e){
            dd($e);
	    	return response("", 500);
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

   /* public function corrigir(){
        $gravacoes = \App\Models\Gravacoes::leftjoin('cdr', 'cdr.uniqueid', '=', 'gravacoes.unique_id')
                                            ->where('data', '0000-00-00 00:00:00')->get();


        foreach($gravacoes as $g){
            $g->update(['data'=>$g->calldate]);
        }
    }*/

}
