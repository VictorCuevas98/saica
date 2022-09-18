<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatOrdenGobierno extends Model
{
    protected $table = 'cat_orden_gobierno';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_orden_gobierno',
        'orden_gobierno',
        'activo',
        'created_at',
        'updated_at',
    ];
}
