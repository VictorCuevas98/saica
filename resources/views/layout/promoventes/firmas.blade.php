{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')
{{-- Dashboard 1 --}}
@if (\Session::has('success'))
    <div class="alert alert-success">
      {!! \Session::get('success') !!}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
    </div>
@endif
  @if(count( $errors ) > 0)
     @foreach ($errors->all() as $error)
      <!-- Alert with image / icon -->
      <div class="alert alert-danger"> {{ $error }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
    @endforeach
  @endif

<div class="row">
   <div class="col-xl-12">
      <!--begin::Card-->
      <div class="card card-custom gutter-b card-stretch">
         <div class="card-header">
            <div class="card-title">
               <h3 class="card-label">Proceso de Firmado</h3>
            </div>
            <div class="card-toolbar">
    					<div class="example-tools justify-content-center">
    						<a href="{{ url('pages/seguimiento') }}" class="btn btn-light btn-text-success btn-hover-text-success font-weight-bold mr-2">Regresar</a>
    					</div>
				    </div>
         </div>
         <div class="card-body">

           <div class="alert alert-custom alert-light-dark fade show mb-5" role="alert">
              <div class="alert-icon">
                 <i class="flaticon-warning"></i>
              </div>
              <div class="alert-text" style="text-align:justify">
                 Para EL FIRMADO Y ENVÍO de su registro, debe contar con su e.firma, la cual se tramita previamente ante el Servicio de Administración Tributaria (SAT), o bien descargar el formato para su Firma Autógrafa.
              </div>
           </div>
           <br>
           <h3 class="card-label">Seleccione un tipo de firma:</h3>

           <table class="table table-striped mb-6">
              <tbody>
                 <tr>
                    @if($datos_persona[0]->tipo_persona=='F')
                       <td>{{ $datos_persona[0]->nombre }} {{$datos_persona[0]->primer_ap }} {{$datos_persona[0]->segundo_ap}}</td>
                    @endif
                    @if($datos_persona[0]->tipo_persona=='M')
                    <td>{{ $datos_persona[0]->razon_social }}</td>
                    @endif
                    <td><button type="button" class="btn btn-warning font-weight-bold font-size-h6 x-10 py-4 mr-2" onclick="autografa();"><i class="flaticon2-pen text-danger"></i>FIRMA AUTÓGRAFA</button></td>
                    <td><button type="button" class="btn btn-warning font-weight-bold font-size-h6 x-10 py-4 mr-2" onclick="fiel();"><i class="flaticon2-pen text-danger"></i>FIRMA ELECTRÓNICA AVANZADA</button></td>
                 </tr>
              </tbody>
           </table>
           <br>

           <!--Firma autografa-->

           <div id="contAutografa" style="display:none">
             <div class="form-group">
                 <div class="alert alert-success" role="alert">PROCEDIMIENTO PARA LA FIRMA AUTÓGRAFA</div>
             </div>
             <div class="d-flex align-items-center bg-primary-o-20 rounded p-5" style="text-align:justify">
                <div class="p-1">
                <span class="label">1</span>
                &nbsp;&nbsp;Para dar continuidad con la inscripción al Programa deberá descargar e imprimir el formato que hasta el momento ha sido debidamente requisitado de manera digital.
                </div>
             </div><br>
             <div class="d-flex align-items-center bg-primary-o-20 rounded p-5" style="text-align:justify">
                <div class="p-1">
                <span class="label">2</span>
                &nbsp;&nbsp;En atención a lo señalado por el numeral SEXTO “Acuerdo mediante el cual se establece el programa de reactivación económica y producción de vivienda incluyente, popular y de trabajadores en la Ciudad de México” de fecha 15 de junio de 2020, deberá recabar las firmas autógrafas de las personas que se indican: <br><br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) La persona física o representante legal de persona moral promotora del proyecto; <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b) La persona que funja como Director Responsable de Obra; <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c) La persona que funja como Perito en Desarrollo Urbano; <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d) La persona Prestadora de Servicios Ambientales, y <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;e) La persona Tercera Acreditada.
                </div>
             </div><br>
             <div class="d-flex align-items-center bg-primary-o-20 rounded p-5" style="text-align:justify">
                <div class="p-1">
                <span class="label">3</span>
                &nbsp;&nbsp;Una vez que el formato en soporte físico (impreso) haya sido debidamente requisitado y se encuentre firmado de forma autógrafa por quienes deben hacerlo, deberá digitalizarlo de conformidad a los requisitos que se señalen, hecho lo anterior procederá a cargarlo en el módulo electrónico de PREVIT.
                </div>
             </div><br>
             <div class="d-flex align-items-center bg-primary-o-20 rounded p-5" style="text-align:justify">
                <div class="p-1">
                <span class="label">4</span>
                &nbsp;&nbsp;De conformidad al “Acuerdo mediante el cual se establece el programa de reactivación económica y producción de vivienda incluyente, popular y de trabajadores en la Ciudad de México” de fecha 15 de junio de 2020, el formato denominado “Declaración Bajo Protesta de Decir Verdad y Compromiso de Cumplimiento con la Normativa del Programa de Reactivación Económica y Producción de Vivienda Incluyente, Popular, Social y de Trabajadores en la Ciudad de México”, será analizado por las instancias que deban tener participación.
                </div>
             </div><br>
             <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
               <div class="my-3 mr-2"></div>
               <button type="button" id="buttonAutografo" class="btn btn-primary font-weight-bold px-9 py-4 my-3" onclick="descargar('{{route('descarga.formato',$id_proyecto)}}')">Descargar Formato</button>
             </div>
           </div>
           <!--end::Firma autografa-->

           <!--Firma electrónica-->

              <div id="contFiel" style="display:none">
                <div class="form-group">
                   <div class="alert alert-success" role="alert">DECLARACIONES</div>
                </div>
                <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert" style="text-align:justify">
                    <div class="alert-icon"><i class="flaticon-danger"></i></div>
                    <div class="alert-text">ES IMPORTANTE SEÑALAR QUE SE REQUIERE CONTAR CON LAS FIRMAS ELECTRÓNICAS DEL DRO, P.D.U, P.S.A Y EL TERCER ACREDITADO PARA PODER CONTINUAR CON EL PROCEDIMIENTO, POR LO QUE DEBERÁN REGISTRARSE Y FIRMAR.</div>
                </div>
                <div class="d-flex align-items-center bg-primary-o-20 rounded p-5" style="text-align:justify">
                   <div class="p-1">
                   <span class="label">1</span>
                   &nbsp;&nbsp;Declaración  Bajo Protesta  de  Decir Verdad  y Compromiso de  Cumplimiento  con  la  Normativa  del  Programa de Reactivación Económica y Producción de Vivienda Incluyente, Popular, Social y de Trabajadores en la Ciudad de México.
                   </div>
                </div><br>
                <div class="d-flex align-items-center bg-primary-o-20 rounded p-5" style="text-align:justify">
                   <div class="p-1">
                   <span class="label">2</span>
                   &nbsp;&nbsp;Para realizar el envío de la información solicitada en el programa referido en el párrafo anterior, como medio de identificación de ser la persona firmante, manifiesto utilizar como usuario mi Registro Federal de Contribuyente y como contraseña la que genere de manera libre, espontánea y bajo mi control para ingresar a PREVIT, por lo que es de mi exclusiva responsabilidad su uso y actuare con diligencia asimismo estableceré los medios razonables para evitar la utilización no autorizada de dichos Datos, así como de la información remitida a través de los medios de comunicación electrónica y seré responsable de las consecuencias jurídicas que deriven por no cumplir oportunamente las obligaciones previstas en el citado programa.
                   </div>
                </div><br>
                <div class="d-flex align-items-center bg-primary-o-20 rounded p-5" style="text-align:justify">
                   <div class="p-1">
                   <span class="label">3</span>
                   &nbsp;&nbsp;En virtud de la conformidad con las condiciones del PREVIT así como las antes señaladas, firmo de manera electrónica el presente documento, de igual manera asumo el compromiso de dar el seguimiento correspondiente durante el tiempo de ejecución del proyecto descrito en el presente formato.
                   </div>
                </div>
                <br>
                @if(session('cer')=="" || session('key')=="" || session('password')=="")


                <div class="alert alert-custom alert-light-warning fade show mb-5" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">No cuenta con registro de Firma electrónica! Por favor ingresar FIEL</div>
                </div>

                <form method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 col-sm-12" style="display: none;" id="msjcer">
                            <p class="bg-danger text-white py-2 px-4">Por favor seleccione el archivo correcto</p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="display: none;" id="msjerror"></div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="dropzone dropzone-default dropzone-success dz-clickable" id="cer">
                                <div class="dropzone-msg dz-message needsclick">
                                    <label class="font-size-h6 font-weight-bolder text-dark">Archivos .cer y .key</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
				                  <div class="col-lg-3 col-md-9 col-sm-12">

                            <div class="form-group fv-plugins-icon-container">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                </div>
                                <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" id="password" autocomplete="off" />
                                <div class="fv-plugins-message-container"></div>
                            </div>

			                    </div>
                          <div class="col-lg-3 col-md-9 col-sm-12"><br><br>
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                                <button type="button" id="buttonEntrar" class="btn btn-primary">
                                  FIRMAR
                                </button>
                            </div>
                          </div>
			              </div>

                </form>

                @endif

                @if(session('cer')!="" || session('key')!="" || session('password')!="")
                <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                  <div class="my-3 mr-2"></div>
                  <button type="button" id="buttonFirmar" class="btn btn-primary" onclick="firmar({{ $id_proyecto }});">
                    FIRMAR
                  </button>
                </div>

                @endif

              </div>

           <!--end::Firma electrónica-->

         </div>
      </div>
      <!--end::Card-->
   </div>
