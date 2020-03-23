<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Certificado extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'certificado';
    protected $hidden = ['pivot'];

    protected $fillable = [
        'tarifa', 'fecha', 'vence', 'id_empresa'
    ];

    // belongsTo de empresa
    public function empresas(){
        return $this->belongsTo('App\Models\Empresa');
    } 
}
