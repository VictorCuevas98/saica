<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;


class CatArtmed extends Model
{
    protected $table = 'cat_artmed';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_artmed',
        'artmed',
        'id_cabms',
        'unidad_medida',
        'revision',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    public function scopeHashid($query, $hashid)
    {
        $hashArray = Hashids::decode($hashid);
        return $query->where('id', empty($hashArray) ? -1 : $hashArray[0]);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/
    public function adquisicionesDetalle(){
        return $this->hasMany('App\AdquisicionDetalle','id_artmed');
    }
    public function entradasDetalle(){
        return $this->hasMany('App\EntradaDetalle','id_artmed');
    }
    public function cabms(){
        return $this->belongsTo('App\Cabms', 'id_cabms');
    }

    public function contratosCerrados(){
        return $this->hasMany('App\ContratoCerrado', 'id_artmed');
    }
    public function solicitudAbastecimientoDetalle(){
        return $this->hasMany('App\SolicitudAbastecimientoDetalle','id_artmed');
    }
    /*END::RELATIONSHIPS*/

    public function getHashid()
    {
        return Hashids::encode($this->id);
    }
}
