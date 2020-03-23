<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoSangre extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_sangre';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con persona
    public function personas(){
        return $this->hasMany('App\Models\Persona', 'id_tipo_sangre');
    }
}
