<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cel extends Model
{
    protected $connection = 'mysql-asterisk-logs';
	protected $table = 'cdr';
}
