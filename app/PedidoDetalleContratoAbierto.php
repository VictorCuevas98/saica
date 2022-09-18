<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoDetalleContratoAbierto extends Model
{
    //
    protected $table = 'pedidos_detalle_contrato_abierto';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_contrato_abierto',
        'id_artmed',
        'cantidad_unidades',
        'id_almacen',
        'id_pedido_contrato_abierto',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/
    public function pedido(){
        return $this->belongsTo(PedidoContratoAbierto::class,'id_pedido_contrato_abierto');
    }
    /*END::RELATIONSHIPS*/
}
