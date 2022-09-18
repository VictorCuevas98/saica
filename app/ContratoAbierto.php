<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoAbierto extends Model
{
    protected $table = 'contratos_abiertos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'monto_subtotal_minimo',
        'monto_impuesto_minimo',
        'monto_total_minimo',
        'monto_subtotal_maximo',
        'monto_impuesto_maximo',
        'monto_total_maximo',
        'id_tipo_rango',
        'recursos_disponibles',
        'created_at',
        'updated_at',


    ];
    //BEGIN::SCOPES

    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    public function pedidosContratoAbierto(){
        return $this->hasMany('App\PedidoContratoAbierto','id_contrato_abierto');
    }

    public function contrato(){
        return $this->belongsTo('App\Contratos','id');
    }

    public function etapasContratoAbierto(){
        return $this->hasMany('App\EtapasContratoAbierto','id_contrato_abierto');
    }
    public function articulosContratoAbierto(){
        return $this->hasMany('App\ContratoAbiertoDetalle','id');
    }
    /*END::RELATIONSHIPS*/
}
