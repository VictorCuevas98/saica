<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProfesionalesPersona extends Model
{
    protected $table ='profesionales_persona';
    protected $primaryKey = 'id';
    protected $fillable = [
        'num_registro','formacion_prof','num_cedula','created_at','updated_at','id_persona','vigencia_registro','id_tipo_prof'
    ];


    //RELATIONSHIPS::BEGIN
    public function persona()
    {
        return $this->belongsTo('App\Personas','id_persona');
    }
    public function personaProyecto()
    {
        return $this->hasMany('App\PersonaProyecto','id_persona');
    }
    public function tipoProf()
    {
        return $this->belongsTo('App\CatTipoProf','id_tipo_prof');
    }

    //RELATIONSHIPS::END

    public static function existeDatosProf($idPersona){
        
        $datosProf = DB::table('profesionales_persona')
                    ->where('id_persona','=',$idPersona)
                    ->whereNull('num_registro')
                    ->orWhere('num_registro', "")
                    ->get();
        return $datosProf;
    }

    public static function guardaDatosProf($request,$idPersona){
        $updated = date('Y-m-d H:i:s');
        $updateDatosProf = DB::table('profesionales_persona')
        ->where('id_persona', '=', $idPersona)
        ->update(['num_registro' => $request->nregistro,
              'num_cedula'=> $request->cedula,
              'formacion_prof' => $request->fprof, 
              'vigencia_registro' => $request->vigencia,
              'updated_at' => $updated]);
        return $updateDatosProf;  
    }

    public static function guardaDatosReg($id_persona,$tipo_prof){
        $created = date('Y-m-d H:i:s');
        $insert = DB::table('profesionales_persona')->insert(
            [
            'created_at' => $created, 
            'id_tipo_prof' => $tipo_prof, 
            'id_persona' => $id_persona
            ]);
    
        return $insert;  
    }

    public static function getIdTipoProfPersona($idPersona){
        $tipoProfPerson = DB::table('profesionales_persona as pp')
                    ->select('pp.id','ct.clave_tipo_prof','ct.id as id_tipo_p')
                    ->join('cat_tipo_prof as ct','pp.id_tipo_prof','=','ct.id')
                    ->where('pp.id_persona','=',$idPersona)
                    ->first();
        return $tipoProfPerson;
    }

}
