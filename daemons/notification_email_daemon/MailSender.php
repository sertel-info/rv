<?php

use Unirest\Request\Body;
use Unirest\Request;

class MailSender{
	
	private $address = "http://127.0.0.1:8889";
	private $body;
	private $attachment;
	private $to;
	private $from;
	private $subject;
	private $last_response;

	function __construct(){
	}

	public function setBody($body){
		$this->body = $body;
	}

	public function setSubject($subject){
		$this->subject = $subject;
	}

	public function setAttachment($file){
		$this->attachment = $file;
	}

	public function setAdress($address){
		$this->address = $address;
	}

	public function setFrom($from){
		$this->from = $from;
	}

	public function setTo($to){
		$this->to = $to;
	}

	public function send(){
		if($this->attachment !== null){
			$body = Body::multipart($this->dataToArray(), $this->attachment);
		} else {
			$body = $this->dataToArray();
		}
		$response = Request::post($this->address, '', $body);
		
		$this->last_response = $response;

		return $response->body;
	}

	public function dataToArray(){
		return array(
					"remetente"=>$this->from,
					"receptor"=>$this->to,
					"mensagem"=>$this->body,
					"assunto"=>$this->subject
					);
	}
}