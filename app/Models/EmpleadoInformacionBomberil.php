<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoInformacionBomberil extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_informacion_bomberil';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'fecha_inicio', 'fecha_baja', 'cargo', 'institucion', 'resolucion', 'dir_archivo',
        'id_empleado', 'id_rango'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }
    
    // belongsTo de empleado
    public function rangos(){
        return $this->belongsTo('App\Models\Rango');
    }
}
