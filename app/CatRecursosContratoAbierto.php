<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatRecursosContratoAbierto extends Model
{
    protected $table = 'cat_recursos_contrato_abierto';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_recurso_contrato_abierto',
        'recurso_contrato_abierto',
        'activo',
        'created_at',
        'updated_at',
    ];
}
