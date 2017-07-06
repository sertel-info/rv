<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cdr extends Model
{
    protected $connection = 'mysql-asterisk-logs';
	protected $table = 'cdr';
	public $timestamps = false;
}
