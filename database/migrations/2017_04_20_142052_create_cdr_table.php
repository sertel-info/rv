<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCdrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-asterisk-logs')->create('cdr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime( 'calldate');
            $table->integer( 'duration');
            $table->integer( 'billsec');
            $table->integer( 'amaflags');
            $table->string( 'clid', 80 );
            $table->string( 'src', 80 );
            $table->string( 'dst', 80 );
            $table->string( 'dcontext', 80 );
            $table->string( 'channel', 80 );
            $table->string( 'dstchannel', 80 );
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->timestamp('answer')->nullable();
            $table->string( 'lastapp', 80 );
            $table->string( 'lastdata', 80 );
            $table->string( 'disposition', 45 );
            $table->string( 'accountcode', 20 );
            $table->string( 'userfield', 255 );
            $table->string( 'uniqueid', 32 );
            $table->string( 'linkedid', 32 );
            $table->string( 'sequence', 32 );
            $table->string( 'peeraccount', 32 );
            $table->string( 'type', 25 );
            $table->decimal( 'cost', 10, 2 );
            $table->index('calldate');
            $table->index('dst');
            $table->index('accountcode');     
            $table->string('dst_id', 25);     
            $table->string('src_id', 25);     
            $table->string('dst_type', 25);     
            /*
CREATE TABLE cdr (
    accountcode VARCHAR(20), 
    src VARCHAR(80), 
    dst VARCHAR(80), 
    dcontext VARCHAR(80), 
    clid VARCHAR(80), 
    channel VARCHAR(80), 
    dstchannel VARCHAR(80), 
    lastapp VARCHAR(80), 
    lastdata VARCHAR(80), 
    start DATETIME, 
    answer DATETIME, 
    end DATETIME, 
    duration INTEGER, 
    billsec INTEGER, 
    disposition VARCHAR(45), 
    amaflags VARCHAR(45), 
    userfield VARCHAR(256), 
    uniqueid VARCHAR(150), 
    linkedid VARCHAR(150), 
    peeraccount VARCHAR(20), 
    sequence INTEGER
);			
            CREATE TABLE IF NOT EXISTS `cdr` (25
              `calldate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
              `clid` varchar(80) NOT NULL DEFAULT '',
              `src` varchar(80) NOT NULL DEFAULT '',
              `dst` varchar(80) NOT NULL DEFAULT '',
              `dcontext` varchar(80) NOT NULL DEFAULT '',
              `channel` varchar(80) NOT NULL DEFAULT '',
              `dstchannel` varchar(80) NOT NULL DEFAULT '',
              `lastapp` varchar(80) NOT NULL DEFAULT '',
              `lastdata` varchar(80) NOT NULL DEFAULT '',
              `duration` int(11) NOT NULL DEFAULT '0',
              `billsec` int(11) NOT NULL DEFAULT '0',
              `disposition` varchar(45) NOT NULL DEFAULT '',
              `amaflags` int(11) NOT NULL DEFAULT '0',
              `accountcode` varchar(20) NOT NULL DEFAULT '',
              `userfield` varchar(255) NOT NULL DEFAULT '',
              `uniqueid` varchar(32) NOT NULL DEFAULT '',
              `linkedid` varchar(32) NOT NULL DEFAULT '',
              `sequence` varchar(32) NOT NULL DEFAULT '',
              `peeraccount` varchar(32) NOT NULL DEFAULT '',
              `type` varchar(25) NOT NULL,
              KEY `calldate` (`calldate`),
              KEY `dst` (`dst`),
              KEY `accountcode` (`accountcode`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-asterisk-logs')->dropIfExists('cdr');

    }
}
