<?php

namespace App\Models\Notificacoes;

use Illuminate\Database\Eloquent\Model;
use DB;

class NotificacoesFlashUsers extends Model
{
  	protected $table = "notificacoes_flash_users";


	public function notificacao(){
		return $this->belongsTo('App\Models\Notificacoes\NotificacoesFlash', 'notificacao_flash_id', 'id');
	}


    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function envios(){
        return $this->hasMany('App\Models\Notificacoes\EnviosEmailsNotificacoesFlash',
                                 'notif_flash_users_id', 
                                 'id');
    }


	public function scopeVista($query, $value){
		$query->where("vista", +($value));
	}

	public function scopeWithIdMd5($query){
        if($query->getQuery()->columns == null){ 
            $query->addSelect('*');
        }

        $query->addSelect(DB::Raw('MD5(notificacoes_flash_users.id) as id_md5'));
    }

    public function scopeWithFormatedDate($query){
    	if($query->getQuery()->columns == null){ 
            $query->addSelect('*');
        }

    	$query->addSelect(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y %H:%i:%s') as formated_created_at"),
                          DB::raw("DATE_FORMAT(updated_at, '%d/%m/%Y %H:%i:%s') as formated_updated_at"),
                          DB::raw("DATE_FORMAT(created_at, '%d') as dia"),
                          DB::raw("MONTHNAME(created_at) as mes_ext")
            );
    }
}
