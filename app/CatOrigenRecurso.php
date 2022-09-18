<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatOrigenRecurso extends Model
{
    protected $fillable=[
        'clave_origen_recurso',
        'origen_recurso',
        'activo',
        'created_at',
        'updated_at'
    ];
    protected $table = 'cat_origen_recurso';
    protected $primaryKey = 'id';

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/
    public function adquisiciones(){
        return $this->hasMany('App\Adquisicion','id_origen_recurso');
    }
    /*END::RELATIONSHIPS*/
}
