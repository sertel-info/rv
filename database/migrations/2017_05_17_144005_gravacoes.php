<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Gravacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-asterisk-logs')->create('gravacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('callerid')->nullable();
            $table->string('exten')->nullable();
            $table->string('arquivo')->nullable();
            $table->timestamp('data')->nullable();
            $table->string('duracao')->nullable();
            $table->string('unique_id')->nullable();

            $table->index('unique_id');
            $table->unique('unique_id');

            $table->string('int')->nullable();

            $table->integer('linha')->nullable();
            $table->integer('assinante')->nullable();
	    $table->string('pasta', 35)->nullable();
        });
    }

    /**
    +-----------+------------------+------+-----+---------+-------+
    | Field     | Type             | Null | Key | Default | Extra |
    +-----------+------------------+------+-----+---------+-------+
    | exten     | varchar(25)      | YES  |     | NULL    |       |
    | callerid  | int(25)          | YES  |     | NULL    |       |
    | arquivo   | varchar(255)     | YES  |     | NULL    |       |
    | data      | datetime         | YES  |     | NULL    |       |
    | duracao   | varchar(25)      | YES  |     | NULL    |       |
    | unique_id | varchar(50)      | YES  |     | NULL    |       |
    | linha     | int(11) unsigned | NO   | MUL | NULL    |       |
    | assinante | int(11) unsigned | NO   | MUL | NULL    |       |
    +-----------+------------------+------+-----+---------+-------+
     
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-asterisk-logs')->dropIfExists('gravacoes');
    }
}
