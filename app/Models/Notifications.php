<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $fillable  = ['message',
							'type',
							'seen'];

	public function user(){
		return $this->belongsTo("App\Models\Notifications", "user_id", "id");
	}
}
