<?php

namespace App\Models\Informasi;

use Illuminate\Database\Eloquent\Model;

class InfoModel extends Model
{
    protected $table = 'tb_info';
    public $timestamps = false;

    public function kategori(){
        return $this->hasOne('App\Models\Kategori\KategoriModel', 'id', 'id_kategori');
    }
}
