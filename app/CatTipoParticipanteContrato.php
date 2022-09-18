<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class CatTipoParticipanteContrato extends Model
{

    protected $table = 'cat_tipo_participante_contrato';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_participante_contrato',
        'tipo_participante_contrato',
    ];

    /*BEGIN::RELATIONSHIPS*/
    public function participantes_contrato(){
        return $this->hasMany('App\ParticipanteContrato', 'id_tipo_participante_contrato', 'id');
    }
    /*END::RELATIONSHIPS*/
}
