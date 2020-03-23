<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Evento extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'evento';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];
}
