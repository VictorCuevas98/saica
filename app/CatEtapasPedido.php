<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatEtapasPedido extends Model
{
    protected $table = 'cat_etapas_pedido';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_etapa_pedido',
        'etapa_pedido',
        'activo',
        'created_at',
        'updated_at',
    ];
    //BEGIN::SCOPES

    //END::SCOPES
    /*BEGIN::RELATIONSHIPS*/
    
    /*END::RELATIONSHIPS*/
}
