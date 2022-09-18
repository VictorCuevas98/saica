{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')
{{-- Dashboard 1 --}}
<div class="row" id="cont_dash">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <div class="card card-custom card-stretch gutter-b">
         <!--begin::Wizard-->
         <div class="wizard wizard-1" id="kt_wizard_v1" data-wizard-state="step-first" data-wizard-clickable="false">
            <!--begin::Wizard Nav-->
            <div class="wizard-nav border-bottom">
               <div class="wizard-steps p-12 p-lg-12">
                  <!--begin::Wizard Step 1 Nav-->
                  <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                     <div class="wizard-label">
                        <i class="wizard-icon flaticon-computer"></i>
                        <h3 class="wizard-title">INICIO</h3>
                     </div>
                     <span class="svg-icon svg-icon-xl wizard-arrow">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                              <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </div>
                  <!--end::Wizard Step 1 Nav-->
                  <!--begin::Wizard Step 2 Nav-->

                  <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                     <div class="wizard-label">
                        <i class="wizard-icon flaticon-folder-1"></i>
                        <h3 class="wizard-title">REGISTRO</h3>
                     </div>
                     <span class="svg-icon svg-icon-xl wizard-arrow">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                              <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </div>
                  <!--end::Wizard Step 2 Nav-->
                  <!--begin::Wizard Step 3 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                     <div class="wizard-label">
                        <i class="wizard-icon flaticon2-pen"></i>
                        <h3 class="wizard-title">FIRMAR</h3>
                     </div>
                     <span class="svg-icon svg-icon-xl wizard-arrow">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                              <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </div>
                  <!--end::Wizard Step 3 Nav-->
                  <!--begin::Wizard Step 4 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                     <div class="wizard-label">
                        <i class="wizard-icon flaticon-doc"></i>
                        <h3 class="wizard-title">FORMATO</h3>
                     </div>
                     <span class="svg-icon svg-icon-xl wizard-arrow">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                              <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </div>
                  <!--end::Wizard Step 4 Nav-->
                  <!--begin::Wizard Step 5 Nav-->
                  <div class="wizard-step" data-wizard-type="step">
                     <div class="wizard-label">
                        <i class="wizard-icon flaticon2-checkmark"></i>
                        <h3 class="wizard-title">FINALIZAR</h3>
                     </div>
                     <span class="svg-icon svg-icon-xl wizard-arrow last">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24" />
                              <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                              <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </div>
                  <!--end::Wizard Step 5 Nav-->
               </div>
            </div>
            <!--end::Wizard Nav-->
            <!--begin::Wizard Body-->
            <div class="row justify-content-center my-10 px-10 my-lg-15 px-lg-12">
               <div class="col-xl-12 col-xxl-9">
                  <!--begin::Wizard Form-->
                  <form class="form" id="kt_form">
                     <!--begin::Wizard Step 1-->
                     <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">

                       <video id="sample_video" width="100%" autoplay muted controls>
                         <source src="videos/previt.mp4" type="video/mp4">
                       </video>

                     </div>
                     <!--end::Wizard Step 1-->
                     <!--begin::Wizard Step 2-->
                     <div class="pb-5" data-wizard-type="step-content">
                         <div class="alert alert-custom alert-light-dark fade show mb-5" role="alert">
                            <div class="alert-icon">
                               <i class="flaticon-warning"></i>
                            </div>
                            <div class="alert-text" style="text-align:justify">
                               Declaro bajo protesta de decir verdad que la información y documentación proporcionada es verídica, por lo que en caso de existir falsedad en ella, tengo pleno conocimiento que se aplicarán las sanciones administrativas y penas establecidas en los ordenamientos respectivos para quienes se conducen con falsedad ante la autoridad competente, en términos del artículo 32 de la Ley de Procedimiento Administrativo de la Ciudad de México y con relación al 311 del Código Penal para el Distrito Federal.
                            </div>
                         </div>
                         <input type="hidden" id="proyecto_hidden">
                         <div id="contenedor_formularios"></div>

                     </div>
                     <!--end::Wizard Step 2-->
                     <!--begin::Wizard Step 3-->
                     <div class="pb-5" data-wizard-type="step-content">
                        <div id="contenedor_firmas"></div>
                     </div>
                     <!--end::Wizard Step 3-->
                     <!--begin::Wizard Step 4-->
                     <div class="pb-5" data-wizard-type="step-content">
                         <embed src="{{ URL::asset('media/pdfs/anexo1.pdf') }}" type="application/pdf" width="100%" height="500"></embed>
                     </div>
                     <!--end::Wizard Step 4-->
                     <!--begin::Wizard Step 5-->
                     <div class="pb-5" data-wizard-type="step-content">
                       <h4 class="mb-10 font-weight-bold text-dark">¡Completaste tu registro exitosamente!</h4>
                       <div class="alert alert-custom alert-light-warning fade show mb-5" role="alert">
 												  <div class="alert-icon">
 													 	 <i class="flaticon-warning"></i>
 												  </div>
 												  <div class="alert-text">Para finalizar da click en el boton TERMINAR</div>
 											 </div>
                     </div>
                     <!--end::Wizard Step 5-->
                     <!--begin::Wizard Actions-->
                     <div class="d-flex justify-content-between border-top mt-5 pt-10">

                        <div class="mr-2">
                           <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev" onclick="botonAtras();">REGRESAR</button>
                        </div>
                        <div>
                           <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">TERMINAR</button>
                           <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" id="continuar" data-wizard-type="action-next" onclick="botonSiguiente();">CONTINUAR</button>
                        </div>
                     </div>

                     <!--end::Wizard Actions-->
                  </form>
                  <!--end::Wizard Form-->
               </div>
            </div>
            <!--end::Wizard Body-->
         </div>
         <!--end::Wizard-->
      </div>
      <!--begin::Scrolltop-->
  <div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
      <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <polygon points="0 0 24 0 24 24 0 24" />
          <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
          <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
        </g>
      </svg>
      <!--end::Svg Icon-->
    </span>
  </div>
   </div>
</div>
@endsection
{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pages/custom/wizard/wizard-1.js') }}" type="text/javascript"></script>



<script>

  var paso = 0;


  function botonAtras() {
	  //console.log('boton siguqinte');
    paso = paso - 1;
    $('#continuar').show();
    if(paso === 1)
	  {
      valida_step3();
	  }
    if(paso === 2)
	  {
      valida_step5();
	  }
  }

  function botonSiguiente(){
    paso = paso + 1;
    $('#continuar').show();

    if(paso === 1)
	  {
      valida_step3();
	  }
    if(paso === 2)
	  {
      valida_step5();
	  }
  }

  function valida_step3(){

      //desactiva boton continuar
      $('#continuar').hide();
      // manda primer formulario
      $("#contenedor_formularios").load("{{ url('/datos_proyecto') }}");

  }

  function valida_step5(){

      //desactiva boton continuar
    //  $('#continuar').hide();
      // manda primer formulario
      $("#contenedor_firmas").load("{{ url('/firmas') }}");

  }

  function valida_dnotificaciones(){
    if( $('#check_domicilio_notificaciones').prop('checked') ) {
      $('#cont_domicilio_notificacion').hide();
    }else{
        $('#cont_domicilio_notificacion').show();
    }
  }

  function valida_datos_proyecto(){

    if($('#nombre_proyecto').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Nombre de Proyecto!", "error"); }
    else if($('#id_programa').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Programa o Norma de Aplicación!", "error"); }
    else if($('#cpostal_proyecto').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Codigo Postal!", "error"); }
    else if($('#id_alcaldia_proyecto').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Alcaldía!", "error"); }
    else if($('#id_colonia_proyecto').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Colonia!", "error"); }
    else if($('#calle_proyecto').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Calle!", "error"); }
    else if($('#nexterior_proyecto').val()==""){ swal.fire("Mensaje!", "Olvido ingresar N.Exterior!", "error"); }
    else if($('#cuenta_catastral').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Cuenta Catastral!", "error"); }
    else if($('#cuenta_agua').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Cuenta de Agua!", "error"); }
    else if($('#descripcion').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Descripción!", "error"); }

    else{
      $('#exampleModalSizeLg').modal();
    }

  }

  function valida_datos_interesado(){

    if($('#cpostal_fiscal').val()==""){ swal.fire("Mensaje!", "Olvido ingresar codigo postal!", "error"); }
    else if($('#id_entidad_fiscal').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Entidad!", "error"); }
    else if($('#id_alcaldia_fiscal').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Alcaldía!", "error"); }
    else if($('#id_colonia_fiscal').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Colonia!", "error"); }
    else if($('#calle_fiscal').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Calle!", "error"); }
    else if($('#nexterior_fiscal').val()==""){ swal.fire("Mensaje!", "Olvido ingresar N. Exterior!", "error"); }
    else if( $('#check_domicilio_notificaciones').prop('checked') ) {
       if($('#ntelefono1').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Telefono para notificar!", "error"); }
       else{
         $('#ModalAviso').modal();
       }
    }else{
      if($('#cpostal_notificaciones').val()==""){ swal.fire("Mensaje!", "Olvido ingresar codigo postal para notificar!", "error"); }
      else if($('#id_entidad_notificaciones').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Entidad para notificar!", "error"); }
      else if($('#id_alcaldia_notificaciones').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Alcaldía para notificar!", "error"); }
      else if($('#id_colonia_notificaciones').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Colonia para notificar!", "error"); }
      else if($('#calle_notificaciones').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Calle para notificar!", "error"); }
      else if($('#nexterior_notificaciones').val()==""){ swal.fire("Mensaje!", "Olvido ingresar N. Exterior para notificar!", "error"); }
      else if($('#ntelefono1').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Telefono para notificar!", "error"); }
      else{
        $('#ModalAviso').modal();
      }
    }

  }

  function valida_datos_especializado(){

    if($('#nombre_dro').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Nombre del  DRO!", "error"); }
    else if($('#n_registro_dro').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Registro DRO!", "error"); }
    else if($('#correo_registro_dro').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Correo electrónico DRO!", "error"); }
    else if($('#nombre_pdu').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Nombre del PDU!", "error"); }
    else if($('#n_registro_pdu').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Registro PDU!", "error"); }
    else if($('#correo_registro_pdu').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Correo electrónico PDU!", "error"); }
    else if($('#nombre_tercer_acreditado').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Nombre del Tercer Acreditado!", "error"); }
    else if($('#n_registro_tercer_acreditado').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Registro de tercer Acreditado!", "error"); }
    else if($('#correo_registro_tercer_acreditado').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Correo electrónico de tercer Acreditado!", "error"); }
    else if($('#nombre_servicios_ambientales').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Nombre de prestador de servicios ambientales!", "error"); }
    else if($('#paterno_servicios_ambientales').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Apellido paterno de prestador de servicios ambientales!", "error"); }
    else if($('#materno_servicios_ambientales').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Apellido materno de prestador de servicios ambientales!", "error"); }
    else if($('#cedula_servicios_ambientales').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Cedula de prestador de servicios ambientales!", "error"); }
    else if($('#formacion_academica').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Formacion Academicade prestador de servicios ambientales!", "error"); }
    else if($('#correo_servicios_ambientales').val()==""){ swal.fire("Mensaje!", "Olvido ingresar Correo electrónico de prestador de servicios ambientales!", "error"); }

    else{
      $('#exampleModalSizeLg').modal();
    }

  }


  function buscar_cp(){
      if($('#cpostal_fiscal').val()==""){
         // limpiar combos
         $('#id_entidad_fiscal').html('<option value="">Selecciona</option>');
         $('#id_alcaldia_fiscal').html('<option value="">Selecciona</option>');
         $('#id_colonia_fiscal').html('<option value="">Selecciona</option>');
      }else{
        // busca cp
        $.ajax({
          url: "{{ url('buscar_cp')}}",
          type: 'POST',
          data: 'cp='+$('#cpostal_fiscal').val()+'&_token='+"{{ csrf_token() }}",
          dataType: "json",
          success: function(respuesta){

            // limpiar combos
            $('#id_entidad_fiscal').html('<option value="">Selecciona</option>');
            $('#id_alcaldia_fiscal').html('<option value="">Selecciona</option>');
            $('#id_colonia_fiscal').html('<option value="">Selecciona</option>');

            if(respuesta.length>0){
              //agrega Entidad
              $('#id_entidad_fiscal').append("<option value='"+respuesta[0].id_entidad+"' selected>"+respuesta[0].entidad+"</option>");
              $('#id_alcaldia_fiscal').append("<option value='"+respuesta[0].id_alcaldia+"' selected>"+respuesta[0].alcaldia+"</option>");
              for(var i=0; i<respuesta.length;i++){
                  $('#id_colonia_fiscal').append("<option value='"+respuesta[i].id_colonia+"'>"+respuesta[i].colonia+"</option>");
              }
            }
          },
          error: function(){
             swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
             return false;
           }
        });
      }
  }

  function buscar_cp_proyecto(){
      if($('#cpostal_proyecto').val()==""){
         // limpiar combos
         $('#id_alcaldia_proyecto').html('<option value="">Selecciona</option>');
         $('#id_colonia_proyecto').html('<option value="">Selecciona</option>');
      }else{
        // busca cp
        $.ajax({
          url: "{{ url('buscar_cp')}}",
          type: 'POST',
          data: 'cp='+$('#cpostal_proyecto').val()+'&_token='+"{{ csrf_token() }}",
          dataType: "json",
          success: function(respuesta){

            // limpiar combos
            $('#id_alcaldia_proyecto').html('<option value="">Selecciona</option>');
            $('#id_colonia_proyecto').html('<option value="">Selecciona</option>');

            if(respuesta.length>0){
              //agrega Entidad
              $('#id_alcaldia_proyecto').append("<option value='"+respuesta[0].id_alcaldia+"' selected>"+respuesta[0].alcaldia+"</option>");
              for(var i=0; i<respuesta.length;i++){
                  $('#id_colonia_proyecto').append("<option value='"+respuesta[i].id_colonia+"'>"+respuesta[i].colonia+"</option>");
              }
            }
          },
          error: function(){
             swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
             return false;
           }
        });
      }
  }

  function buscar_cp_notificaciones(){
      if($('#cpostal_notificaciones').val()==""){
         // limpiar combos
         $('#id_entidad_notificaciones').html('<option value="">Selecciona</option>');
         $('#id_alcaldia_notificaciones').html('<option value="">Selecciona</option>');
         $('#id_colonia_notificaciones').html('<option value="">Selecciona</option>');
      }else{
        // busca cp
        $.ajax({
          url: "{{ url('buscar_cp')}}",
          type: 'POST',
          data: 'cp='+$('#cpostal_notificaciones').val()+'&_token='+"{{ csrf_token() }}",
          dataType: "json",
          success: function(respuesta){

            // limpiar combos
            $('#id_entidad_notificaciones').html('<option value="">Selecciona</option>');
            $('#id_alcaldia_notificaciones').html('<option value="">Selecciona</option>');
            $('#id_colonia_notificaciones').html('<option value="">Selecciona</option>');

            if(respuesta.length>0){
              //agrega Entidad
              $('#id_entidad_notificaciones').append("<option value='"+respuesta[0].id_entidad+"' selected>"+respuesta[0].entidad+"</option>");
              $('#id_alcaldia_notificaciones').append("<option value='"+respuesta[0].id_alcaldia+"' selected>"+respuesta[0].alcaldia+"</option>");
              for(var i=0; i<respuesta.length;i++){
                  $('#id_colonia_notificaciones').append("<option value='"+respuesta[i].id_colonia+"'>"+respuesta[i].colonia+"</option>");
              }
            }
          },
          error: function(){
             swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
             return false;
           }
        });
      }
  }

  function guardar_datos_interesado(){
    if($('#ModalAviso').modal('hide')){
    $.ajax({
      url: "{{ url('guardar_datos_interesado')}}",
      type: 'POST',
      data: $("#kt_form").serialize()+'&id_proyecto='+$('#proyecto_hidden').val()+'&_token='+"{{ csrf_token() }}",
      dataType: "json",
      success: function(respuesta){
        if(respuesta!=false){

          setTimeout(function(){
            swal.fire("Mensaje!", "Se guardo correctamente!", "success");
            $("#contenedor_formularios").load("{{ url('/datos_personal_especializado') }}");
            $('html,body').animate({
              scrollTop: $("#kt_body").offset().top
            }, 500);
          }, 500);

        }else{
          swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
          return false;
        }
      },
      error: function(){
         swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
         return false;
       }
    });
      }
  }


  function guardar_datos_especializado(){
          $('#exampleModalSizeLg').modal('hide');

          setTimeout(function(){
            swal.fire("Mensaje!", "Se guardo correctamente! Terminaste tu registro.", "success");
            $("#contenedor_formularios").html("");
            $('#continuar').show();
            $('html,body').animate({
              scrollTop: $("#kt_body").offset().top
            }, 500);
          }, 2000);
  }


  function guardar_datos_proyecto(){
    if($('#exampleModalSizeLg').modal('hide')){
    $.ajax({
      url: "{{ url('guardar_datos_proyecto')}}",
      type: 'POST',
      data: $("#kt_form").serialize()+'&_token='+"{{ csrf_token() }}",
      dataType: "json",
      success: function(respuesta){
        if(respuesta!=false){
          swal.fire("Mensaje!", "Se guardo correctamente!", "success");
          $("#contenedor_formularios").load("{{ url('/datos_interesado') }}");
          $('#proyecto_hidden').val(respuesta);
          $('html,body').animate({
            scrollTop: $("#kt_body").offset().top
          }, 500);
        }else{
          swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
          return false;
        }
      },
      error: function(){
         swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
         return false;
       }
    });
      }
  }

  $(document).ready(function() {
    setTimeout(function(){
      $('#sample_video').get(0).play();
    }, 500);
  });

</script>
@endsection
