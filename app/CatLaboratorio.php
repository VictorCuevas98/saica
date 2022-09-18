<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatLaboratorio extends Model
{
    
    protected $table = 'cat_laboratorio';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_laboratorio',
        'laboratorio',
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
    public function entradasDetalle(){
        return $this->hasMany('App\EntradaDetalle','id_laboratorio');
    }
    /*END::RELATIONSHIPS*/
}
