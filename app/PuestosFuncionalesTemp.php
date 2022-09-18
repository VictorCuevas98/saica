<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PuestosFuncionalesTemp extends Model
{
    protected $table ='puestos_funcionales_temp';
    protected $primaryKey = 'id';
    protected $fillable = [
        'puesto_funcional','id_puesto_superior','activo','created_at','id_unidad_admin','nivel','id_tipo_contratacion'
    ];

    public static function getPuestos($idUniAdm,$tipoContratacion){
        $puestos = DB::table("puestos_funcionales_temp")
                ->select("id","puesto_funcional")
                ->where("id_unidad_admin","=",$idUniAdm)
                ->where("activo","=","true")
                ->where("id_tipo_contratacion","=",$tipoContratacion)
                ->whereNotIn('puesto_funcional',['DESCONOCIDO'])
                ->get();
        return $puestos;
    }

    public static function guardaPuesto($request){
        $created = date('Y-m-d H:i:s');
        $puesto_funcional=$request->txtpuesto;
        $area = $request->area;
        $tipo_contratacion = $request->tipo_contratacion;
        $idPuestoF = DB::table('puestos_funcionales')->insertGetId(
            [   'puesto_funcional' => mb_strtoupper($puesto_funcional),
                'activo' => true,
                'created_at' => $created,
                'id_unidad_admin' => $area,
                'id_tipo_contratacion' => $tipo_contratacion
                ]
        );
        return $idPuestoF;
    }

    public static function guardaPuestoManuales($request){
        $created = date('Y-m-d H:i:s');
        $puesto_funcional = $request->txtpuestomanual;
        $area = $request->areas_llenados;
        $tipo_contratacion = $request->tipo_contratacion_manual;
        $idPuestoF = DB::table('puestos_funcionales')->insertGetId(
            [   'puesto_funcional' => mb_strtoupper($puesto_funcional),
                'activo' => true,
                'created_at' => $created,
                'id_unidad_admin' => $area,
                'id_tipo_contratacion' => $tipo_contratacion
                ]
        );
        return $idPuestoF;
    }

    public static function guardaPuestCompletarPerfil($request){
        $created = date('Y-m-d H:i:s');
        $puesto_funcional = $request->txtpuestomanual;
        $area = $request->area_comp_reg;
        $tipo_contratacion = $request->tipo_contratacion_manual;
        $idPuestoF = DB::table('puestos_funcionales')->insertGetId(
            [   'puesto_funcional' => mb_strtoupper($puesto_funcional),
                'activo' => true,
                'created_at' => $created,
                'id_unidad_admin' => $area,
                'id_tipo_contratacion' => $tipo_contratacion
                ]
        );
        return $idPuestoF;
    }

    public function unidad_admin(){
        return $this->belongsTo('App\UnidadesAdmin','id_unidad_admin');
    }
}
