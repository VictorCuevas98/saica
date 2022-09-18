<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class ParticipanteContrato extends Model
{

    protected $table = 'participantes_contrato';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_contrato',
        'id_puesto_persona',
        'folio',
        'fecha_firma',
        'qr',
        'sello',
        'id_tipo_participante_contrato',
        'activo',
    ];

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }

    /*BEGIN::RELATIONSHIPS*/
    public function catTipoParticipanteContrato(){
        return $this->belongsTo('App\CatTipoParticipanteContrato', 'id_tipo_participante_contrato');
    }
    public function contrato(){
        return $this->belongsTo('App\Contrato', 'id_contrato');
    }
    /*END::RELATIONSHIPS*/
}
