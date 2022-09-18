<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradaAdquisicionDetalle extends Model
{
    
    protected $table = 'entradas_adquisicion_detalle';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_artmed',
        'cantidad_unidades',
        'num_lote',
        'fecha_caducidad',
        'id_laboratorio',
        'monto_unitario',
        'monto_subtotal',
        'monto_impuesto',
        'monto_total',
        'id_entrada',
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
    
    public function artmed(){
        return $this->belongsTo('App\CatArtmed', 'id_artmed');
    }
    public function laboratorio(){
        return $this->belongsTo('App\CatLaboratorio', 'id_laboratorio');
    }
    public function entradaAdquisicion(){
        return $this->belongsTo('App\EntradaAdquisicion', 'id_entrada');
    }
    
    /*END::RELATIONSHIPS*/

}
