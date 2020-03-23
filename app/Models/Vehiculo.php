<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Vehiculo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'vehiculo';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre', 'marca', 'modelo', 'placa', 'id_tipo_vehiculo'
    ];

    // belongsTo de tipo_vehiculo
    public function tiposVehiculo(){
        return $this->belongsTo('App\Models\TipoVehiculo');
    }

    // uno a muchos con radio
    public function radios(){
        return $this->hasMany('App\Models\Radio', 'id_vehiculo');
    }

    // uno a muchos con vehiculo_elemento
    public function vehiculoElementos(){
        return $this->hasMany('App\Models\VehiculoElemento', 'id_vehiculo');
    }
}
