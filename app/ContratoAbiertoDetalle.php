<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContratoAbiertoDetalle extends Model
{
    protected $table = 'contratos_abiertos_detalle';
    protected $primaryKey = ['id', 'id_artmed'];
    public $incrementing = false;
    protected $fillable = [
        'id',
        'id_artmed',
        'partida',
        'monto_unitario_fijo',
        'cantidad_unidades_minima',
        'cantidad_unidades_maxima',
        'activo',
        'created_at',
        'updated_at',
    ];

    protected function setKeysForSaveQuery(Builder $query)
    {
        return $query->where('id', $this->getAttribute('id'))
        ->where('id_artmed', $this->getAttribute('id_artmed'));
    }

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/

    public function contratoAbierto(){
       return $this->belongsTo('App\ContratoAbierto', 'id');
    }

    public function artmed(){
        return $this->belongsTo('App\CatArtmed', 'id_artmed');
    }
    /*END::RELATIONSHIPS*/
}
