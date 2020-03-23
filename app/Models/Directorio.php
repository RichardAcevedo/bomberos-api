<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Directorio extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'directorio';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'telefono', 'direccion', 'barrio', 'nombre', 'zona'
    ];
}
