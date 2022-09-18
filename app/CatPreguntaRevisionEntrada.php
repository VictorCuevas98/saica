<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatPreguntaRevisionEntrada extends Model
{
    protected $table = 'cat_preguntas_revision_entrada';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_pregunta',
        'pregunta',
        'orden',
        'id_tipo_revision',
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
    public function respuestasRevision(){
        return $this->hasMany('App\EntradaAdquisicionRevision','id_pregunta');
    }
    public function tipoRevision(){
        return $this->belongsTo('App\CatTipoRevision', 'id_tipo_revision');
    }
    /*END::RELATIONSHIPS*/
}
