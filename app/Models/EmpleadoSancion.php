<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoSancion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_sancion';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'fecha', 'tipo_sancion', 'orden', 'descripcion', 'id_empleado'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }
}
