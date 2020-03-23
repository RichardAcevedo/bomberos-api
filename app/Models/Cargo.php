<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Cargo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'cargo';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con empleado_nombramiento
    public function empleadoNombramientos(){
        return $this->hasMany('App\Models\EmpleadoNombramiento', 'id_cargo');
    }
}
