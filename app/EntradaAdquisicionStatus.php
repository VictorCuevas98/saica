<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaAdquisicionStatus extends Model
{
    
    protected $table = 'entradas_adquisicion_status';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_entrada',
        'id_status_entrada',
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
    public function entrada(){
        return $this->belongsTo('App\EntradaAdquisicion', 'id_entrada');
    }
    public function status(){
        return $this->belongsTo('App\CatStatusEntrada', 'id_status_entrada');
    }
    
    /*END::RELATIONSHIPS*/

}
