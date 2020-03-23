<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Profesion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'profesion';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre', 'descripcion'
    ];

    // uno a muchos con persona
    public function personas(){
        return $this->hasMany('App\Models\Persona', 'id_profesion');
    }
}
