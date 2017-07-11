<?php

namespace App\Helpers\DstTypeFixer;

use App\Helpers\AGIClasses\Numero;
use App\Models\Cdr;

class DstTypeFixer {

	public function exec(){
		$linhas = Cdr::where("dst_type", "")->get();

		foreach($linhas as $linha){
			try{
			
				$numero = new Numero($linha->dst);
				$linha->dst_type = $numero->getTipo() !== null ? $numero->getTipo() : "";
				$linha->save();
			
			} catch (\Exception $e){

				continue;

			}
		}
	}

}