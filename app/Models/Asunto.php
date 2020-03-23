<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Asunto extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'asunto';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre'
    ];

    // uno a muchos con bitacora
    public function bitacoras(){
        return $this->hasMany('App\Models\Bitacora', 'id_asunto');
    }
}
