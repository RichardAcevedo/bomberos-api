<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoUsuario extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_usuario';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con empleado
    public function empleados(){
        return $this->hasMany('App\Models\Empleado', 'id_tipo_usuario');
    }
}
