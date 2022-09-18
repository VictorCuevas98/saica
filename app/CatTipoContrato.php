<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoContrato extends Model
{
    protected $table = 'cat_tipo_contrato';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_contrato',
        'tipo_contrato',
        'activo',
        'created_at',
        'updated_at'
    ];

    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    public function contratos(){
        return $this->hasMany('App\Contrato','id_tipo_contrato');
    }
    /*END::RELATIONSHIPS*/
}
