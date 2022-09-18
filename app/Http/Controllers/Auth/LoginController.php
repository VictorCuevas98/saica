<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\eFirma;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Roles;
use App\CatTipoProf;
use Spatie\Permission\Contracts\Role;
use App\CatTipoContratacion;
use App\EntesPulicos;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername(); //fieldType
        
    }

    public function validar(Request $request){

        $extension = $request->file[0]->getClientOriginalExtension();
        if($_FILES['file']['type'][0]=='application/pkix-cert' || $extension=="cer"){
            $cer=file_get_contents($_FILES['file']['tmp_name'][0]);
            $key=file_get_contents($_FILES['file']['tmp_name'][1]);
        }else{
            $key=file_get_contents($_FILES['file']['tmp_name'][0]);
            $cer=file_get_contents($_FILES['file']['tmp_name'][1]);
        }

        $password=$request['password'];
        #Arreglo para iniciar sesión vía WS
        $dataUser = array('key' => $key,'cer' => $cer,'password' => $password);

        #Instancio un objeto de la clase eFirma para utilizar el webService eFirmaLogin
        $eFirma = new eFirma();
        $wsResponse = $eFirma->eFirmaLogin($dataUser);
        $error="";

        if ($wsResponse->error->code != 0){
          // la fiel es incorrecta
          switch($wsResponse->error->code){
            case 10:
              $error="Los datos ingresados no son correctos, favor de verificar su password.";
            break;
            default:
              $error="Ocurrio el siguiente error: ".$wsResponse->error->msg.". Favor de reportalo al correo mesadeservicio@finanzas.cdmx.gob.mx";
            break;
          }

          return $response=['success'=>false, 'error' => $error];

        }else{

          // la fiel es correcta
          $rfc=$wsResponse->data->RFC;
          $datosUsuario=DB::table('users')
          ->where('rfc', '=', $rfc)
          ->where('activo',true)
          ->first();

          if( $datosUsuario && Auth::loginUsingId($datosUsuario->id)) {
            $request->session()->put('cer', $dataUser['cer']);
            $request->session()->put('key', $dataUser['key']);
            $request->session()->put('password', $dataUser['password']);
            return $response=['success'=>true,'error'=>""];
          }else{
            return $response=['success'=>false, 'error' => 'Usuario no registrado'];
          }
        }

    }

    public function findUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'rfc';

        request()->merge([$fieldType => strtoupper($login)]);

        return $fieldType;
    }

    public function username()
    {
        return strtoupper($this->username);
    }

    public function customLogin(Request $request)
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];

        $messages = [
            'username.required' => 'Ingrese su RFC',
            'password.required' => 'Ingrese su Contraseña',
        ];

        $this->validate($request, $rules, $messages);
        // attempt to log the user in
        if ($this->attemptLogin($request)) {
            // if successful, then redirect to their intended location
            return $this->sendLoginResponse($request);

        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'credenciales' => 'RFC o Contraseña Inválidos',
        ]);
    }

    protected function validateLogin(Request $request)
    {
        $messages = [
            'username.required' => 'Ingrese su RFC',
            'password.required' => 'Ingrese su Contraseña',
        ];

        $request->validate($messages);
    }

    protected function authenticated(Request $request, $user)
    {
        $user->last_login = Carbon::now()->toDateTimeString();
        $user->save();
        //log($user);
        $rolesHasModel = DB::table('model_has_roles')->where('model_id', Auth::user()->id)->get();
        $redirect = 'home';
        /*foreach ($rolesHasModel as $roleInModel)
        {
            $role = DB::table('roles')->where('id', $roleInModel->role_id)->first()->name;
            if ('ADMIN' == $role)
            {
                $redirect = 'admin';
            } else {
                $redirect = 'login';
            }
            //TODO::QUITAR SERVIDOR PUBLICO UNA VEZ QUE ESTÉ EL ROL DE PIONENTE
        }*/
      return redirect()->route($redirect);
    }

    public function login(){
        $catTipoContratacion=CatTipoContratacion::activos()->get();
        $entesPublicos = EntesPulicos::where('activo',true)->get();
        return view('auth.login',compact("catTipoContratacion",'entesPublicos'));
    }

    protected function credentials(Request $request)
    {
        $request['activo'] = true;
        return $request->only('rfc', 'password','activo');
    }

    public function errorBrowser(){
      return view('auth.errorBrowser');
    }

}
