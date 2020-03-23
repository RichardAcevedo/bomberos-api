<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoEducacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_educacion';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'institucion', 'titulo_obtenido', 'fecha', 'terminado', 'id_ciudad', 'id_empleado'
    ];

    // belongsTo de ciudad
    public function ciudades(){
        return $this->belongsTo('App\Models\Ciudad');
    }

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }
}
