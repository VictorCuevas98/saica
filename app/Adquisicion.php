<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adquisicion extends Model
{
    protected $table = 'adquisiciones';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tipo_adquisicion',
        'num_requisicion',
        'id_origen_recurso',
        'fecha_adjudicacion',
        'num_oficio_adjudicacion',
        'fecha_oficio_adjudicacion',
        'num_carpeta',
        'monto_subtotal',
        'monto_impuesto',
        'monto_total',
        'tiempo_entrega_dias',
        'fecha_limite_entrega',
        'id_status_adquisicion',
        'id_proveedor',
        'id_puesto_persona',
        'activo',
        'created_at',
        'updated_at',
    ];

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES
    public static function getNumCarpeta(){
        return "EPCA-".date('Y')."-".str_pad( rand(0, 10000) , 5, '0', STR_PAD_LEFT) ;
    }

    public function getContratosModificatorios(){
        $contratosModificatorios = $this->contratos()
                    ->whereHas('tipoDocContrato', function ($query) {
                        $query->whereIn('clave_tipo_doc_contrato',  ['CM']);
                    });
        return $contratosModificatorios;
    }

    public function getContratoBase(){
        $contratosBase = $this->contratos()
                    ->whereHas('tipoDocContrato', function ($query) {
                        $query->whereIn('clave_tipo_doc_contrato',  ['C']);
                    });
        return $contratosBase;
    }

    /*BEGIN::RELATIONSHIPS*/
    public function tipoAdquisicion(){
        return $this->belongsTo('App\CatTipoAdquisicion', 'id_tipo_adquisicion');
    }
    public function statusAdquisicion(){
        return $this->belongsTo('App\CatStatusAdquisicion', 'id_status_adquisicion');
    }
    public function proveedor(){
        return $this->belongsTo('App\Proveedor', 'id_proveedor');
    }
    public function puestoPersona(){
        return $this->belongsTo('App\PuestosPersona', 'id_puesto_persona');
    }
    public function docsPago(){
        return $this->hasMany('App\AdquisicionDocPago','id_adquisicion');
    }
    public function contratos(){
        return $this->hasMany('App\Contratos','id_adquisicion');
    }
    /*END::RELATIONSHIPS*/
}
