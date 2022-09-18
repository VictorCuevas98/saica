<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatStatusEntrada extends Model
{
    protected $table = 'cat_status_entrada';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_status_entrada',
        'estatus_entrada',
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
    public function entradasEstatus(){
        return $this->hasMany('App\EntradaStatus','id_status_entrada');
    }
    /*END::RELATIONSHIPS*/
}
