<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class VehiculoElemento extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'vehiculo_elemento';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'id_vehiculo', 'id_elemento'
    ];

    // belongsTo de vehiculo
    public function vehiculos(){
        return $this->belongsTo('App\Models\Vehiculo');
    }

    // belongsTo de elemento
    public function elementos(){
        return $this->belongsTo('App\Models\Elemento');
    }
}
