<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PuestosNoEstructuraAdscripcion extends Model
{
    protected $table = 'puestos_no_estructura_adscripcion';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_puesto_no_estructura',
        'id_unidad_admin',
        'fecha_adscripcion',
        'activo',
        'created_at',
        'updated_at',
    ];

    public static function getLastPuestoAdscripcion($idPuestoNoEstructura){
        $lastPuestoAdscripcion = PuestosNoEstructuraAdscripcion::where('fecha_adscripcion', 
                                PuestosNoEstructuraAdscripcion::max('fecha_adscripcion'))
                                ->where('id_puesto_no_estructura','=',$idPuestoNoEstructura)
                                ->where('activo','=',true)
                                ->get();
        return $lastPuestoAdscripcion;
    }

    public static function getPuestoAdscripcion($idPuestoNoEstructura){
        $datosUnidad = DB::table('puestos_no_estructura_adscripcion')
                                        ->where('id_puesto_no_estructura','=',$idPuestoNoEstructura)
                                        ->where('activo', '=', true)
                                        ->get();
        return $datosUnidad;
    }

    public function unidadesAdministrativas(){
        return $this->belongsTo('App\UnidadesAdmin','id_unidad_admin');
    }

    public function puestoNoEstructura(){
        return $this->belongsTo('App\PuestosNoEstructura','id_puesto_no_estructura');
    }
}
