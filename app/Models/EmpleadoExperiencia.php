<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoExperiencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_experiencia';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'empresa', 'cargo', 'direccion', 'telefono', 'jefe', 'labores', 'fecha_ingreso',
        'fecha_retiro', 'motivo', 'verificacion', 'id_empleado'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }
}
