<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Elemento extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'elemento';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'codigo_inventario', 'nombre', 'descripcion'
    ];

    // uno a muchos con vehiculo_elemento
    public function vehiculoElementos(){
        return $this->hasMany('App\Models\VehiculoElemento', 'id_elemento');
    }
}
