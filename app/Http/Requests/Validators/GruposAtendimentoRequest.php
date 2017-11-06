<?php

namespace App\Http\Requests\Validators;

use App\Http\Requests\ValidatedRequest;

class GruposAtendimentoRequest extends ValidatedRequest
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
        $ignore = $this->get("g") !== null;

        return [
            'nome'=>'required|between:3,20|unique:grupos_atendimento,nome'.
                                                        ($ignore ? ','.$this->get("g") : ''),
            'tipo'=>'required',
            'linhas'=>'required',
            'tempo_chamada'=>'required|in:10,20,30,40,50,60,70,80,90,100'
        ];
    }
}
