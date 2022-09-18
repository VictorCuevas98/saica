<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoAdquisicion extends Model
{
    protected $table = 'cat_tipo_adquisicion';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_adquisicion',
        'tipo_adquisicion',
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
    public function adquisiciones(){
        return $this->hasMany('App\Adquisicion','id_tipo_adquisicion');
    }
    /*END::RELATIONSHIPS*/
}
