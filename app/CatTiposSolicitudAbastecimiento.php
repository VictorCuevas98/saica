<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTiposSolicitudAbastecimiento extends Model
{
    protected $table = 'cat_tipos_solicitud_abastecimiento';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo_solicitud_abastecimiento',
        'activo',
        'created_at',
        'updated_at',
    ];
}