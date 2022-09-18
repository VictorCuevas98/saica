<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatStatusRevisionEntrada extends Model
{
    
    protected $table = 'cat_status_revision_entrada';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_status_revision_entrada',
        'status_revision_entrada',
        'activo',
        'created_at',
        'updated_at'
    ];
    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES

    public function desactivarEstatusActivos(){
        $estatusDesactivados = $this->entradasAdquisicionEstatus()->activos()->update(['activo' => false]);
        return $estatusDesactivados;
    }

    /*BEGIN::RELATIONSHIPS*/
    
    public function entradasAdquisicionRevisionStatus(){
        return $this->hasMany('App\EntradasAdquisicionRevisionStatus','id_status_revision_entrada');
    }
    
    
    /*END::RELATIONSHIPS*/

}
