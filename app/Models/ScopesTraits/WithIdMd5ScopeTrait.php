<?php
namespace App\Models\ScopesTraits;


trait WithIDMd5ScopeTrait{

	public function scopeWithIdMd5($query){
        if($query->getQuery()->columns == null){ 
            $query->addSelect('*');
        }

        $query->addSelect(\DB::Raw('MD5('.$this->table.'.id) as id_md5'));
    }

}
