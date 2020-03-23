<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Radio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'radio';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'serial', 'marca', 'estado', 'señal', 'tipo', 'id_vehiculo'
    ];

    // belongsTo de vehiculo
    public function vehiculos(){
        return $this->belongsTo('App\Models\Vehiculo');
    }
}
