<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoCondecoracion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_condecoracion';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'fecha_acta', 'fecha_resolucion', 'codigo_acta', 'codigo_resolucion', 'descripcion',
        'id_empleado', 'id_tipo_condecoracion'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }

    // belongsTo de empleado
    public function tiposCondecoracion(){
        return $this->belongsTo('App\Models\TipoCondecoracion');
    }
}
