<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $table = 'entradas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tipo_entrada',
        'folio_entrada',
        'fecha_entrada',
        'id_puesto_persona',
        'id_almacen',
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
    
    public function tipoEntrada(){
        return $this->belongsTo('App\CatTipoEntrada', 'id_tipo_entrada');
    }
    
    public function puestoPersona(){
        return $this->belongsTo('App\PuestosPersona', 'id_puesto_persona');
    }
    
    public function almacen(){
        return $this->belongsTo('App\CatAlmacen', 'id_almacen');
    }
    
    public function entradaAdquisicion(){
        return $this->hasOne('App\EntradaAdquisicion','id');
    }
   
    
    /*END::RELATIONSHIPS*/
}
