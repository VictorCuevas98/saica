<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

use App\Ponente;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'rfc', 'password','activo','id_persona' , 'remember_password','id_status_persona'
    ];
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function crearUsuario($request,$idPersona){
        $created = date('Y-m-d H:i:s');
        $id_role="";
       
        $rfc=$request->txtrfc;
        
        $idUsuario = DB::table('users')->insertGetId(
            ['rfc'=>strtoupper($rfc),'activo' =>'f', 'remember_password' => 'f', 'created_at' => $created, 'id_persona' => $idPersona]);
        $user = User::where('id','=',$idUsuario)->first();
        $rol = DB::table('roles')->where('id', '=',2)->get();
        $user->assignRole($rol[0]->name); 
        return $idUsuario;  
    }

    public static function crearUsuarioManual($request,$idPersona){
        $created = date('Y-m-d H:i:s');
        $id_role="";
       
        $rfc=$request->txtrfcManual;
        
        $idUsuario = DB::table('users')->insertGetId(
            ['rfc'=>strtoupper($rfc),'activo' =>'f', 'remember_password' => 'f', 'created_at' => $created, 'id_persona' => $idPersona]);
        $user = User::where('id','=',$idUsuario)->first();
        return $idUsuario;  
    }

    public static function crearUsuarioPersona($request,$datos){
        $created = date('Y-m-d H:i:s');
        $id_role="";
        $idUsuario = DB::table('users')->insertGetId(
            ['rfc'=>strtoupper($datos[0]->rfc),'activo' =>'f', 'remember_password' => 'f', 'created_at' => $created, 'id_persona' => $datos[0]->id]);
        $user = User::where('id','=',$idUsuario)->first();
        $rol = DB::table('roles')->where('id', '=',3)->get();
        $user->assignRole($rol[0]->name); 
        return $idUsuario;  
    }

    public static function existeUsuario($rfc){
        $usuario = DB::table('users')
                    ->where('rfc','=',$rfc)
                    ->get();
        return $usuario;
    }
    public static function existeUsuarioCurp($curp){
        $usuario = DB::table('personas')
                    ->where('curp','=',$curp)
                    ->exists();
        return $usuario;
    }


    public static function existeUsuarioPonentes($rfc){
        $usuario = User::where('rfc','=',$rfc)
                    ->first();
        return $usuario;
    }

    public static function existeUsuarioPonentesRegistrados($rfc){
        $usuario = DB::table('users as us')->where('us.rfc','=',$rfc)
                    ->first();
                    /* dump($usuario); */
        $personas = DB::table('personas')->where('id','=',$usuario->id_persona)
                    ->first();
                    //dd($usuario);
                    /* dump($personas); */
        $existePonentes = Ponente::where('persona_id',$personas->id)->exists();
        /* dd($existePonentes); */            
        return $existePonentes;
    }

    public static function existUserInactivo($id){
        $usuario = DB::table('users')
                    ->where('id','=',$id)
                    ->where('activo','=','f')
                    ->get();
        return $usuario;
    }


    public static function getUsuarioId($id){
        $usuario = DB::table('users')
                    ->where('id','=',$id)
                    ->first();
        return $usuario;
    }

    public static function getUsuarioIdPersona($idPersona){
        $usuario = DB::table('users')
                    ->where('id_persona','=',$idPersona)
                    ->first();
        return $usuario;
    }


    public static function activarUsuario($request){
        $idUser = Hashids::decode($request->hashid);
        $activar = DB::table('users')
              ->where('id', '=', $idUser)
              ->update(['password' =>  Hash::make($request->password), 'activo' => 't']);
        return $activar;
    }
    
    public function persona()
    {
        
        return $this->belongsTo('App\Personas','id_persona');

    }

    public static function editarMail($request,$idUsuario){
        $updated = date('Y-m-d H:i:s');
        
        $updateMail = DB::table('users')
        ->where('id','=',$idUsuario)
        ->update(
            ['email' => $request->email,'updated_at' => $updated]);
    
        return $updateMail;  
    }

    public static function updatePassword($request,$id_usuario){
        $updated = date('Y-m-d H:i:s');      
        $updatePass = DB::table('users')
        ->where('id','=',$id_usuario)
        ->update(
            ['password' =>  Hash::make($request->passwordnew),'updated_at' => $updated]);
    
        return $updatePass;  
    }

    public static function updateRememberPwd($rfc){
        $updateRemPwd = DB::table('users')
              ->where('rfc', '=', $rfc)
              ->update(['remember_password' => true]);
        return $updateRemPwd;
    }

    public static function getUserRfc($rfc){
        $usuario = DB::table('users')
                    ->whereRaw("upper(rfc) = '".strtoupper($rfc)."'")
                    ->get();
        return $usuario;
    }
    public static function existPwdRemember($id){
        $usuario = DB::table('users')
                    ->where('id','=',$id)
                    ->where('remember_password','=','t')
                    ->get();
        return $usuario;
    }

    public static function updateRememberPassword($request){
        $updated = date('Y-m-d H:i:s');      
        $updatePass = DB::table('users')
        ->where('rfc','=',$request->rfc)
        ->update(
            ['password' =>  Hash::make($request->password),'updated_at' => $updated,'remember_password' => "f"]);
    
        return $updatePass;  
    }

    public static function getPersonaRole($role,$id_usuario){
        $usuario = DB::table('users as u')
            ->select('u.id_persona','u.rfc','p.nombre','p.primer_ap','p.segundo_ap','p.email','r.name')
            ->join('personas as p','u.id_persona','=','p.id')
            ->join('model_has_roles as mh','u.id','=','mh.model_id')
            ->join('roles as r','r.id','=','mh.role_id')
            ->where('r.name','like',"%".$role."%")
            ->where('u.id','<>',$id_usuario)
            ->whereNull('u.deleted_at')
            ->get();
        return $usuario;
    }

    public static function crearUsuarioEnte($request,$idPersona){
        $created = date('Y-m-d H:i:s');
        $idUsuario = DB::table('users')->insertGetId(
            ['rfc'=>strtoupper($request->rfc.$request->homoclave),'activo' =>'f', 'remember_password' => 'f', 'created_at' => $created, 'id_persona' => $idPersona]);
        $user = User::where('id','=',$idUsuario)->first();
        $rol = DB::table('roles')->where('id', '=',$request->perfil)->get();
        $user->assignRole($rol[0]->name); 
        return $idUsuario;  
    }

    public static function getRolUsuarioPersona($id_persona){
        $usuario = DB::table('users as u')
        ->select('r.id','u.id as id_usuario','r.name')
        ->join('personas as p','u.id_persona','=','p.id')
        ->join('model_has_roles as mh','u.id','=','mh.model_id')
        ->join('roles as r','r.id','=','mh.role_id')
        ->where('u.id_persona','=',$id_persona)
        ->whereNull('u.deleted_at')
        ->first();
        return $usuario;
    }

    public static function updateUserRole($rfc,$id_usuario,$id_role){
        $updated = date('Y-m-d H:i:s');
        $updateUser = DB::table('users')
        ->where('id','=',$id_usuario)
        ->update(
            [
            'rfc'=> $rfc,
            'updated_at' => $updated
            ]);
        $user = User::where('id','=',$id_usuario)->first();
        $rolAnterior = DB::table('roles as r')
        ->join('model_has_roles as mh','r.id','=','mh.role_id')
        ->where('mh.model_id', '=',$id_usuario)->first();
        $user->removeRole($rolAnterior->name);
        $rol = DB::table('roles')->where('id', '=',$id_role)->get();
        $user->assignRole($rol[0]->name);

        return $updateUser;
    }

    public static function updateUserDelete($id_usuario){
        $deletedat = date('Y-m-d H:i:s');
        $updateUser = DB::table('users')
        ->where('id','=',$id_usuario)
        ->update(
            [
            'activo'=> 'f',
            'deleted_at' => $deletedat
            ]);
        return $updateUser;
    }

    public static function getInvitadoReg($idPersona){
        $invitadoReg = DB::table('invitacion_registro')
                    ->where('id_persona','=',$idPersona)
                    ->first();
        return $invitadoReg;
    }


    //scope

    public function scopeActivosUsuarios($query){
        return $query->where('users.activo',true);
    }

    public function scopeOrdenUsuarios($query){
        return $query->orderBy('users.id','ASC');
    }

    public function scopeEstadoUsuarios($query,$estadoUsuario){
        if($estadoUsuario){
            return $query->Where('users.activo',$estadoUsuario);
        }
        
    }

    public function scopeRfc($query, $rfc)
    {
        if($rfc)
        {

            return $query->Where('users.rfc', 'ILIKE',"%$rfc%");
        }
    }

    public function scopeNombre($query, $nombre)
    {
        if($nombre)
        {

            return $query->Where('personas.nombre', 'ILIKE',"%$nombre%");
        }
    }

    public function scopePrimerApellido($query, $primer_ap)
    {
        if($primer_ap)
        {

            return $query->Where('personas.primer_ap', 'ILIKE', "%$primer_ap%");
        }
    }

    public function scopeSegundoApellido($query, $segundo_ap)
    {
        if($segundo_ap)
        {

            return $query->Where('personas.segundo_ap', 'ILIKE', "%$segundo_ap%");
        }
    }

    public function scopeEmail($query, $email)
    {
        if($email)
        {
            return $query->Where('personas.email', 'ILIKE', "%$email%");
        }
    }

    public function scopeLastLogin($query, $last_login)
    {
        if($last_login)
        {
            return $query->Where('last_login', '<=', DB::raw("now() - INTERVAL '$last_login'"));
        }
    
    }
}
