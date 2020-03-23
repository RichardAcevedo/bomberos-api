<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoVehiculo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_vehiculo';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con vehiculo
    public function vehiculos(){
        return $this->hasMany('App\Models\Vehiculo', 'id_tipo_vehiculo');
    }
}
