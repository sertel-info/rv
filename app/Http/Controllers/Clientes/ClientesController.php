<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use App\Models\Linhas\Linhas;
use App\Events\ItensModificados;
use App\Http\Requests\Validators\LinhasValidatorCliente;
use JWTAuth;

class ClientesController extends Controller
{

    /*
    * Retorna os dados do cliente para serem exibidos
    * no cabeçalho da left bar do cliente
    */
    public function getHeaderData(Request $request){
        $token = $request->cookie('token');
        $cliente = JWTAuth::toUser($token);

        $assinante = $cliente->assinante()->with('financeiro')->first();
        $nome = $assinante->nome == null ? $assinante->nome_fantasia : $assinante->nome;
        
        if(mb_strlen($nome, 'utf8') > 15){
            $nome = substr($nome, 0, 8)."...";
        }            

        if($request->cookie("morphed") !== null)
          $morphed_name = \App\User::find($request->cookie("morphed"))->name;
        else 
          $morphed_name = null;

        return response()->json(['username'=>$nome,
                                 'credits'=>$assinante->financeiro->creditos,
                                 'morphed'=>$request->cookie('morphed'),
                                 'morphed_name'=>$morphed_name
                                  ]);
    }

    /*
    public function getUsuario(){
       return User::where('id', Auth::id())->with('assinante.linhas.facilidades',
       											  'assinante.linhas.configuracoes')
                                            ->first();
    }

    public function update(Request $request){
        $updt_ctrl = new UpdateController();
        $dados = $request->only('password', 'email', 'password_confirmation');
        
        $validator = $updt_ctrl->validator($dados, Auth::id());
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $updt_ctrl->update(Auth::user(), $dados);
        
        Session::flash("msg_type", "success");
        Session::flash("msg_title", "Sucesso !");
        Session::flash("msg_txt", "Usuário atualizado com sucesso");

        return redirect()->route("index");
    }

    public function getLinhas(Request $request){
        return Auth::user()->assinante->linhas()
                                      ->select('nome')
                                      ->withIdMd5()
                                      ->get()
                                      ->toJson();
    }

    public function getGrupos(Request $request){
        return Auth::user()->assinante->grupos()
                                      ->select('nome')
                                      ->withIdMd5()
                                      ->get()
                                      ->toJson();
    }    


    public function config($id){

        $user = $this->getUsuario();
        
        $linha = $user->assinante->linhas()
                                  ->with("facilidades")
                                  ->select(DB::raw("*, MD5(assinante_id) as assinante_id"))
                                  ->withIdMd5()
                                  ->whereRaw("MD5(id) = '".$id."'")
                                  ->first();

        if($user->role !== 1){
          return abort(404);
        }

        return view('rvc.config.edit', ['panel_title'=>'Configurações',
                                         'active'=>'config',
                                         'usuario'=>$user,
                                         'linha'=>$linha]);
    }

    public function updateLinha(LinhasValidatorCliente $request){

        try{
            $usuario = $this->getUsuario();

            $linha = $usuario->assinante->linhas->filter(function($line) use ($request){
                return md5($line->id) == $request->l;
            })->first();

            $novos_attrs = $this->getData($request->only($linha->facilidades->getFillable()));

            if($novos_attrs['atend_automatico_tipo'] == 'ura'){
               $ura = $usuario->assinante->ura()->withIdMd5()->first();
               if($ura !== null){
                  $novos_attrs['atend_automatico_destino'] = $ura->id_md5;
               } else {
                  $novos_attrs['atend_automatico_destino'] = null;
               }
               
            }

            $linha->facilidades->update($novos_attrs);

            event( new ItensModificados() );
           
            SessionController::flashMessage("success", "Sucesso ", "Configurações atualizadas com sucesso");

            return redirect()->route('rvc.config.index');

        } catch (\Exception $ex){
            dd($ex);
            SessionController::flashMessage("danger", "Ops ", "Um erro inesperado ocorreu, tente novamente.");
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

         if(is_null($request['atend_automatico'])){
            $request['atend_automatico_tipo'] = null;
            $request['atend_automatico_destino'] = null;
         }

         if(is_null($request['atend_automatico_tipo'])){
            $request['atend_automatico'] = null;
            $request['atend_automatico_destino'] = null;
         }

         if(is_null($request['atend_automatico_destino']) && $request['atend_automatico_tipo'] != "ura"){
            $request['atend_automatico'] = null;
            $request['atend_automatico_tipo'] = null;
         }

         if(is_null($request['atend_automatico'])){
            $request['atend_automatico_tipo'] = null;
            $request['atend_automatico_destino'] = null;
         }

         if(is_null($request['saudacoes'])  || $request['saudacoes_destino'] == 'no') {
            $request['saudacoes_destino'] = null;
         }

         if(is_null($request['saudacoes_destino'])){
            $request['saudacoes'] = null;
         }

         return $request;
    }*/

}
