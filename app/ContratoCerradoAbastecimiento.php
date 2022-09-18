<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContratoCerradoAbastecimiento extends Model
{
    protected $table = 'contratos_cerrados_abastecimiento';
    protected $fillable = [
        'id',
        'id_artmed',
        'id_almacen',
        'fecha_inicio',
        'cantidad_unidades',
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
    public function contratoCerradoDetalle(){
        $this->belongsTo('App\ContratoCerradoDetalle', 'id')->where('id_artmed', $this->id_artmed);
    }

    public function catAlmacen(){
        $this->belongsTo('App\CatAlmacen', 'id_almacen');
    }
    /*END::RELATIONSHIPS*/
}
