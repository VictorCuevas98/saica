<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaAdquisicionRevision extends Model
{
    
    protected $table = 'entradas_adquisicion_revision';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_entrada',
        'id_pregunta',
        'respuesta',
        'id_puesto_persona',
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
    
    public function entradaAdquisicion(){
        return $this->belongsTo('App\EntradaAdquisicion', 'id_entrada');
    }
    public function pregunta(){
        return $this->belongsTo('App\CatPreguntaRevisionEntrada', 'id_pregunta');
    }
    public function puestoPersona(){
        return $this->belongsTo('App\PuestosPersona', 'id_puesto_persona');
    }
    
    /*END::RELATIONSHIPS*/




}
