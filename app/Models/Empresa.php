<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Empresa extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'empresa';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'nombre', 'direccion', 'barrio', 'registro_camara', 'telefono', 'fecha_registro',
        'representante', 'celular', 'cedula', 'nit', 'observacion', 'sn',
        'cantidad', 'area', 'categoria', 'nivel', 'id_inspector', 'id_tipo_empresa'
    ];

    // belongsTo de tipo_empresa
    public function tiposEmpresa(){
        return $this->belongsTo('App\Models\TipoEmpresa');
    }

    // belongsTo de empleado
    public function inspectores(){
        return $this->belongsTo('App\Models\Empleado');
    }

    // uno a muchos con extintor_cliente
    public function extintoresCliente(){
        return $this->hasMany('App\Models\ExtintorCliente', 'id_empresa');
    }

    // uno a muchos con certificado
    public function certificados(){
        return $this->hasMany('App\Models\Certificado', 'id_empresa');
    }
}
