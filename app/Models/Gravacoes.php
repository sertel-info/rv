<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gravacoes extends Model
{
	protected $connection = 'mysql-asterisk-logs';
    protected $table = "gravacoes";
    public $timestamps = false;
    protected $fillable = ['data'];


    public function getDataAttribute($value){
    	return \DateTime::createFromFormat('Y-m-d H:i:s', $value)->format("d/m/Y H:i:s");
    }

}

