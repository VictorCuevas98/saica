<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatFundamentoLegal extends Model
{
    protected $fillable = [
        'clave_fundamento_legal',
        'fundamento_legal',
        'activo',
        'created_at',
        'updated_at'
    ];
    protected $table = 'cat_fundamento_legal';
    protected $primaryKey = 'id';

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/
   /* public function contratos_fundamento(){
        return $this->hasMany('App\ContratoFundamento','id_fundamento_legal');
    }*/
    public function contratos(){
        return $this->belongsToMany(Contratos::class, 'contratos_fundamento','id_fundamento_legal', 'id_contrato');
    }
    /*END::RELATIONSHIPS*/
}
