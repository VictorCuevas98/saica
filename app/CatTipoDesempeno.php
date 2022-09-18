<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoDesempeno extends Model
{
    protected $table ='cat_tipo_desempeno';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'tipo_desempeno'


        
    ];

    
}
