<?php

namespace App\Models\Armada;

use Illuminate\Database\Eloquent\Model;

class ArmadaModel extends Model
{
    protected $table = 'tb_mobil';
    public $timestamps = false;

    public function kategori(){
        return $this->hasOne('App\Models\Kategori\KategoriModel', 'id', 'id_kategori');
    }
}
