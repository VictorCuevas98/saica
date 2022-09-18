<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatUniAdm extends Model
{
    protected $table ='cat_uniadm';
    protected $primaryKey = 'id';
    protected $fillable = [
        'clave_uniadm','unidad_admin','created_at','updated_at','logo','email'
    ];

    //BEGIN::RELATIONSHIPS
    public function laboralesPersona()
    {
        return $this->hasMany('App\LaboralesPersona','id_uniadm');
    }
    //END::RELATIONSHIPS

    public static function getUnidadId($id){
        $unidad = DB::table('cat_uniadm')
        ->where('id','=',$id)
        ->first();
        return $unidad;
    }
}