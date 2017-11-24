<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ValidatedRequest;

class SaudacoesRequest extends ValidatedRequest
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

        if($this->get("s") === null){
            $rules['arquivo_audio'] = "required|file|mimes:wav";
        }

        return $rules;
    }
}
