<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EtapasContratoAbierto extends Model
{
    protected $table = 'etapas_contrato_abierto';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_contrato_abierto',
        'id_etapa_contrato_abierto',
        'fecha_movimiento',
        'monto_subtotal_acumulado',
        'monto_impuesto_acumulado',
        'monto_total_acumulado',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES

    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    public function contratosAbiertos(){
        return $this->belongsTo('App\ContratoAbierto','id_contrato_abierto');
    }

    public function catEtapasContratoAbierto(){
        return $this->belongsTo('App\CatEtapasContratoAbierto','id_etapa_contrato_abierto');
    }
    /*END::RELATIONSHIPS*/
}
