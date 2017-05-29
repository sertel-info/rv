<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Helpers\AsteriskFileParser;
use App\Events\ItensModificados;

class AsteriskController extends Controller
{   
	public function __construct(AsteriskFileParser $parser){
		$this->parser = $parser;
	}

	public function index(){
		
		event(new ItensModificados());
	}

}
