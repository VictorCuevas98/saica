<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoDocPago extends Model
{
    protected $table = 'cat_tipo_doc_pago';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_doc_pago',
        'tipo_doc_pago',
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
    public function adquisicionesDocsPago(){
        return $this->hasMany('App\AdquisicionDocPago','id_tipo_doc_pago');
    }
    /*END::RELATIONSHIPS*/
}
