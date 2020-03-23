<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class IdiomaEmpleado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'idioma_empleado';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'id_idioma', 'id_empleado'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }

    // belongsTo de idioma
    public function idiomas(){
        return $this->belongsTo('App\Models\Idioma');
    }
}
