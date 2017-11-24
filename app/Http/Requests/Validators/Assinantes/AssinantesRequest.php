<?php

namespace App\Http\Requests\Validators\Assinantes;

use Illuminate\Validation\Rule;
use DB;
use App\Http\Requests\ValidatedRequest;

class AssinantesRequest extends ValidatedRequest
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
        /*para ignorar o User do assinante */
        $ignore_user = $this->get("u") !== null;

        $basicos = array("tipo" => "required|in:PJ,PF",
                          "nome" => "required_if:tipo,PF",
                          "sobrenome" => "required_if:tipo,PF",
                          "cpf" => "required_if:tipo,PF",
                          "nome_fantasia" => "required_if:tipo,PJ",
                          "razao_social" => "required_if:tipo,PJ",
                          "cnpj" => "required_if:tipo,PJ",
                          "plano" => "required");

        $acesso = array("nome_acesso"=>"required|max:25",
                        "email_acesso"=>"required|unique:users,email".
                                                                  ($ignore_user ? ','.$this->get('u') : ''),
                        "senha_acesso"=>"required",
                        "status"=>"required|boolean");

        return array_merge($basicos, $acesso);
    }

}
