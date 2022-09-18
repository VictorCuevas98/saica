<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoRango extends Model
{
    protected $table = 'cat_tipo_rango';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_rango',
        'tipo_rango',
        'activo',
        'created_at',
        'updated_at',
    ];
}
