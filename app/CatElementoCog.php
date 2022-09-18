<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatElementoCog extends Model
{
    protected $table = 'cat_elementos_cog';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_elemento_cog',
        'elemento_cog',
        'id_nivel_cog',
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
    public function partidasEspecificas(){
        return $this->hasMany('App\CatPartidaEspecifica','id_elemento_cog');
    }
    
    public function nivelCog(){
        return $this->belongsTo('App\CatNivelCog', 'id_nivel_cog');
    }
    /*END::RELATIONSHIPS*/
}
