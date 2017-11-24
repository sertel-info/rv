<?php

namespace App\Http\Requests\Validators;

use App\Models\Filas;
use App\Http\Requests\ValidatedRequest;

class FilasValidator extends ValidatedRequest
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
        $is_editing = $this->get("f") !== null;
        
        return [
            'nome'=>'required|string|min:3|max:15|unique:filas,nome'.($is_editing ? ",".$this->get("f") : "" ),
            'tipo'=>'required',
            'tempo_chamada'=>'required',
            'regra_transbordo'=>'required'
        ];
    }
}
