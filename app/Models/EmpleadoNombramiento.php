<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoNombramiento extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_nombramiento';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'fecha', 'articulo', 'orden', 'activo', 'fecha_desactivacion',
        'descripcion', 'id_cargo', 'id_empleado'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }

    // belongsTo de cargo
    public function cargos(){
        return $this->belongsTo('App\Models\Cargo');
    }
}
