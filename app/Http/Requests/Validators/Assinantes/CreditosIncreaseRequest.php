<?php

namespace App\Http\Requests\Validators\Assinantes;

use Illuminate\Validation\Rule;
use DB;
use App\Http\Requests\ValidatedRequest;

class CreditosIncreaseRequest extends ValidatedRequest
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
        return array(
                "c_add"=>"required|min:0.01"
                );
    }

}
