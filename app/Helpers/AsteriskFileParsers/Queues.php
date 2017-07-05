<?php

namespace App\Helpers\AsteriskFileParsers;

use App\Helpers\AsteriskFileParsers\FileParser;

class Queues extends FileParser {

	protected $buffers = array("rv_queues"=>array());

	public function addFila($options, $buffer){
		foreach($options as $option=>$value){
			array_push($this->buffers[$buffer], $option."=".$value );
		}
	}

	public function addMember($member, $buffer){
		array_push($this->buffers[$buffer], "Member => ".$member);
	}

	public function addSession($session_name, $buffer){
        array_push($this->buffers[$buffer], "\n[".$session_name.']');
    }
}