<?php

namespace App\Http\Requests\Validators\Linhas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use DB;

class LinhasUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $ignore = $this->isMethod("put");
        $basicos = array(
                            "ddd_local"=>"sometimes|max:9999|integer",
                            "nome"=>"required|max:25|unique:linhas,nome".($ignore ? ','.$this->get('_id') : ''),
                            "plano"=>"required|not_in:0",
                            "assinante"=>"required|not_in:0",
                            "status_did"=>"sometimes|nullable",
                            "simultaneas"=>"sometimes|integer",
                            "codecs"=>"nullable|array");

       /* $autenticacao = array("login_ata"=>"required|min:3|max:25|unique:dados_autenticacao_linhas,login_ata".($ignore ? ','.$this->get('_id') : ''),
                                "usuario"=>"required|min:3|max:25|unique:dados_autenticacao_linhas,usuario".($ignore ? ','.$this->get('_id') : ''),
                                "senha"=>"required|min:3|max:25",
                                "numero"=>"required|min:3|max:25",
                                "ip"=>"sometimes|ip|required_with:porta|unique_combined:porta,dados_autenticacao_linhas,porta".($ignore ? ','.$this->get('_id') : ''),
                                "porta"=>"sometimes|min:2|max:6|required_with:ip",
                                "tech_prefix"=>"");
*/

        $configuracoes = array("callerid"=>"sometimes|min:3|max:25",
                                "envio_dtmf"=>"sometimes",
                                "ring_falso"=>"sometimes|boolean",
                                "nat"=>"sometimes|boolean");

/*
        $did = array("usuario_did"=>"required_if:status_did, 1|regex:/^[A-Za-z0-9-]+$/iu|unique:dids,usuario_did".($ignore ? ','.$this->get('_id_did') : ''),
                      "senha_did"=>"required_if:status_did, 1|regex:/^[A-Za-z0-9-]+$/iu",
                      "ip_did"=>"ip|required_if:status_did, 1",
                      "extensao_did"=>"required_if:status_did, 1|regex:/^[A-Za-z0-9-]+$/iu|unique:dids,extensao_did".($ignore ? ','.$this->get('_id_did') : ''));
*/

        $facilidades = array( "gravacao"=>"sometimes|boolean",
                                "cadeado_pessoal"=>"sometimes|boolean",
                                "siga_me"=>"sometimes|boolean",
                                "caixa_postal"=>"sometimes|boolean",
                                "cadeado_pin"=>"required_if:cadeado_pessoal,1",
                                "num_siga_me"=>"required_if:siga_me,1",
                                "cx_postal_pw"=>"required_if:caixa_postal,1");
                                //"atend_automatico"=>"required|boolean",
                                //"atend_automatico_tipo"=>"required_if:atend_automatico,1",
                                //"atend_automatico_destino"=>"required_if:atend_automatico,1"

        $permissoes = array("ligacao_fixo"=>"sometimes|boolean",
                                    "ligacao_internacional"=>"sometimes|boolean",
                                    "ligacao_movel"=>"sometimes|boolean",
                                    "ligacao_ip"=>"sometimes|boolean",
                                    "status"=>"sometimes|boolean");


        return array_merge($basicos, $configuracoes, $facilidades, $permissoes);
    }

    public function response(Array $errors){
       return response()->json(["validation_errors"=>collect($errors)->flatten()], 400);
    }
}
