<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoCerrado extends Model
{
    protected $table = 'contratos_cerrados';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'monto_unitario',
        'monto_impuesto',
        'monto_total',
        'created_at',
        'updated_at'
    ];

    /*BEGIN::RELATIONSHIPS*/
    public function contrato(){
        return $this->belongsTo('App\Contratos', 'id');
    }

    public function contratosCerradosDetalle(){
        return $this->hasMany('App\ContratoCerradoDetalle', 'id');
    }
    /*END::RELATIONSHIPS*/
}
