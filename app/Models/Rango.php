<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Rango extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'rango';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre', 'descripcion', 'id_categoria_rango'
    ];

    // uno a muchos con empleado_ascenso
    public function empleadoAscensos(){
        return $this->hasMany('App\Models\EmpleadoAsenco', 'id_rango');
    }

    // belongsTo de categoria_rango
    public function categoriasRango(){
        return $this->belongsTo('App\Models\CategoriaRango');
    }

    // uno a muchos con empleado_informacion_bomberil
    public function empleadoInformacionesBomberil(){
        return $this->hasMany('App\Models\EmpleadoInformacionBomberil', 'id_rango');
    }
}
