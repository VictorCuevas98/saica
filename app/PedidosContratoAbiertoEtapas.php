<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use App\PedidoContratoAbierto;
class PedidosContratoAbiertoEtapas extends Model
{
    protected $table = 'pedidos_contrato_abierto_etapas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pedido_contrato_abierto',
        'id_etapa_pedido',
        'activo',
        //'created_at',
        //'updated_at',
    ];
    //BEGIN::SCOPES

    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    public function pedido(){
        return $this->belongsTo('App\PedidoContratoAbierto','id_pedido_contrato_abierto');
    }

    public function etapa(){
        return $this->belongsTo('App\CatEtapasPedido','id_etapa_pedido');
    }
    /*END::RELATIONSHIPS*/
}
