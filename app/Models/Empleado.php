<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Empleado extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;
    
    protected $table = 'empleado';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'codigo_sistema_nacional_npib', 'codigo', 'password', 'fecha_ingreso', 'activo',
        'radicacion', 'pasaporte', 'seguro', 'tipo_casa',
        'personas_a_cargo','actividad', 'labor', 'maquina', 'computador', 'hobi', 'acceso_huella',
        'id_tipo_usuario', 'id_ciudad', 'id_persona'
    ];

    // uno a muchos con empleado_educacion
    public function empleadoEducaciones(){
        return $this->hasMany('App\Models\EmpleadoEducacion', 'id_empleado');
    }

    // uno a muchos con idioma_empleado
    public function idiomasEmpleado(){
        return $this->hasMany('App\Models\IdiomaEmpleado', 'id_empleado');
    }

    // uno a muchos con empleado_capacitacion
    public function empleadoCapacitaciones(){
        return $this->hasMany('App\Models\EmpleadoCapacitacion', 'id_empleado');
    }

    // uno a muchos con empleado_curso_bomberil
    public function empleadoCursosBomberil(){
        return $this->hasMany('App\Models\EmpleadoCursoBomberil', 'id_empleado');
    }

    // uno a muchos con empleado_condecoracion
    public function empleadoCondecoracion(){
        return $this->hasMany('App\Models\EmpleadoCondecoracion', 'id_empleado');
    }

    // uno a muchos con empleado_experiencia
    public function empleadoExperiencias(){
        return $this->hasMany('App\Models\EmpleadoExperiencia', 'id_empleado');
    }

    // uno a muchos con empleado_nombramiento
    public function empleadoNombramientos(){
        return $this->hasMany('App\Models\EmpleadoNombramiento', 'id_empleado');
    }

    // uno a muchos con empleado_sancion
    public function empleadoSanciones(){
        return $this->hasMany('App\Models\EmpleadoSancion', 'id_empleado');
    }

    // uno a muchos con empleado_ascenso
    public function empleadoAscensos(){
        return $this->hasMany('App\Models\EmpleadoAscenso', 'id_empleado');
    }

    // uno a muchos con empleado_informacion_bomberil
    public function empleadoInformacionesBomberil(){
        return $this->hasMany('App\Models\EmpleadoInformacionBomberil', 'id_empleado');
    }

    // uno a muchos con bitacora
    public function bitacoras(){
        return $this->hasMany('App\Models\Bitacora', 'id_usuario_sesion');
    }
    
    // uno a muchos con empleado_licencia
    public function Empleadolicencias(){
        return $this->hasMany('App\Models\EmpleadoLicencia', 'id_empleado');
    }

    // uno a muchos con empresa
    public function empresas(){
        return $this->hasMany('App\Models\Empresa', 'id_inspector');
    }

    // belongsTo de tipo_usuario
    public function tiposUsuario(){
        return $this->belongsTo('App\Models\TipoUsuario');
    }

    // belongsTo de ciudad(id_ciudad)
    public function ciudades(){
        return $this->belongsTo('App\Models\Ciudad');
    }

    // belongsTo de persona
    public function persona(){
        return $this->belongsTo('App\Models\Persona');
    }

    // uno a uno con empleadoLibreta
    public function empleadoLibreta(){
        return $this->hasOne('App\Models\EmpleadoLibreta', 'id_empleado');
    }

    // uno a uno con huella
    public function huellas(){
        return $this->hasOne('App\Models\Huella', 'id_empleado');
    }
}
