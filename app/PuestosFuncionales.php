<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PuestosFuncionales extends Model
{
    protected $table ='puestos_funcionales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tipo_contratacion','activo','created_at','updated_at'
    ];

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES
    
    

    public static function getPuestos($idArea,$claveTipoContratacion){
        $puestos = [];
        $puestosFuncionales = self::whereHas('tipoContratacion', function ($query) use($claveTipoContratacion) {
                $query->where('clave_tipo_contratacion', $claveTipoContratacion);
            });
        
        if ($claveTipoContratacion=='E') {
            $puestosFuncionales = $puestosFuncionales->whereHas('puestoEstructura', function ($query) use($idArea) {
                $query->where('id_unidad_admin', $idArea);
            })->get();

            foreach($puestosFuncionales as $puestoF){

                array_push($puestos,["id"=>$puestoF->id,"puesto_funcional"=>$puestoF->puestoEstructura->puesto_estructura ]);
            }
        }else{
            //otro tipo de contratacion
            $puestosFuncionales = $puestosFuncionales->whereHas('puestoNoEstructura', function ($query) use($idArea) {
                $query->whereHas('puestosNoEstructuraAdscripcion', function ($query) use($idArea) {
                    $query->where('id_unidad_admin', $idArea);
                });
            })->get();

            foreach($puestosFuncionales as $puestoF){
                array_push($puestos,
                    [
                        "id"=>$puestoF->id,
                        "puesto_funcional"=>$puestoF->puestoNoEstructura->puesto_funcional

                    ]);
            }
        }
        return $puestos;
        
    }

    /*BEGIN::RELATIONSHIPS*/
    public function tipoContratacion(){
        return $this->belongsTo('App\CatTipoContratacion','id_tipo_contratacion');
    }

    public function puestoEstructura(){
        return $this->hasOne('App\PuestosEstructura','id');
    }

    public function puestoNoEstructura(){
        return $this->hasOne('App\PuestosNoEstructura','id');
    }

    public function puestosPersonas(){
        return $this->hasMany('App\PuestosPersona','id_puesto_funcional');
    }

    /*END::RELATIONSHIPS*/
}
