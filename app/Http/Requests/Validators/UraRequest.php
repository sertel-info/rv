<?php

namespace App\Http\Requests\Validators;

use Illuminate\Validation\Rule;
use DB;
use App\Http\Requests\ValidatedRequest;

class UraRequest extends ValidatedRequest
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
        $is_editing = $this->get("u") !== null;

        return array(
                "nome"=>"required|unique:uras,nome".($is_editing ? ','.$this->get('u') : ''),
                "arquivo_audio"=> ($is_editing ? "sometimes|file" : "required|file"),
                "digito_0"=>"required",
                "digito_1"=>"required",
                "digito_2"=>"required",
                "digito_3"=>"required",
                "digito_4"=>"required",
                "digito_5"=>"required",
                "digito_6"=>"required",
                "digito_7"=>"required",
                "digito_8"=>"required",
                "digito_9"=>"required",
                "digito_tralha"=>"required",
                "digito_ast"=>"required",
                "digito_ast"=>"required"
                );
    }

}
