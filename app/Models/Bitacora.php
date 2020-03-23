<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Bitacora extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'bitacora';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'fecha', 'hora', 'descripcion', 'atributos', 'id_asunto', 'id_usuario_sesion'
    ];

    // belongsTo de empleado
    public function empleados(){
        return $this->belongsTo('App\Models\Empleado');
    }

    // belongsTo de asunto
    public function asuntos(){
        return $this->belongsTo('App\Models\Asunto');
    }
}
