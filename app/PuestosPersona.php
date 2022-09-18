<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PuestosPersona extends Model
{
    protected $table ='puestos_persona';
    protected $primaryKey = 'id';
    protected $fillable = [

        'created_at','updated_at','id_persona','id_puesto_funcional','fecha_inicial','fecha_termino','id_tipo_desempeno'
    ];

    //BEGIN::SCOPES
    public function scopeActivo($query){
        return $query->where('fecha_termino',null);
    }

    //END::SCOPES

    public static function insertPuesto($idPersona,$request,$id_puesto_funcional){
        $created = date('Y-m-d H:i:s');
        $idPuesto = DB::table('puestos_persona')->insertGetId(
            [   'id_persona' => $idPersona,
                'id_puesto_funcional' => $id_puesto_funcional,
                'fecha_inicial' => now(),
                'created_at' => $created,
                'id_tipo_desempeno' => 'T'
                ]
        );
        return $idPuesto;
    }
    public static function insertPuestoManual($idPersona,$request,$id_puesto_funcional,$fechaInicio){
        $created = date('Y-m-d H:i:s');
        $idPuesto = DB::table('puestos_persona')->insertGetId(
            [   'id_persona' => $idPersona,
                'id_puesto_funcional' => $id_puesto_funcional,
                'fecha_inicial' => $fechaInicio,
                'created_at' => $created,
                'id_tipo_desempeno' => 'T'
                ]
        );
        return $idPuesto;
    }
    public static function insertPuestoCompletarPerfil($idPersona,$request,$id_puesto_funcional){
        $created = date('Y-m-d H:i:s');
        $idPuesto = DB::table('puestos_persona')->insertGetId(
            [   'id_persona' => $idPersona,
                'id_puesto_funcional' => $id_puesto_funcional,
                'fecha_inicial' => now(),
                'created_at' => $created,
                'id_tipo_desempeno' => 'T'
                ]
        );
        return $idPuesto;
    }

    public function puestos_persona(){
        return $this->belongsTo('App\Personas','id');
    }

    public function persona(){
        return $this->belongsTo('App\Personas','id_persona');
    }
    public function puesto_funcional(){
        return $this->belongsTo('App\PuestosFuncionales','id_puesto_funcional');
    }

    public function tipoDeDesempeno(){
        return $this->belongsTo('App\CatTipoDesempeno','id_tipo_desempeno');
    }
    public function adquisiciones(){
        return $this->hasMany('App\Adquisicion','id_puesto_persona');
    }
    public function entradas(){
        return $this->hasMany('App\Entrada','id_puesto_persona');
    }
    public function pedidosContratoAbierto(){
        return $this->hasMany('App\PedidoContratoAbierto','id_puesto_persona');
    }
    public function entradasStatus(){
        return $this->hasMany('App\EntradaStatus','id_puesto_persona');
    }
    public function respuestasRevision(){
        return $this->hasMany('App\EntradaRevision','id_puesto_persona');
    }
}
