<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;

class Personas extends Model
{

    protected $table ='personas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo_persona','rfc','nombre','primer_ap','segundo_ap','razon_social','created_at','updated_at','curp','telefono','email','id_status_persona','num_empleado'
    ];

    public static function crearPersona($request){
        $created = date('Y-m-d H:i:s');
        $rfc=$request->txtrfc;
        $email=$request->email;
        $telefono=$request->telefonoF;
        $idPersona = DB::table('personas')->insertGetId(
            [   'rfc' => mb_strtoupper($rfc),
                'curp' => mb_strtoupper($request->txtcurp),
                'nombre' => $request->txtnombre,
                'primer_ap' => $request->txtapaterno,
                'segundo_ap' => $request->txtamaterno,
                'telefono' => $telefono,
                'email' => $email,
                'num_empleado' => $request->txtnumemp,
                'genero' => $request->txtgenero,
                'created_at' => $created,
                'activo' => true,
                'id_status_persona' => 'A'
                ]
        );
        return $idPersona;
    }
    public static function crearPersonaManual($request){
        $created = date('Y-m-d H:i:s');
        $rfc=$request->txtrfcManual;
        $email=$request->emailManual;
        $telefono=$request->telefonoFManual;
        $idPersona = DB::table('personas')->insertGetId(
            [   'rfc' => mb_strtoupper($rfc),
                'curp' => mb_strtoupper($request->txtCurpManual),
                'nombre' => mb_strtoupper($request->txtnombre_manual),
                'primer_ap' => mb_strtoupper($request->txtapaterno_manual),
                'segundo_ap' => mb_strtoupper($request->txtamaterno_manual),
                'telefono' => $telefono,
                'email' => $email,
                'num_empleado' => $request->txtNUmEmpleadosManual,
                'genero' => $request->txtgenero,
                'created_at' => $created,
                'activo' => true,
                'id_status_persona' => 'R'
                ]
        );
        return $idPersona;
    }

    public static function updatePersona($request,$idPersona){
        $updated = date('Y-m-d H:i:s');
        $actualizaPersona = DB::table('personas')
        ->where('id','=',$idPersona)
        ->update(
            ['genero'=> $request->txtgenero,
            'telefono' => $request->telefonoF,
            'updated_at' => $updated,
            'num_empleado' => $request->txtnumemp,
            'id_status_persona' => 'A',
            'email' => $request->email
            ]);
        return $actualizaPersona;
    }

    public static function editarDatosFis($request,$idPersona){
        $updated = date('Y-m-d H:i:s');
        $persona = new Personas();
        $existeEmail = $persona->existeEmail($request->email,$idPersona);
        if(count($existeEmail)>0){
            return "existe";
        }else{
            $updateTel = DB::table('personas')
            ->where('id','=',$idPersona)
            ->update(
                ['telefono' => $request->ntelefono1,'updated_at' => $updated]);
        return $updateTel;
        }

    }

    public static function existePersonaEmail($email){
        $email = DB::table('personas')
                    ->select('email')
                    ->where('email','ilike',$email)
                    ->where('id_status_persona','<>','P')
                    ->get();
        return $email;
    }

    public static function existeEmail($email,$idPersona){
        $email = DB::table('personas')
                    ->where('email','=',$email)
                    ->where('id',"<>",$idPersona)
                    ->get();
        return $email;
    }

    public static function getPersonaId($idPersona){
        $persona = DB::table('personas')
                    ->where('id','=',$idPersona)
                    ->first();
        return $persona;
    }

    public static function existePersonaRfc($rfc){
        $email = DB::table('personas')
                    ->where('rfc','=',$rfc)
                    ->get();
        return $email;
    }

    public static function getPersonaRfc($rfc){
        $persona = DB::table('personas')
                    //->where(DB::raw('upper(rfc)'),'=',strtoupper($rfc))
                    ->whereRaw("upper(rfc) = '".mb_strtoupper($rfc)."'")
                    ->get();
        return $persona;
    }

    public static function getCurpPersona($curp){
        $persona = DB::table('personas')
                    ->where('curp','=',$curp)
                    ->get();
        return $persona;
    }

    public static function getLaboralesPersona($id_persona){
        $persona = DB::table('laborales_persona')
                    ->where('id_persona','=',$id_persona)
                    ->first();
        return $persona;
    }

    public static function existePersonacCurp($curp){
        $curp = DB::table('personas')
                    ->where('curp','=',$curp)
                    ->get();
        return $curp;
    }

    public static function updatePersonaEnte($request){
        $updated = date('Y-m-d H:i:s');
        $idPersona= Hashids::decode($request->hashid);
        $updateEnte = DB::table('personas')
        ->where('id','=',$idPersona)
        ->update(
            ['curp'=> mb_strtoupper($request->curp),
            'rfc'=> mb_strtoupper($request->rfc).mb_strtoupper($request->homoclave),
            'nombre'=> $request->nombre,
            'primer_ap'=> $request->paterno,
            'segundo_ap'=> $request->materno,
            'email'=> $request->correo,
            'telefono' => $request->telefono,
            'updated_at' => $updated
            ]);
        return $updateEnte;
    }

    public static function updateLabPersonaEnte($id_persona,$area,$cargo){
        $updated = date('Y-m-d H:i:s');
        $updateLabPersonaEnte = DB::table('laborales_persona')
        ->where('id_persona','=',$id_persona)
        ->update(
            ['area'=> $area,
            'cargo'=> $cargo,
            'updated_at' => $updated
            ]);
        return $updateLabPersonaEnte;
    }

    public static function existePreReg($rfc){
        $preReg = DB::table('personas')
                    ->where('rfc','=',$rfc)
                    ->where('id_status_persona','=','P')
                    ->first();
        return $preReg;
    }

    public static function getPersonaEmail($email){
        //Log::debug("email: " . $email);
        $persona = DB::table('personas')
                    ->where('email','=',$email)
                    ->get();
        //Log::debug("persona: " . $persona);
        return $persona;
    }

    public function usuario(){

        return $this->hasOne('App\User', 'id_persona');
    }

    public function personalProyectos(){
        return $this->hasMany('App\PersonalProyecto', 'id_persona');
    }

    public function Datosprofesionales(){
        return $this->hasMany('App\ProfesionalesPersona', 'id_persona');
    }

    public function participantes(){
        return $this->hasMany('App\Participante', 'id_persona');
    }

    public function recepcionProyecto(){
        return $this->hasMany('App\RecepcionProyecto','id_persona');
    }

    public function participante_actas()
    {
        return $this->hasMany('App\ParticipantesActa','id_persona');
    }
    public function puesto_persona()
    {
        return $this->hasMany('App\PuestosPersona','id_persona');
    }
    public function ponentes()
    {
        return $this->hasMany('App\Ponente','persona_id');
    }
	
	public function ponente()
    {
        return $this->hasOne('App\Ponente','persona_id');
    }
	
    public function participaciones_eventos()
    {
        return $this->hasMany('App\ParticipanteEvento','persona_id');
    }

    public function status_persona()
    {
        return $this->belongsTo('App\CatStatusPersona','id_status_persona');
    }
    public function registrosParaRevision()
    {
        return $this->hasMany('App\RegistroRevision','persona_id');
    }

}
