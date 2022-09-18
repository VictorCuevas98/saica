<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoEntrada extends Model
{
    protected $table = 'cat_tipo_entrada';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_entrada',
        'tipo_entrada',
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
        return $this->hasMany('App\Entrada','id_tipo_entrada');
    }
    /*END::RELATIONSHIPS*/
}
