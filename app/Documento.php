<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_adquisicion',
        'id_tipo_seccion',
        'id_puesto_persona',
        'filename',
        'real_path',
        'download_path',
        'vigente',
        'expired_at',
        'uploaded',
        'uploaded_at',
        'num_documento',
        'activo',
        'created_at',
        'updated_at'
    ];

    //BEGIN::SCOPES
    public function scopeActivos($query){
        return $query->where('activo',true);
    }
    //END::SCOPES


    /*BEGIN::RELATIONSHIPS*/
    public function catTipoSeccion(){
        return $this->belongsTo('App\CatTipoSeccion', 'id_tipo_seccion');
    }
    public function adquisicion(){
        return $this->belongsTo('App\Adquisicion', 'id_adquisicion');
    }
    /*END::RELATIONSHIPS*/
}
