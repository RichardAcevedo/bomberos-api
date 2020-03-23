<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CategoriaLicencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'categoria_licencia';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre', 'clase', 'servicio'
    ];

    // uno a muchos con empleado_licencia
    public function empleadoLicencias(){
        return $this->hasMany('App\Models\EmpleadoLicencia', 'id_categoria_licencia');
    }
}
