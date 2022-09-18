<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoFundamento extends Model
{
    protected $table = 'contratos_fundamento';
    protected $primaryKey = 'id_contrato';
    protected $fillable = [
        'id_contrato',
        'id_fundamento_legal',
        'activo',
        'created_at',
        'updated_at'
    ];
    

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/
    /*public function contrato(){
        return $this->belongsTo('App\Contratos','id_contrato');
    }

    public function catFundamentoLegal(){
        return $this->belongsTo('App\CatFundamentoLegal','id_fundamento_legal');
    }*/
    /*END::RELATIONSHIPS*/
}
