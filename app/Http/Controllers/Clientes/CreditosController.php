<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use DB;
use App\Models\Assinantes\Assinantes;
use App\Http\Controllers\Controller;
use App\Events\Creditos\CreditosAdicionados;
use App\Events\Creditos\CreditosRemovidos;
use App\Models\AtualizacaoCreditos;
use Auth;

class CreditosController extends Controller
{   

    public function getCredits(Request $request){
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
    }

    public function increase(Request $request){
        if(!$request->ajax() || Auth::user()->role != 0){
            abort(404);
        }

        try{

            $user = $request->u;
            $valor_mais = $request->c_add;
            $assinante = Assinantes::where(DB::raw('MD5(assinantes.id)'), $user)
                                                                  ->with('financeiro')
                                                                  ->first();
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
            return json_encode(["status"=>1, 
                                 "novo_valor"=>$qtd_creditos_nova]);

        } catch (\Exception $e){
          DB::rollback();
          return json_encode(["status"=>0]);            
        }
    }

    public function decrease(Request $request){
       if(!$request->ajax() || Auth::user()->role !== 0){
            return json_encode(['status'=>0]);
       }

       try{

          $user = $request->u;
          $valor_menos = $request->c_rmv;
          $assinante = Assinantes::where(DB::raw('MD5(assinantes.id)'), $user)
                                                                ->with('financeiro')
                                                                ->first();
          
          $qtd_creditos_atual = $assinante->financeiro->creditos;
          $qtd_creditos_nova = floatval($qtd_creditos_atual)-floatval($valor_menos);
          event(new CreditosRemovidos($assinante, $request));

          if($qtd_creditos_nova < 0){
              return json_encode(["status"=>-1, 
                                   "novo_valor"=>$qtd_creditos_nova]);
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
          return json_encode(["status"=>1, 
                               "novo_valor"=>$qtd_creditos_nova]);

        } catch (\Exception $e){
          DB::rollback();
          return json_encode(["status"=>0]);            
        }
    }
}