<?php

namespace App\Http\Requests\Validators\Notificacoes;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Filas;

class NotificacoesCreateValidator extends FormRequest
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
            'nome'=>'required|string|min:3|max:40|unique:filas,nome',
            'escutar_evento'=>'required|not_in:none',
            "mensagem"=>"required|string|min:3|max:100",
            "titulo"=>"required|string|min:3|max:25",
            "nivel"=>"required|in:warning,success,danger",
            "intervalo_reenvio"=>"",
            "numero_envios"=>"integer|min:1",
            "email_assunto"=>"required_if:ativar_email,1",
            "email_corpo"=>"required_if:ativar_email,1"
        ];
    }
}
