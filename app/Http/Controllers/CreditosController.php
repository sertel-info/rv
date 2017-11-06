<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Assinantes\Assinantes;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validators\Assinantes\CreditosIncreaseRequest;
use App\Events\Creditos\CreditosAdicionados;
use App\Events\Creditos\CreditosRemovidos;
use App\Models\AtualizacaoCreditos;
use Auth;

class CreditosController extends Controller
{   

    /*public function getCredits(Request $request){
        if(!$request->ajax() || Auth::user()->role != 0){
            return json_encode(['status'=>0]);
        } 

        $id = $request->u; 

        $assinante = Assinantes::where(DB::raw('MD5(assinantes.id)'), $id)
                                                            ->with('financeiro')
                                                            ->first();

        if($assinante){
            return json_encode(['status'=>1, 'credits'=>$assinante->financeiro->creditos]);
        }

        return json_encode(['status'=>0]);
    }*/

    public function increase(CreditosIncreaseRequest $request){

        try{

            $user = $request->u;
            $valor_mais = $request->c_add;
            $assinante = Assinantes::with('financeiro')
                                     ->find($user);

            $qtd_creditos_atual = $assinante->financeiro->creditos;         
            $qtd_creditos_nova = floatval($qtd_creditos_atual)+floatval($valor_mais);
            
            DB::beginTransaction();
            $assinante->financeiro->update(['creditos'=>$qtd_creditos_nova]);
            
            //cria o registro de atualização nos créditos
            $atualizacao = new AtualizacaoCreditos();
            $atualizacao->value = floatval($valor_mais);
            $atualizacao->assinante_id = $assinante->id;
            $atualizacao->valor_anterior = floatval($qtd_creditos_atual);
            $atualizacao->save();

            event(new CreditosAdicionados($assinante, $request));
            DB::commit();
            return response('', 200);

        } catch (\Exception $e){
          DB::rollback();

          return response('', 500);       
        }
    }

    public function decrease(Request $request){

       try{

          $user = $request->u;
          $valor_menos = $request->c_rmv;
          $assinante = Assinantes::with('financeiro')
                                     ->find($user);

          
          $qtd_creditos_atual = $assinante->financeiro->creditos;
          $qtd_creditos_nova = floatval($qtd_creditos_atual)-floatval($valor_menos);
          event(new CreditosRemovidos($assinante, $request));

          if($qtd_creditos_nova < 0){
              return response(['validation_errors'=>[
                                    'Não é possível remover mais do que '.$qtd_creditos_atual." R$"
                                    ]], 400);
          }

          DB::beginTransaction();
          $assinante->financeiro->update(['creditos'=>$qtd_creditos_nova]);

          //cria o registro de atualização nos créditos
          $atualizacao = new AtualizacaoCreditos();
          $atualizacao->value = -floatval($valor_menos);
          $atualizacao->assinante_id = $assinante->id;
          $atualizacao->valor_anterior = floatval($qtd_creditos_atual);
          $atualizacao->save();
          
          DB::commit();
          return response('', 200);

        } catch (\Exception $e){
          DB::rollback();
          dd($e);
          return response('', 500); 
        }
    }
}