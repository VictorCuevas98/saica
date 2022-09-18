<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudAbastecimientoDetalle extends Model
{
     protected $table = 'solicitudes_abastecimiento_detalle';
    protected $primaryKey = ['id','id_artmed'];
    public $incrementing = false;
    protected $fillable = [
        'id',
        'id_artmed',
        'cantidad_unidades_solicitada',
        'cantidad_unidades_autorizada',
        'cantidad_unidades_otorgada',
        'observaciones',
        'activo',
        'created_at',
        'updated_at',
    ];
     /*BEGIN::RELATIONSHIPS*/
     public function catArtmed(){
        return $this->belongsTo('App\CatArtmed','id_artmed');
     }
     /*END::RELATIONSHIPS*/

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES
}
 