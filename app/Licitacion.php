<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licitacion extends Model
{
    protected $fillable = [
        'num_licitacion',
        'id_unidad_consolidadora',
        'id_adquisicion',
        'activo',
        'created_at',
        'updated_at'
    ];
    protected $table = 'licitaciones';
    protected $primaryKey = 'id';

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    /*BEGIN::RELATIONSHIPS*/
    public function unidadesConsolidadoras(){
        return $this->belongsTo('App\CatUnidadConsolidadora', 'id_unidad_consolidadora');
    }
    public function adquisiciones(){
        return $this->belongsTo('App\Adquisicion', 'id_adquisicion');
    }
    /*END::RELATIONSHIPS*/
}
