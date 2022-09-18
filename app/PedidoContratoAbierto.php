<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class PedidoContratoAbierto extends Model
{
    protected $table = 'pedidos_contrato_abierto';
    protected $primaryKey = 'id';
    protected $fillable = [
        'folio_pedido',
        'fecha_pedido',
        'fecha_entrega',
        'monto_subtotal',
        'monto_impuesto',
        'monto_total',
        'id_contrato_abierto',
        'id_puesto_persona',
        'id_almacen',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    // For easy search by hashid
    public function scopeHashid($query, $hashid)
    {
        $hashArray = Hashids::decode($hashid);
        return $query->where('id', empty($hashArray) ? -1 : $hashArray[0]);
    }
    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    public function entradas(){
        return $this->hasMany('App\Entrada','id_pedido_contrato_abierto');
    }
    public function contratoAbierto(){
        return $this->belongsTo('App\ContratoAbierto', 'id_contrato_abierto');
    }
    public function puestoPersona(){
        return $this->belongsTo('App\PuestosPersona', 'id_puesto_persona');
    }
    public function almacen(){
        return $this->belongsTo('App\CatAlmacen', 'id_almacen');
    }

    public function detalles(){
        return $this->hasMany(PedidoDetalleContratoAbierto::class, 'id_pedido_contrato_abierto');
    }

    public function getCurrentClaveEtapa(){
        $etapa = $this->hasMany(PedidosContratoAbiertoEtapas::class, 'id_pedido_contrato_abierto')->where('pedidos_contrato_abierto_etapas.activo', '=', true)->orderBy('created_at', 'desc')->first();
        if($etapa == null)
            return "";
        else
            return $etapa->etapa->clave_etapa_pedido;
    }

    public function getCurrentEtapa(){
        return $this->hasMany(PedidosContratoAbiertoEtapas::class, 'id_pedido_contrato_abierto')->where('pedidos_contrato_abierto_etapas.activo', '=', true)->orderBy('created_at', 'desc')->first();
    }
    /*END::RELATIONSHIPS*/

    public function getHashid()
    {
        return Hashids::encode($this->id);
    }
}
