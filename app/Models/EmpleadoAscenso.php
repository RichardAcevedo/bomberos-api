<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoAscenso extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_ascenso';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'fecha_resolucion', 'codigo_acta', 'codigo_resolucion', 'descripcion', 'activo',
        'fecha_acta', 'fecha_desactivacion', 'dir_archivo', 'id_empleado', 'id_rango'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }

    // belongsTo de rango
    public function rangos(){
        return $this->belongsTo('App\Models\Rango');
    }
}
