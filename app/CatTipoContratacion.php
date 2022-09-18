<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatTipoContratacion extends Model
{
    protected $table ='cat_tipo_contratacion';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_contratacion','tipo_contratacion','activo','created_at','updated_at'
    ];
    
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    public function puestosFuncionales(){
        return $this->hasMany('App\PuestosFuncionales','id_tipo_contratacion');
    }
}
