<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdquisicionDetalle extends Model
{
    //
    
    protected $table = 'adquisiciones_detalle';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_artmed',
        'cantidad_unidades',
        'monto_unitario',
        'monto_subtotal',
        'monto_impuesto',
        'monto_total',
        'id_adquisicion',
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
    public function adquisicion(){
        return $this->belongsTo('App\Adquisicion', 'id_adquisicion');
    }

    /*END::RELATIONSHIPS*/
}
