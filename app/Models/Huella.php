<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Huella extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'huella';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'id_empleado', 'huella'
    ];

    // belongsTo de empleado
    public function empleado(){
        return $this->belongsTo('App\Models\Empleado');
    } 
}
