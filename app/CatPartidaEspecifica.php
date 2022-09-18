<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatPartidaEspecifica extends Model
{
    protected $table = 'cat_partidas_especificas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_partida',
        'partida',
        'id_elemento_cog',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    public function cabms(){
        return $this->hasMany('App\Cabms','id_partida');
    }
    public function elementoCog(){
        return $this->belongsTo('App\CatElementoCog', 'id_elemento_cog');
    }
    /*END::RELATIONSHIPS*/
}
