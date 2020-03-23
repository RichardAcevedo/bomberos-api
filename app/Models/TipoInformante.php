<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoInformante extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_informante';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];
}
