<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoCondecoracion extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_condecoracion';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con empleado_condecoracion
    public function empleadoCondecoraciones(){
        return $this->hasMany('App\Models\EmpleadoCondecoracion', 'id_tipo_condecoracion');
    }
}
