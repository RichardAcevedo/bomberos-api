<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CategoriaRango extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'categoria_rango';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con rango
    public function rangos(){
        return $this->hasMany('App\Models\Rango', 'id_categoria_rango');
    }
}
