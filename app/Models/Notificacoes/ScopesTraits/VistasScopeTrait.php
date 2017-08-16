<?php

namespace App\Models\Notificacoes\ScopesTraits;

trait VistasScopeTrait{

	
    public function scopeVistas($query, $vistas){
    	$query->where('seen', +$vistas);
    }

   
}