<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class CatPuestoEstructuraParticipanteContrato extends Model
{
    protected $table = 'cat_puestos_estructura_participantes_contrato';
    protected $primaryKey = 'id_tipo_participante_contrato';
    protected $fillable = [
        'id_puesto_estructura',
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
    public function puestoEstructura(){
        return $this->belongsTo('App\PuestoEstructura', 'id_puesto_estructura');
    }
    public function tipoParticipanteContrato(){
        return $this->belongsTo('App\CatTipoParticipanteContrato', 'id_tipo_participante_contrato');
    }
    /*END::RELATIONSHIPS*/
}
