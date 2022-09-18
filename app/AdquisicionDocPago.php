<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdquisicionDocPago extends Model
{
    protected $table = 'adquisiciones_doc_pago';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tipo_doc_pago',
        'num_doc_pago',
        'monto_subtotal',
        'monto_impuesto',
        'monto_total',
        'id_adquisicion',
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
    
    public function tipoDocPago(){
        return $this->belongsTo('App\CatTipoDocPago', 'id_tipo_doc_pago');
    }
    public function adquisicion(){
        return $this->belongsTo('App\Adquisicion', 'id_adquisicion');
    }
    public function entradasAdquisicion(){
        return $this->hasMany('App\EntradaAdquisicion','id_adquisicion_doc_pago');
    }
    /*END::RELATIONSHIPS*/
}
