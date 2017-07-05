<?php
namespace App\Models\Traits;


trait md5IdScope{

    public function scopeWithMd5Id($query){
        $query->select(\DB::raw("*, MD5(id) as id_md5"));
    }

}
