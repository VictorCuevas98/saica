<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoSolicitudAbastecimiento extends Model
{
    protected $table = 'cat_tipos_solicitud_abastecimiento';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'tipo_solicitud_abastecimiento',
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
