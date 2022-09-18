<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatAsentamiento extends Model
{
    protected $table = 'cat_asentamientos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo_asentamiento',
        'asentamiento',
        'cp',
        'ciudad',
        'id_municipio',
        'municipio',
        'id_entidad',
        'entidad',
        'zona',
        'id_ciudad',
        'created_at',
    ];
    //BEGIN::SCOPES
    
    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    public function almacenes(){
        return $this->hasMany('App\CatAlmacen','id_asentamiento');
    }
    
    public function unidadesAdministrativas(){
        return $this->hasMany('App\UnidadesAdmin','id_asentamiento');
    }

    public function entesPublicos(){
        return $this->hasMany('App\EntesPulicos','id_asentamiento');
    }

    
    /*END::RELATIONSHIPS*/
}
