<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gravacoes extends Model
{
	protected $connection = 'mysql-asterisk-logs';
    protected $table = "gravacoes";
    public $timestamps = false;
    protected $fillable = ['data'];
}
