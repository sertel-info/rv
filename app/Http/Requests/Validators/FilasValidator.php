<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Filas;

class FilasValidator extends FormRequest
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
        $isEditing = $this->isMethod("put");
        
        if($isEditing){
            $fila = Filas::select('id')->whereRaw("MD5(id) = '".$this->f."'")->first();
        }
        
        return [
            'nome'=>'required|string|min:3|max:15|unique:filas,nome'.($isEditing ? ",".$fila->id : "" ),
            'tipo'=>'required',
            'tempo_chamada'=>'required',
            'regra_transbordo'=>'required'
        ];
    }
}
