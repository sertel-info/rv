<?php

namespace App\Models\Notificacoes\ScopesTraits;

trait WithIconNameScopeTrait{

	public function scopeWithIconName($query){
		if($query->getQuery()->columns == null){ 
            $query->addSelect('*');
        }

        $icons_case = "(CASE nivel ".
        			  " WHEN 'danger' THEN 'glyphicon-exclamation-sign'".
        			  " WHEN 'warning' THEN 'glyphicon glyphicon-bell'".
        			  " WHEN 'success' THEN 'glyphicon glyphicon-ok-circle'".
        			  " END) as icon_name";

        $query->addSelect(\DB::Raw($icons_case));
    }
    
}