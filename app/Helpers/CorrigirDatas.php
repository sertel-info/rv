<?php
namespace App\Helpers;

class CorrigirDatas(){


	public function corrigir($gravacoes){

		foreach($gravacoes as $g){
			$g->update(['data'=>$g->calldate]);

		}

	}
}