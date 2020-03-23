<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Departamento extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'departamento';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'abreviado', 'nombre'
    ];

    // uno a muchos con ciudad
    public function ciudades(){
        return $this->hasMany('App\Models\Ciudad', 'id_departamento');
    }
}
