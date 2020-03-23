<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Cliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'cliente';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre', 'documento', 'direccion', 'telefono', 'fecha'
    ];

    // uno a muchos con extintor_cliente
    public function extintoresCliente(){
        return $this->hasMany('App\Models\ExtintorCliente', 'id_cliente');
    }
}
