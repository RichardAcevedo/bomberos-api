<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TipoExtintor extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_extintor';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre', 'unidad', 'cantidad'
    ];

    // uno a muchos con extintor_cliente
    public function extintoresCliente(){
        return $this->hasMany('App\Models\ExtintorCliente', 'id_tipo_extintor');
    }
}
