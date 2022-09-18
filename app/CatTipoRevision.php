<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoRevision extends Model
{
    protected $table = 'cat_tipo_revision';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_revision',
        'tipo_revision',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES
    
    /*BEGIN::RELATIONSHIPS*/
    public function catPreguntasRevision(){
        return $this->hasMany('App\CatPreguntaRevisionEntrada','id_tipo_revision');
    }
    /*END::RELATIONSHIPS*/
}
