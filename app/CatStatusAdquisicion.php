<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatStatusAdquisicion extends Model
{
    //
    protected $table = 'cat_status_adquisicion';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_status_adquisicion',
        'status_adquisicion',
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
        return $this->hasMany('App\Adquisicion','id_status_adquisicion');
    }
    /*END::RELATIONSHIPS*/
}
