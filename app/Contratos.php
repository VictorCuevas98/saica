<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Contratos extends Model
{
    protected $table = 'contratos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tipo_contrato',
        'id_tipo_doc_contrato',
        'num_contrato',
        'fecha_contrato',
        'id_adquisicion',
        'validado',
        'activo',
        'observaciones',
        'created_at',
        'updated_at'
    ];

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    // For easy search by hashid
    public function scopeHashid($query, $hashid)
    {
        $hashArray = Hashids::decode($hashid);
        return $query->where('id', empty($hashArray) ? -1 : $hashArray[0]);
    }
    //END::SCOPES


    /*BEGIN::RELATIONSHIPS*/
    public function adquisicion(){
        return $this->belongsTo('App\Adquisicion', 'id_adquisicion');
    }
    public function tipoContrato(){
        return $this->belongsTo('App\CatTipoContrato', 'id_tipo_contrato');
    }
    public function tipoDocContrato(){
        return $this->belongsTo('App\CatTipoDocContrato', 'id_tipo_doc_contrato');
    }
    public function contratosCerrados(){
        return $this->hasMany('App\ContratoCerrado', 'id', 'id');
    }
    public function contratoAbierto(){
        return $this->hasOne('App\ContratoAbierto','id', 'id');
    }
    public function catFundamentoLegal(){
        return $this->belongsToMany(catFundamentoLegal::class, 'contratos_fundamento','id_contrato', 'id_fundamento_legal')->withPivot('activo');
    }
    /*END::RELATIONSHIPS*/

    /*FUNCTIONS*/
    public function getHashid()
    {
        return Hashids::encode($this->id);
    }
}
