<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cdr extends Model
{
    protected $connection = 'mysql-asterisk-logs';
	protected $table = 'cdr';
	protected $fillable = ['calldate', 'accountcode'];
	public $timestamps = false;
	
	public function getCalldateAttribute($value){
    	return \DateTime::createFromFormat('Y-m-d H:i:s', $value)->format("d/m/Y H:i:s");
    }

    public function getStartAttribute($value){
    	return \DateTime::createFromFormat('Y-m-d H:i:s', $value)->format("d/m/Y H:i:s");
    }
}

