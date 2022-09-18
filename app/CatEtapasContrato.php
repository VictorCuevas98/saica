<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatEtapasContrato extends Model
{
    protected $table = 'cat_etapas_contrato';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_etapa_contrato',
        'etapa_contrato',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES

    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    public function etapasContratoAbierto(){
        return $this->hasMany('App\EtapasContrato','id_etapa_contrato');
    }
    /*END::RELATIONSHIPS*/
}
