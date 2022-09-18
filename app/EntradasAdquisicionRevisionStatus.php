<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradasAdquisicionRevisionStatus extends Model
{
    
    protected $table = 'entradas_adquisicion_revision_status';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_entrada_adquisicion',
        'id_status_revision_entrada',
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
    
    public function puestoPersona(){
        return $this->belongsTo('App\PuestosPersona', 'id_puesto_persona');
    }
    
    public function entradaAdquisicion(){
        return $this->belongsTo('App\EntradaAdquisicion', 'id_entrada_adquisicion');
    }
    public function catStatus(){
        return $this->belongsTo('App\CatStatusRevisionEntrada', 'id_status_revision_entrada');
    }

    
    /*END::RELATIONSHIPS*/

}