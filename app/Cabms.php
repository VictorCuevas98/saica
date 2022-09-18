<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabms extends Model
{
    protected $table = 'cabms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_cabms',
        'cabms',
        'id_partida',
        'activo',
        'created_at',
        'updated_at',
        'unidad_medida',
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/
    public function artmeds(){
        return $this->hasMany('App\CatArtmed','id_cabms');
    }
    public function partidaEspecifica(){
        return $this->belongsTo('App\CatPartidaEspecifica', 'id_partida');
    }
    /*END::RELATIONSHIPS*/
}
