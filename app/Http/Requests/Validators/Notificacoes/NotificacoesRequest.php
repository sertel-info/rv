<?php

namespace App\Http\Requests\Validators\Notificacoes;

use App\Http\Requests\ValidatedRequest;
use Illuminate\Validation\Rule;
use DB;

class NotificacoesRequest extends ValidatedRequest
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
        $ignore = $this->get('n') !== null;

        return [
            'nome'=>'required|string|min:3|max:40|unique:notificacoes,nome'.($ignore ? ','.$this->get('n') : ''),
            'escutar_evento'=>'required|not_in:none',
            "mensagem"=>"required|string|min:3|max:100",
            "titulo"=>"required|string|min:3|max:25",
            "nivel"=>"required|in:warning,success,danger",
            "numero_envios"=>"integer|min:1",
            "email_assunto"=>"required_if:ativar_email,1",
            "email_corpo"=>"required_if:ativar_email,1"
        ];
    }

}
