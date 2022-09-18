<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatTipoDocContrato extends Model
{
    protected $table = 'cat_tipo_doc_contrato';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_tipo_doc_contrato',
        'tipo_doc_contrato',
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
    public function contratos(){
        return $this->hasMany('App\Contrato','id_tipo_doc_contrato');
    }

    /*END::RELATIONSHIPS*/
}
