<?php

namespace App\Models\Notificacoes;

use Illuminate\Database\Eloquent\Model;

class EnviosEmailsNotificacoes extends Model
{
    protected $table = "envios_emails_notificacoes";

    protected $fillable = ["notificacoes_users_id", "status"];
    
    public function notificacao_user(){
    	return $this->belongsTo('App\Models\Notificacoes\NotificacoesUser', 'notificacoes_users_id', 'id');
    }
}
