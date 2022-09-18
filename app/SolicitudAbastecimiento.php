<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudAbastecimiento extends Model
{
    protected $table = 'solicitudes_abastecimiento';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tipo_solicitud_abastecimiento',
        'id_periodo',
        'num_solicitud_abastecimiento',
        'id_almacen',
        'id_unidad_admin',
        'id_puesto_persona',
        'observaciones',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    
}
