<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatNivelCog extends Model
{
    protected $table = 'cat_niveles_cog';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_nivel_cog',
        'nivel_cog',
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
    public function elementosCog(){
        return $this->hasMany('App\CatElementoCog','id_nivel_cog');
    }
    /*END::RELATIONSHIPS*/
}
