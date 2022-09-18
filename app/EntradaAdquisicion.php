<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaAdquisicion extends Model
{
    
    protected $table = 'entradas_adquisicion';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'monto_subtotal',
        'monto_impuesto',
        'monto_total',
        'id_adquisicion_doc_pago',
        'id_pedido_contrato_abierto',
        'activo',
        'created_at',
        'updated_at'
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    public function desactivarEstatusActivos(){
        $estatusDesactivados = $this->entradasAdquisicionEstatus()->activos()->update(['activo' => false]);
        return $estatusDesactivados;
    }

    public function desactivarEstatusRevision(){
        $estatusDesactivados = $this->entradasAdquisicionRevisionStatus()->activos()->update(['activo' => false]);
        return $estatusDesactivados;
    }

    /*BEGIN::RELATIONSHIPS*/
    public function entrada(){
        return $this->belongsTo('App\Entrada', 'id');
    }
    public function adquisicionDocPago(){
        return $this->belongsTo('App\AdquisicionDocPago', 'id_adquisicion_doc_pago');
    }

    public function pedidoContratoAbierto(){
        return $this->belongsTo('App\PedidoContratoAbierto', 'id_pedido_contrato_abierto');
    }

    public function entradasAdquisicionDetalle(){
        return $this->hasMany('App\EntradaAdquisicionDetalle','id_entrada');
    }

    public function respuestasRevision(){
        return $this->hasMany('App\EntradaAdquisicionRevision','id_entrada');
    }

    public function entradasAdquisicionEstatus(){
        return $this->hasMany('App\EntradaAdquisicionStatus','id_entrada');
    }
    
    public function entradasAdquisicionRevisionStatus(){
        return $this->hasMany('App\EntradasAdquisicionRevisionStatus','id_entrada_adquisicion');
    }
    

    /*END::RELATIONSHIPS*/

}
