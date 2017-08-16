<?php

namespace App\Models\Notificacoes;

use Illuminate\Database\Eloquent\Model;

class EnviosEmailsNotificacoesFlash extends Model
{
    protected $table = "envios_emails_notif_flash";

    protected $fillable = ["notif_flash_users_id", "status"];
    
    public function notificacao_user(){
    	return $this->belongsTo('App\Models\Notificacoes\NotificacoesFlashUsers', 'notificacoes_users_id', 'id');
    }
}
