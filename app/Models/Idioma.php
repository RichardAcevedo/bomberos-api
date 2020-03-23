<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Idioma extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'idioma';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con idioma_empleado
    public function idiomasEmpleado(){
        return $this->hasMany('App\Models\IdiomaEmpleado', 'id_idioma');
    }
}
