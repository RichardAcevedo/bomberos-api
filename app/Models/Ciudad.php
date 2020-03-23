<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Ciudad extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'ciudad';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre', 'id_departamento'
    ];

    // uno a muchos con empleado_educacion
    public function empleadoEducaciones(){
        return $this->hasMany('App\Models\EmpleadoEducacion', 'id_ciudad');
    }

    // uno a muchos con empleado(id_ciudad)
    public function empleados(){
        return $this->hasMany('App\Models\Empleado', 'id_ciudad');
    }

    // uno a muchos con persona(id_ciudad_nacimiento)
    public function personas(){
        return $this->hasMany('App\Models\Persona', 'id_ciudad_nacimiento');
    }

    // belongsTo de departamento
    public function departamentos(){
        return $this->belongsTo('App\Models\Departamento');
    }
}
