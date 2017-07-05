<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class SaudacoesValidator extends FormRequest
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
        $rules = [
            'nome' => 'string:max:15',
            'tipo_audio' => "required",
        ];

        if($this->isMethod("post")){
            $rules['arquivo_audio'] = "required|file|mimes:wav";
        }

        return $rules;
    }
}
