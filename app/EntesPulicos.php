<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EntesPulicos extends Model
{
    protected $table ='entes_publicos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ente_publico','clave_entpub','domi_calle','domi_numext','domi_numint','id_asentamiento','telefono','ext_tel','activo','created_at','updated_at ','id_i4ch'
    ];

    //el siguiente metodo es necesario dejar de uarlo y usar el scope
    public static function getEnte($idCH){
        $entes = DB::table("entes_publicos")
                ->where("id_i4ch","=",$idCH)
                ->where("activo","=","true")
                ->first();
        return $entes;
    }
    
    public function scopeIdCH($query , $idCH ){
        return $query->where("id_i4ch",$idCH)->where('activo',true);
    }

    public function unidadesAdministrativas(){
        return $this->hasMany('App\UnidadesAdmin','id_ente_publico');
    }

    public function asentamiento(){
        return $this->belongsTo('App\CatAsentamiento','id_asentamiento');
    }
}
