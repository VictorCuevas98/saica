{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')
    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b card-stretch">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">Proceso de firmado</h3>
                    </div>
                    <div class="card-toolbar">
                        <div class="example-tools justify-content-center">
                            <a href="{{ url('/firmante') }}" class="btn btn-light btn-text-success btn-hover-text-success font-weight-bold mr-2">Regresar</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="alert alert-custom alert-light-dark fade show mb-5" role="alert">
                        <div class="alert-icon">
                            <i class="flaticon-warning"></i>
                        </div>
                        <div class="alert-text" style="text-align:justify">
                            Para EL FIRMADO Y ENVÍO de su registro, debe contar con su e.firma, la cual se tramita previamente ante el Servicio de Administración Tributaria (SAT).
                        </div>
                    </div>
                    <br>
                    <!--Firma electrónica-->

                    <div id="contFiel">
                        <div class="form-group">
                            <div class="alert alert-success" role="alert">DECLARACIONES</div>
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


                            <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
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
                                    <div class="col-lg-3 col-md-9 col-sm-12"><br>
                                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                                            <button type="button" id="buttonEntrar" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Firmar</button>
                                        </div>
                                    </div>
                                </div>

                            </form>

                        @endif

                        @if(session('cer')!="" || session('key')!="" || session('password')!="")
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                                <div class="my-3 mr-2"></div>
                                <button type="button" id="buttonFirmar" class="btn btn-primary font-weight-bold px-9 py-4 my-3" onclick="firmar({{ $id_proyecto }});">Firmar</button>
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
                            window.location.href = url + "firmante";
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
                                window.location.href = url + "firmante";
                            }
                        });
                    }
                },
                error: function(){
                    //desbloquea boton
                    $('#buttonEntrar').attr("disabled", false);
                    $("#buttonEntrar").removeClass("spinner spinner-white spinner-right");
                    swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                    return false;

                }
            });

        }


    </script>
@endsection
