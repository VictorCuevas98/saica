<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatAlmacen extends Model
{
    protected $table = 'cat_almacenes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_almacen',
        'almacen',
        'domi_calle',
        'domi_num_ext',
        'domi_num_int',
        'id_asentamiento',
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
    public function entradas(){
        return $this->hasMany('App\Entrada','id_almacen');
    }
    public function pedidosContratoAbierto(){
        return $this->hasMany('App\PedidoContratoAbierto','id_almacen');
    }
    public function asentamiento(){
        return $this->belongsTo('App\CatAsentamiento', 'id_asentamiento');
    }
    /*END::RELATIONSHIPS*/
}
