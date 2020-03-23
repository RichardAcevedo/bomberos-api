<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoCapacitacion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_capacitacion';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'evento', 'institucion', 'hora_teorica', 'hora_practica', 'fecha', 'dir_archivo', 'id_empleado'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }
}
