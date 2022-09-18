<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatUnidadConsolidadora extends Model
{
    protected $table = 'cat_unidades_consolidadoras';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_unidad_consolidadora',
        'unidad_consolidadora',
        'id_orden_gobierno',
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
    public function ordenGobierno(){
        return $this->belongsTo('App\CatOrdenGobierno', 'id_orden_gobierno');
    }
    /*END::RELATIONSHIPS*/
}
