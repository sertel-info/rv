<?php

namespace App\Http\Controllers\Clientes;

use Illuminate\Http\Request;
use App\Models\Configuracoes;
use App\Events\ItensModificados;
use App\Http\Controllers\Controller;
use JWTAuth;

class ConfiguracoesController extends Controller
{	
	/*function __construct(Configuracoes $cfg){
		$this->entity = $cfg;
	}*/
    
    /* Retorna as permissões da linha, para saber quais
    *  opções exibir no menu de configurações
    */
    public function getPermissaoLinha(Request $request){
        try{
        
            $assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
            $linha = $assinante->linhas()->find($request->l);
            $permissoes_linha = $assinante->facilidades;
            //obj que será retornado
            $permissoes = [   
                            "cadeado" => $permissoes_linha->acesso_cadeado,
                            "caixa_postal" => $permissoes_linha->acesso_cx_postal,
                            "siga_me" => $permissoes_linha->acesso_siga_me,
                            "atendimento_automatico" => $permissoes_linha->acesso_at_automatico,
                            "saudacoes" => $permissoes_linha->saudacoes
                          ];

            return response()->json($permissoes, 200);

        } catch (\Exception $e){
            return response("", 500);
        }
    }


    public function update(Request $request){
    	try{
			$assinante = JWTAuth::toUser($request->cookie("token"))->assinante;
            $linha = $assinante->linhas()->where("id", $request->l)->first();
            $facil_linhas = $linha->facilidades;

            $facil_linhas->fill($request->only(['cadeado_pessoal',
                                                'siga_me',
                                                'caixa_postal',
                                                'cadeado_pin',
                                                'num_siga_me',
                                                'cx_postal_pw',
                                                'cx_postal_email',
                                                'saudacoes',
                                                'saudacoes_destino']));

            $facil_linhas->atend_automatico = $request->at_automatico;
            $facil_linhas->atend_automatico_destino = $request->at_automatico_dest;
            $facil_linhas->save();

            return response('', 200);

        } catch (\Exception $e){
           return response('', 500);
        }
    }

    public function getLinhaConfData(Request $request){
        
        try{
            
            $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
            $linha = $assinante->linhas()
                                ->with(['facilidades'=>function($query){
                                    $query->select('cadeado_pessoal',
                                                    'cadeado_pin',
                                                    'siga_me',
                                                    'num_siga_me',
                                                    'caixa_postal',
                                                    'cx_postal_email',
                                                    'cx_postal_pw',
                                                    'linha_id',
                                                    'atend_automatico',
                                                    'atend_automatico_tipo',
                                                    'atend_automatico_destino');
                                }])
                                ->where("id", $request->l)
                                ->first();
                                
            return response()->json(['conf'=>$linha->facilidades]);

        } catch(\Exception $e){
            return response('', 500);
        }
    }
   
    /*
    *
    * Retorna as opções possíveis para o menu do atendimento automático
    * na tela de configurações do cliente
    */
    public function getAtAutomaticoOpts(Request $request){
        $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
        $uras = $assinante->uras()->select("nome", "id")->get();
        $filas = $assinante->filas()->select("nome", "id")->get();
        $grupos = $assinante->grupos()->select("nome", "id")->get();

        return response()->json([
                                  "uras"=>$uras,
                                  "filas"=>$filas,
                                  "grupos"=>$grupos
                                ], 200);
    }

    /*
    *
    * Retorna a lista de saudações possíveis para escolher
    * na tela de configurações do cliente
    */
    public function getSaudacoesList(Request $request){
        try{
        
            $assinante = JWTAuth::toUser($request->cookie('token'))->assinante;
            $saudacoes = $assinante->saudacoes()->select('id',  'nome')->get();

            return response()->json($saudacoes, 200);
        
        } catch(\Exception $e){

            return response('', 500);

        }
    }
}
