<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Emergencia extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'emergencia';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'telefono', 'entidad', 'direccion', 'barrio', 'otro_telefono', 'extension'
    ];
}
