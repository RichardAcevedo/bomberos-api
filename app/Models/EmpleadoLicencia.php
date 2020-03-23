<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoLicencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_licencia';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'fecha_expedicion', 'fecha_vigencia', 'id_empleado',  'id_categoria_licencia'
    ];

    // belongsTo de categoria_licencia
    public function categoriaLicencia(){
        return $this->belongsTo('App\Models\CategoriaLicencia');
    }

    // belongsTo de empleado
    public function empleado(){
        return $this->belongsTo('App\Models\Empleado');
    }
}
