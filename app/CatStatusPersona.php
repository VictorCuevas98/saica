<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatStatusPersona extends Model
{
    protected $table ='cat_status_persona';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'status_persona'
    ];
    
}
