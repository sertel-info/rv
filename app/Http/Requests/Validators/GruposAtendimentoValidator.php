<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class GruposAtendimentoValidator extends FormRequest
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
        return [
            'nome'=>'required|between:3,20',
            'tipo'=>'required',
            'linhas'=>'required',
            'tempo_chamada'=>'required|in:10,20,30,40,50,60,70,80,90,100'
        ];
    }
}
