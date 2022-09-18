<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Colonias extends Model
{
    protected $table ='cat_colonias';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo','colonia','cp','ciudad','id_alcaldia','alcaldia','id_entidad','entidad','zona','created_at','updated_at'
    ];

    public static function getColoniaCp($cp){
        $direccion = DB::table('cat_colonias')
            ->select('id','colonia','id_alcaldia','alcaldia','id_entidad','entidad')
            ->where("cp",'=',$cp)
            ->get();
        return $direccion;
    }

    public static function getColoniaId($id){
        $direccion = DB::table('cat_colonias')
            ->select('id','colonia','id_alcaldia','alcaldia','id_entidad','entidad','cp')
            ->where("id",'=',$id)
            ->get();
        return $direccion;
    }


    //BEGIN::RELATIONSHIPS
    public function proyectos()
    {
        return $this->hasMany('App\Proyectos','id_colonia');
    }
    //END::RELATIONSHIPS
}