</div>
@endsection
{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/dropzone.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>
<script>

      var psd ="";
      var result ="";
       Dropzone.options.cer = {
           url: "{{ url('firmar')}}",
           method: "POST",
           sending: function (file, xhr, formData) {
               formData.append("_token", "{{ csrf_token() }}");
               formData.append("password", result);
               formData.append("id_proyecto", "{{ $id_proyecto }}");
           },
           success: function (file, response) {
               if (response["success"] == false) {
                   //desbloquea boton
                   $('#buttonEntrar').attr("disabled", false);
                   $("#buttonEntrar").removeClass("spinner spinner-white spinner-right");
                   $("#msjerror").html('<p class="bg-danger text-white py-2 px-4">' + response["error"] + "</p>");
                   $("#msjerror").show();
               } else {
                   $("#msjerror").hide();
                   //desbloquea boton
                   $('#buttonEntrar').attr("disabled", false);
                   $("#buttonEntrar").removeClass("spinner spinner-white spinner-right");
                   swal.fire({
                       title: "Tu proyecto ya se encuentra firmado!!",
                       icon: "success",
                       confirmButtonText: "Terminar!"
                   }).then(function(result) {
                       if (result.value==true || result.value==undefined){
                         window.location.href = url + "pages/seguimiento";
                       }
                   });
               }
           },
           autoProcessQueue: false,
           maxFiles: 2,
           parallelUploads: 2,
           uploadMultiple: true,
           acceptedFiles: "application/pkix-cert,application/x-iwork-keynote-sffkey,.key,.cer",
           dictInvalidFileType: "Por favor seleccione el archivo correcto",
           init: function () {
               $("#msjcer").hide();
               this.on("addedfile", function (file) {
                   if (this.files.length > 2) {
                       this.removeFile(this.files[1]);
                   }

                   if (this.files.length == 2) {

                       if (

                           ((this.files[0].type == "application/x-iwork-keynote-sffkey" || get_extension(this.files[0].name)=="key" ) && (this.files[1].type == "application/pkix-cert" || get_extension(this.files[1].name)=="cer")) ||
                           ((this.files[0].type == "application/pkix-cert" || get_extension(this.files[0].name)=="cer") && (this.files[1].type == "application/x-iwork-keynote-sffkey") || get_extension(this.files[1].name)=="key")
                       ) {
                           $("#msjerror").hide();
                       } else {
                           $("#msjerror").html('<p class="bg-danger text-white py-2 px-4">Por favor seleccione Archivo .cer y .key</p>');
                           $("#msjerror").show();
                       }
                   }
               });
               this.on("error", function (file) {
                   $("#msjcer").show();
                  $("#password").val("");
               });

               var submitButton = document.querySelector("#buttonEntrar");
               myDropzone = this;
               submitButton.addEventListener("click", function () {
                   if (myDropzone.files.length != 2) {
                       $("#msjerror").html('<p class="bg-danger text-white py-2 px-4">Por favor ingrese .cer y .key</p>');
                       $("#msjerror").show();
                   } else if ($("#password").val() == "") {
                       $("#msjerror").html('<p class="bg-danger text-white py-2 px-4">Por favor ingrese su password</p>');
                       $("#msjerror").show();
                   } else {
                      psd = $("#password").val();
                      //bloquea boton
                      $('#buttonEntrar').attr("disabled", true);
                      $("#buttonEntrar").addClass("spinner spinner-white spinner-right");
                      result = $.base64.encode(psd);
                      myDropzone.processQueue();
                   }
               });

               this.on("complete", function () {
                   $("#msjcer").hide();

                   if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                       var _this = this;
                       this.removeAllFiles();
                   }

                  $("#password").val("");
               });
           },
       };

       function fiel(){
            $("#contFiel").show();
            $("#contAutografa").hide();
       }

       function autografa(){
            $("#contAutografa").show();
            $("#contFiel").hide();
       }


       function firmar(id_proyecto){

       $.ajax({
             url: "{{ url('firmar_con_registro')}}",
             type: 'POST',
             data: 'id_proyecto='+id_proyecto+'&_token='+"{{ csrf_token() }}",
             dataType: "json",
             beforeSend: function() {
                //bloquea boton
                $('#buttonFirmar').attr("disabled", true);
                $("#buttonFirmar").addClass("spinner spinner-white spinner-right");
             },
             success: function(respuesta){
               //desbloquea boton
               $('#buttonFirmar').attr("disabled", false);
               $("#buttonFirmar").removeClass("spinner spinner-white spinner-right");
               if (respuesta["success"] == false){
                   swal.fire("Mensaje!", ""+respuesta["error"]+"", "error");
               } else {
                   swal.fire({
                       title: "Tu proyecto ya se encuentra firmado!!",
                       icon: "success",
                       confirmButtonText: "Terminar!"
                   }).then(function(result) {
                       if (result.value==true || result.value==undefined){
                         window.location.href = url + "pages/seguimiento";
                       }
                   });
               }
             },
             error: function(){
                //desbloquea boton
                $('#buttonFirmar').attr("disabled", false);
                $("#buttonFirmar").removeClass("spinner spinner-white spinner-right");
                swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                return false;

              }
           });

       }
       //window.onload = finalizada;
function descargar(url) {
document.location.href = url;
setTimeout(finalizada , 4000);
}
function finalizada() {
swal.fire({
          title: 'Documento Descargado',
          text: "Se concluyó la descarga del formato",
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ok'}).then((result) => {
            if (result.value) {
              window.location.href = "{{ url('pages/seguimiento') }}";
            }
          });
}
function get_extension(filename) {
    return filename.slice((filename.lastIndexOf('.') - 1 >>> 0) + 2);
}
</script>
@endsection
