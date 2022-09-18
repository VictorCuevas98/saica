<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuestosEstructura extends Model
{
    protected $table = 'puestos_estructura';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'puesto_estructura',
        'id_puesto_superior',
        'nivel',
        'id_unidad_admin',
        'created_at',
        'updated_at',
    ];

    public function unidadAdministrativa(){
        return $this->belongsTo('App\UnidadesAdmin','id_unidad_admin');
    }

    public function puestoFuncional(){
        return $this->belongsTo('App\PuestosFuncionales','id');
    }

    public function puestoSuperior(){
        return $this->belongsTo('App\PuestosFuncionales','id_puesto_superior');
    }
}
