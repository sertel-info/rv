<?php

namespace App\Http\Requests\Validators\Planos;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ValidatedRequest;

class PlanosRequest extends ValidatedRequest
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
        $ignore = $this->get("p") !== null;

        return [
            "nome" => "required|min:3|max:20|unique:planos,nome".($ignore ? ','.$this->get("p") : ""),
            "valor_sms" => "required",
            "valor_fixo_local" => "required",
            "valor_fixo_ddd" => "required",
            "valor_movel_local" => "required",
            "valor_movel_ddd" => "required",
            "valor_ddi" => "required",
            "valor_ip" => "required",
            "valor_movel_entrante" => "required",
            "valor_fixo_entrante" => "required",
        ];
    }
}
