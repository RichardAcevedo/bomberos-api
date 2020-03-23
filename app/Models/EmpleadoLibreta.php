<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EmpleadoLibreta extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empleado_libreta';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'clase', 'distrito', 'id_empleado'
    ];

    // // belongsTo de empleado
    // public function empleado(){
    //     return $this->belongsTo('App\Models\Empleado');
    // }

    // uno a uno con empleado
    public function empleado(){
        return $this->belongsTo('App\Models\Empleado');
    }
}
