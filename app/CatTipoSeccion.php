<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class CatTipoSeccion extends Model
{
    protected $table = 'cat_tipo_seccion';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_seccion',
        'tipo_seccion',
        'activo',
        'created_at',
        'updated_at'
    ];

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES


    /*BEGIN::RELATIONSHIPS*/
    public function contratosCerrados(){
        return $this->hasMany('App\ContratoCerrado', 'id', 'id');
    }
    /*END::RELATIONSHIPS*/
}
