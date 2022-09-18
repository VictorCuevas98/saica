@extends('layouts.app')
@section('content')
@include('registro.registro_manual_servidor_publico', ['entesPublicos'=>$entesPublicos,'catTipoContratacion'=>$catTipoContratacion])
<!--begin::Main-->
 
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
   <!--begin::Login-->
   <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
      <!--begin::Aside-->
      <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
         <!--begin: Aside Container-->
         <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
            <!--begin::Logo-->
            <a class="text-center pt-2">
               <img src="media/logos/logo-sedesa.png" class="max-h-75px" alt="">
            </a>
            <!--end::Logo-->
            <!--begin::Aside body-->
            <div class="d-flex flex-column-fluid flex-column flex-center">
               <!--begin::Signin-->
               <div class="login-form login-signin py-11">
                  <!--begin::Form-->

                  <!--begin::Title-->
                  <div class="text-center pb-8">
                     <h2 class="font-weight-bolder text-primary font-size-h2 font-size-h1-lg">Ingresar</h2>
                  </div>
                  <!--end::Title-->

                  {{--@if ($errors->has('rfc') || $errors->has('email'))
                  <p class="bg-danger text-white py-2 px-4">{{ $errors->first('rfc') ?: $errors->first('email') }}</p>
                  @endif --}}
                  @error('username')
                  <p class="bg-danger text-white py-2 px-4">{{ $message }}</p>
                  @enderror
                  @error('password')
                  <p class="bg-danger text-white py-2 px-4">{{ $message }}</p>
                  @enderror
                  @error('credenciales')
                  <p class="bg-danger text-white py-2 px-4">{{ $message }}</p>
                  @enderror
                  <form method="post" action="{{url('loginRFC')}}">
                     @csrf

                     <!--begin::Form group-->
                     <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-success">RFC</label>
                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="username" id="username" autocomplete="off" style="text-transform:uppercase;" maxlength="13" onkeyup="javascript:this.value=this.value.toUpperCase();">
                     </div>
                     <!--end::Form group-->
                     <!--begin::Form group-->
                     <div class="form-group">
                        <div class="d-flex justify-content-between mt-n5">
                           <label class="font-size-h6 font-weight-bolder text-success pt-5">Contraseña</label>
                           <a href="javascript:;" class="text-primary font-size-h6 font-weight-bolder pt-5" id="kt_login_forgot">¿Olvidaste tu Contraseña?</a>
                        </div>
                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" id="password" autocomplete="off" />
                     </div>

                     <span class="text-muted font-weight-bold font-size-h6 ">
                        <a href="javascript:" class="text-primary font-weight-bolder" id="kt_login_signup">¿No tienes una cuenta? Regístrate</a>
                     </span>

                     <!--end::Form group-->
                     <!--begin::Action-->
                     <div class="text-center pt-6">
                        <button id="buttonEntrar" class="btn btn-success font-weight-bolder font-size-h6 px-8 py-4 my-3">Iniciar</button>
                     </div>
                     <!--end::Action-->
                  </form>
                  <!--end::Form-->
               </div>
               <!--end::Signin-->
               <!--begin::Signup-->
               <div class="login-form login-signup">
                  <div class="text-center mb-10 mb-lg-20">
                     <h3 class="">Regístrate</h3>
                     <p class="text-muted font-weight-bold">Ingrese sus datos para crear su cuenta</p>
                  </div>
                  <!-- Modal-->
                  <div class="modal fade" id="modal_aviso_simplificado" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">AVISO DE PRIVACIDAD SIMPLIFICADO</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <i aria-hidden="true" class="ki ki-close"></i>
                              </button>
                           </div>
                           <div class="modal-body">
                              La Secretaría de Administración y Finanzas, a través de la Coordinación General de Modernización Administrativa es la responsable del tratamiento de los datos personales que nos proporcione.
                              <br />
                              <br />
                              Sus datos personales, serán utilizados con la finalidad de realizar el registro al "Sistema de Encuestas", dar seguimiento a las evaluaciones, elaborar informes, establecer comunicación para brindarle
                              asesoría en el uso del sistema, así como aclarar dudas sobre datos, ya sea por algún error o imprecisión.
                              <br />
                              <br />
                              Si desea conocer nuestro aviso de privacidad integral, lo podra consultar en nuestro portal de internet www.cgma.cdmx.gob.mx
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="$('#modal_aviso_simplificado').modal('hide');">CERRAR</button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--begin::Form-->
                  <form class="form" id="" >
                     <div class="form-group fv-plugins-icon-container">
                        <div class="d-flex justify-content-between mt-n5">
                           <label class="font-size-h6 font-weight-bolder text-dark pt-5">RFC</label>
                        </div>
                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" style="text-transform: uppercase" type="text" name="rfc" id="rfc" maxlength="13" placeholder="RFC" autocomplete="off" />
                        <div class="fv-plugins-message-container"></div>
                     </div>
                     <div class="form-group d-flex flex-wrap flex-center">                        
                        <button id="kt_login_signup_cancel" class="btn btn-light font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Regresar</button>
                        <button type="button" id="buscarfc" class="btn btn-success font-weight-bold px-9 py-4 my-3 mx-2">Continuar</button>
                     </div>
                  </form>
                  <!--end::Form-->
               </div>
               <!--end::Signup-->
               <!--begin::Forgot-->
               <div class="login-form login-forgot pt-11">
                  <!--begin::Form-->
                  <form class="form" id="rememberPass">
                     <!--begin::Title-->
                     <div class="text-center pb-8">
                        <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">¿Olvidaste tu contraseña?</h2>
                        <p class="text-muted font-weight-bold font-size-h4">Ingresa tu RFC</p>
                     </div>
                     <!--end::Title-->
                     <!--begin::Form group-->
                     <div class="form-group">
                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="text" placeholder="RFC" id="rfcforgot" name="rfcforgot" style="text-transform:uppercase;" maxlength="13" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off" />
                     </div>
                     <!--end::Form group-->
                     <!--begin::Form group-->
                     <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">                        
                        <button type="button" id="kt_login_forgot_cancel" class="btn btn-light font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Regresar</button>
                        <button type="button" id="kt_login_forgot_submit_" class="btn btn-success font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4" onclick="actualizarPsswd()">Enviar</button>
                     </div>
                     <!--end::Form group-->
                  </form>
                  <!--end::Form-->
               </div>
               <!--end::Forgot-->
            </div>
            <!--end::Aside body-->       
         </div>
         <!--end: Aside Container-->
      </div>
      <!--begin::Aside-->
      <!--begin::Content-->
      <div class=" order-1 order-lg-2 d-flex flex-column w-100 pb-0" style="
      background-color:#BC955C;
      background-color:#DDc9A3;
      background-size: 100% 148%; background-repeat: no-repeat;
      background-position:center center;
      
         ">
         <!--begin::Image-->
         <!--<img src="{{ asset('media/bg/GRECA-SUPERIOR-SIST-SAICA.png') }}" style="width: 100%;
         vertical-align: top;
         position: fixed;
         " class="max-h-75px"  alt="">-->

         <!--
         <div class="text-center content-img bgi-no-repeat bgi-position-y-bottom bgi-position-x-center">
            <img src="images/bg/DISENO-SIST-SAICA.png">
         </div>
         -->
         <img src="{{ asset('media/bg/DISENO-SIST-SAICA-7-01.svg') }}" style="width: 100%;
         display: block;
         margin-top: auto;
         margin-bottom:auto;
         heigth:auto;"  alt="">
         <!--end::Image-->
      </div>
      <!--end::Content-->
   </div>
   <!--end::Login-->
</div>
<!--end::Main-->


@include('home.ayudaModal')
@include('registro.mensaje')
@include('home.contactoModal')
<!--end::Main-->
@endsection 
@section('scripts')

<script>
   
   var urlGuardarManual = "{{route('guardarUsuario.manual')}}"
   var urlEntidades = "{{route('consulta.entidades')}}"
   var urlUnidadesAdministrativas = "{{route('consulta.unidades.administrativas')}}"
</script>
@if (session('error'))
<script>
   setTimeout(function() {
      swal.fire('¡Aviso!', "{{session('error')}}", 'error');
   }, 500);
</script>
@endif
@if (session('success'))
<script>
   setTimeout(function() {
      swal.fire('¡Aviso!', "{{session('success')}}", 'success');
   }, 500);
</script>
@endif


@endsection
