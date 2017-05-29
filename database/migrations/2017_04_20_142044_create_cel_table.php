<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql-asterisk-logs')->create('cel', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->timestamp( 'eventtime' );
          $table->string( 'eventtype', 30 );
          $table->string( 'userdeftype',255 );
          $table->string( 'cid_name', 80);
          $table->string( 'cid_num', 80);
          $table->string( 'cid_ani',80 );
          $table->string( 'cid_rdnis', 80);
          $table->string( 'cid_dnid',80 );
          $table->string( 'exten', 80);
          $table->string( 'context',80);
          $table->string( 'channame', 80);
          $table->string( 'appname', 80);
          $table->string( 'appdata', 80);
          $table->string( 'accountcode', 20);
          $table->string( 'peeraccount',20 );
          $table->string( 'uniqueid', 150);
          $table->string( 'linkedid', 150);
          $table->string( 'userfield', 255);
          $table->string( 'peer', 80);
          $table->text( 'extra' );
          $table->integer( 'amaflags' );

          /*`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
          `eventtype` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
          `eventtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          `userdeftype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `cid_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `cid_num` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `cid_ani` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `cid_rdnis` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `cid_dnid` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `exten` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `context` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `channame` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `appname` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `appdata` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `amaflags` int(11) NOT NULL,
          `accountcode` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
          `peeraccount` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
          `uniqueid` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
          `linkedid` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
          `userfield` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `peer` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `extra` text COLLATE utf8_unicode_ci NOT NULL,
          UNIQUE KEY `id` (`id`)*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql-asterisk-logs')->dropIfExists('cel');
    }
}
