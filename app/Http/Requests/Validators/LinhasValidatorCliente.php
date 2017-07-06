<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LinhasValidatorCliente extends FormRequest
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

        $facilidades = array( "gravacao"=>"sometimes|boolean",
                               "cadeado_pessoal"=>"sometimes|boolean",
                               "siga_me"=>"sometimes|boolean",
                               "caixa_postal"=>"sometimes|boolean",
                               "cadeado_pin"=>"required_with:cadeado_pessoal",
                               "num_siga_me"=>"required_with:siga_me",
                               "cx_postal_pw"=>"required_with:caixa_postal",
                               "saudacoes_destino"=>"required_with:saudacoes",
                               "cx_postal_email"=>"required_with:caixa_postal",
                               "atend_automatico"=>"boolean",
                               "atend_automatico_tipo"=>"required_if:atend_automatico,1",
                               "atend_automatico_destino"=>"required_if:atend_automatico,1" );

        return $facilidades;
    }
}
