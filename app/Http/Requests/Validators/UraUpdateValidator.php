<?php

namespace App\Http\Requests\Validators;

use Illuminate\Foundation\Http\FormRequest;

class UraUpdateValidator extends FormRequest
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
        $rules = array();

        for($i = 1; $i <10; $i++){
            $rules["dig_".$i."_tipo"] = "required_unless:dig_".$i."_destino,0";
            $rules["dig_".$i."_destino"] = "required_unless:dig_".$i."_tipo,0";
        }

        $rules["dig_tralha_tipo"] = "";
        $rules["dig_tralha_destino"] = "required_with:dig_tralha_tipo";

        $rules["dig_asteristico_tipo"] = "";
        $rules["dig_asteristico_destino"] = "required_with:dig_asteristico_tipo";

        $rules['tipo_audio'] = "required";
        $rules['arquivo_audio'] = "required|file|mimes:wav";

        return $rules;
    }
}
