<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatEjerciciosFiscales extends Model
{
    protected $table = 'cat_ejercicios_fiscales';
    protected $primaryKey = 'id';
    protected $fillable = [
        'created_at',
        'updated_at',
    ];
}
