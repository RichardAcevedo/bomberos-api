<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoEmpresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_empresa';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con empleado
    public function empresas(){
        return $this->hasMany('App\Models\Empresa', 'id_tipo_empresa');
    }
}
