<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContratoCerradoDetalle extends Model
{
    protected $table = 'contratos_cerrados_detalle';
    protected $primaryKey = ['id', 'id_artmed'];
    public $incrementing = false;
    protected $fillable = [
        'id',
        'id_artmed',
        'partida',
        'cantidad_unidades',
        'monto_unitario',
        'monto_subtotal',
        'monto_impuesto',
        'monto_total',
        'activo',
        'created_at',
        'updated_at'
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
    public function contratoCerrado(){
        return $this->belongsTo('App\ContratoCerrado', 'id');
    }

    public function artmed(){
        return $this->belongsTo('App\CatArtmed', 'id_artmed');
    }

    public function contratosCerradosAbastecimiento(){
        return $this->hasMany('App\ContratoCerradoAbastecimiento', 'id');
    }
    /*END::RELATIONSHIPS*/
}
