<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Emergency extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'emergency';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'tipoEmergency', 'idMinuta', 'estado', 'descripcion', 'created_at'
    ];

}
