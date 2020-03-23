<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ExtintorCliente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'extintor_cliente';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'fecha', 'nota_de_servicio', 'capacidad', 'tarifa',
        'id_tipo_extintor', 'id_cliente', 'id_empresa'
    ];

    // belongsTo de empresa
    public function empresas(){
        return $this->belongsTo('App\Models\Empresa');
    }

    // belongsTo de cliente
    public function clientes(){
        return $this->belongsTo('App\Models\Cliente');
    }

    // belongsTo de tipo_extintor
    public function tiposExtintores(){
        return $this->belongsTo('App\Models\TipoExtintor');
    }
}
