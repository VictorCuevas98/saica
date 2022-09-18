<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UnidadesAdmin extends Model
{
    protected $table ='unidades_admin';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_uniadm','unidad_admin','created_at','updated_at','logo','email','telefono','calle','num_ext','num_int','id_asentamiento','ext_tel','id_ente_publico','activo'
    ];

    /*public static function getUnidades($idEnte){
        $unidades = DB::table("unidades_admin")
                ->select("id","clave_uniadm","unidad_admin")
                ->where("id_ente_publico","=",$idEnte)
                ->where("activo","=","true")
                //->whereNotIn('unidad_admin',['DESCONOCIDO'])
                ->get();
        return $unidades;
    }*/

    public static function getUnidades($idEnte){
        $unidades = DB::table("unidades_admin")
                ->select("id","clave_uniadm","unidad_admin")
                ->where("id_ente_publico","=",$idEnte)
                ->where("activo","=","true")
                ->get();
        return $unidades;
    }

    public function ente_publico(){
        return $this->belongsTo('App\EntesPulicos','id_ente_publico');
    }

    public function asentamiento(){
        return $this->belongsTo('App\CatAsentamiento','id_asentamiento');
    }

    public function puestosNoEstructuraAdscripcion(){
        return $this->hasMany('App\PuestosNoEstructuraAdscripcion','id_unidad_admin');
    }
    
}
