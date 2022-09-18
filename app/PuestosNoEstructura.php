<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuestosNoEstructura extends Model
{
    protected $table = 'puestos_no_estructura';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'puesto_funcional',
        'id_puesto_superior',
        'nivel',
        'created_at',
        'updated_at',
    ];

    public function puestoEstructura(){
        return $this->belongsTo('App\PuestosEstructura','id_puesto_superior');
    }

    public function puestoFuncional(){
        return $this->belongsTo('App\PuestosFuncionales','id');
    }

    public function puestosNoEstructuraAdscripcion(){
        return $this->hasMany('App\PuestosNoEstructuraAdscripcion','id_puesto_no_estructura');
    }


}
