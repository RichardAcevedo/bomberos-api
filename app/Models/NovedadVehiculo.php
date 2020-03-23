<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class NovedadVehiculo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'novedad_vehiculo';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];
}
