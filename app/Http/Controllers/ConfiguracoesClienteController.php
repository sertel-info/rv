<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use App\Models\Linhas\Linhas;
use App\Http\Controllers\SessionController;
use App\Events\ItensModificados;
use App\Http\Requests\Validators\LinhasValidatorCliente;

class ConfiguracoesClienteController extends Controller
{

    public function index(){

    	$user = $this->getUsuario();

    	if($user->role !== 1){
    		return abort(404);
    	}

        return view('rvc.config.index', ['panel_title'=>'Configurações',
    								     'active'=>'config',
    								     'usuario'=>$user]);
    }

    public function updateLinha(LinhasValidatorCliente $request){

        try{
            $usuario = $this->getUsuario();

            $linha = $usuario->assinante->linhas->filter(function($line) use ($request){
                return md5($line->id) == $request->l;
            })->first();

            $novos_attrs = $this->getData($request->only($linha->facilidades->getFillable()));

            $linha->facilidades->update($novos_attrs);

            event( new ItensModificados() );
            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rvc.config.index');

        } catch (\Exception $ex){
            SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");
            dd($ex);
            return redirect()->back()->withInput();
        }

    	return redirect()->route('rvc.config.index');
    }

    public function getData($request){


         if($request['cadeado_pessoal'] == null){
            $request['cadeado_pin'] = null;
         }

         if($request['caixa_postal'] == null){
            $request['cx_postal_pw'] = null;
            $request['cx_postal_email'] = null;
         }

         if($request['siga_me'] == null){
            $request['num_siga_me'] = null;
         }

         return $request;
    }


    public function getUsuario(){
       return User::where('id', Auth::id())->with('assinante.linhas.facilidades',
       											  'assinante.linhas.configuracoes')
                                            ->first();
    }
}
