<?php

namespace App\Http\Requests\Validators\Assinantes;

use App\Http\Requests\ValidatedRequest;
use Illuminate\Validation\Rule;
use DB;

class NotificacoesFlashRequest extends ValidatedRequest
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
                "titulo"=>"required",
                "mensagem"=>"required",
                "nivel"=>"required"
                /*"email_assunto":"required_if:ativar_email,1",
                "email_corpo":"required_if:ativar_email,1",
                "ativar_email":"required:1"*/
                );
    }
}
