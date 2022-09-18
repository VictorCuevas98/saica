@extends('layout.default')

@section('content')

    <input type="hidden" name="actaId" value="{{$acta->id}}" id="actaId"/>
    <input type="hidden" name="seccionId" value="{{$seccion->id}}" id="seccionId"/>

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center flex-wrap mr-1">
                                <!--begin::Mobile Toggle-->
                                <button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
                                    <span></span>
                                </button>
                                <!--end::Mobile Toggle-->
                                <!--begin::Page Heading-->
                                <div class="d-flex align-items-baseline mr-5">
                                    <!--begin::Page Title-->
                                    <h5 class="text-dark font-weight-bold my-2 mr-5">Solicitud de Entrega</h5>
                                    <!--end::Page Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                                        <li class="breadcrumb-item">
                                            <a href="" class="text-muted">Entregar</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="" class="text-muted">solicitud</a>
                                        </li>

                                        <li class="breadcrumb-item">
                                            <a href="" class="text-muted">{{$seccion->seccion_template->titulo}}</a>
                                        </li>
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page Heading-->
                            </div>
                            <!--end::Info-->
                            <!--begin::Toolbar-->
                            <div class="d-flex align-items-center">
                                <!--begin::Actions-->



                                <div class="dropdown">
                                    <button class="btn btn-light-primary font-weight-bold btn-sm mr-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Quién recibe
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <button type="button" id="btn_quien_recibe_ver" class="dropdown-item" >Ver</button>
                                        <button type="button" id="btn_quien_recibe_cambiar" class="dropdown-item " >Cambiar</button>

                                    </div>
                                </div>
                                <a href="#" class="btn btn-light-primary font-weight-bold btn-sm mr-2 " id="testios_btn">Testigos</a>

                                <a href="#" class="btn btn-light font-weight-bold btn-sm">Acciones</a>
                                <!--end::Actions-->
                                <!--begin::Dropdown-->
                                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left">
                                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="svg-icon svg-icon-success svg-icon-2x">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover">
                                            <li class="navi-header font-weight-bold py-4">
                                                <span class="font-size-lg">selecciona una acción:</span>
                                                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="ayuda..."></i>
                                            </li>
                                            <li class="navi-separator mb-3 opacity-70"></li>
                                            <li class="navi-item">
                                                <a href="javascript:enviar_acta({{$acta->id}})" class="navi-link">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-success">Enviar Solicitud</span>
                                                        </span>
                                                </a>
                                            </li>

                                            <li class="navi-item">
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#modal_visualizar_acta" class="navi-link" onclick="visualizar_acta({{$acta->id}})">
                                                        <span class="navi-text">
                                                            <span class="label label-xl label-inline label-light-primary">Visualizar acta</span>
                                                        </span>
                                                </a>
                                            </li>
                                            <!--
                                            <li class="navi-separator mt-3 opacity-70"></li>
                                            <li class="navi-footer py-4">
                                                <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                                <i class="ki ki-plus icon-sm"></i>Add new</a>
                                            </li>
                                            -->
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                    </div>
                    <!--end::Subheader-->



                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container">
                            <!--begin::Profile Account Information-->
                            <div class="d-flex flex-row">
                                <!--begin::Aside-->
                                <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                                    <!--begin::Profile Card-->
                                    <div class="card card-custom card-stretch">
                                        <!--begin::Body-->
                                        <div class="card-body pt-4 px-0 ">
                                        
                                        <!--begin::Nav-->
                                            <div class="navi navi-bold navi-hover navi-active navi-link-rounded pt-0 mr-0 ml-0 ">
                                                <link href="{{asset('css/themes/layout/aside/light.css')}}" rel="stylesheet" type="text/css" />
                                                @include("secciones._menu_secciones")
                                                
                                            </div>
                                            <!--end::Nav-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Profile Card-->
                                </div>
                                <!--end::Aside-->



                                <!--begin::Content-->
                                <div class="flex-row-fluid ml-lg-8">
                                    <!--begin::Card-->
                                    <div class="card card-custom mb-6">
                                        
                                        <!--begin::Header-->
                                        <div class="card-header py-3">
                                            <div class="card-title align-items-start flex-column">
                                                <h3 class="card-label font-weight-bolder text-dark">{{$seccion->seccion_template->titulo}}</h3>
                                                <span class="text-muted font-weight-bold font-size-sm mt-1">
                                                    
                                                </span>
                                            </div>
                                            <div class="card-toolbar ">
                                                <a href="#" class="btn btn-light-primary font-weight-bold  mr-0 " id="kt_demo_panel_toggle" data-toggle="tooltip" title="Numerales de esta sección" data-placement="bottom" style="display: @if($seccion->no_aplica) none @else  @endif ">Numerales</a>

            
                                                @if($seccion->seccion_template->no_aplica || $seccion->seccion_template->omitir)
                                                <form name="aplica_form" class="aplica_form" id="" method="POST" action="{{route('seccion.aplica',[$seccion->id])}}" seccion="{{$seccion->id}}">
                                                @csrf   
                                                <span class="switch switch-lg switch-icon switch-outline  switch-success ml-2" data-toggle="tooltip" title="¿La sección me aplica?">
                                                    <label>
                                                        @if($seccion->no_aplica)
                                                            <input type="checkbox" name="aplica_check" class="aplica_check" id="aplica_check_{{$seccion->id}}" />
                                                        @else
                                                            <input type="checkbox" name="aplica_check" checked class="aplica_check" id="aplica_check_{{$seccion->id}}"/>
                                                        @endif
                                                        <span></span>
                                                    </label>
                                                </span>
                                                </form>
                                                @endif
            


                                            </div>
                                        </div>
                                        <!--end::Header-->
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin::Form-->
                                            <form name="seccion_texto_adicional_form" id="seccion_texto_adicional_form" action="{{route('seccion.update',$seccion->id)}}" method="post">
                                                @csrf
                                                <p id="contenido_content">{{$seccion->contenidoReemplazadoNumerales()}}</p>
                                                <div class="separator separator-dashed my-5"></div>
                                                <!--begin::Form Group-->
                                                <div class="form-group row" id="seccion_texto_adicional_container" style="display: @if($seccion->no_aplica) none @else  @endif ">
                                                    <label class="col-xl-2 col-lg-2 col-form-label">Texto adicional:</label>
                                                    <div class="col-lg-10 col-xl-10">
                                                        <div class="form-group">
                                                            <textarea class="form-control form-control-lg form-control-solid" id="exampleTextarea" rows="5" placeholder="" name="texto_adicional">{{$seccion->texto_adicional}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--begin::Form Group-->
                                                <button type="submit" id="btn_texto_adicional_guardar" class="btn btn-success mr-2" style="display: @if($seccion->no_aplica) none @else  @endif ">Guardar</button>
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Card-->

                                    <div class="row" id="seccion_document_container">
                                        @if($seccion->attachment)
                                        <!--begin::Col-->
                                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                            <!--begin::Card-->
                                            <div class="card card-custom gutter-b card-stretch">

                                                <div class="card-body" id="dropzone_container" style="display: @if($seccion->no_aplica) none @else  @endif ">
                                                    <div class="d-flex flex-column align-items-center" >


                                                        <div class="form-group row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12" style="display: none;" id="msjcer">
                                                                <p class="bg-danger text-white py-2 px-4">Por favor seleccione el archivo correcto</p>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12" style="display: none;" id="msjerror"></div>
                                                            <div class="">
                                                                <div class="dropzone dropzone-default dropzone-success" id="archivos" >
                                                                    <div class="dropzone-msg dz-message needsclick">
                                                                        <h3 class="dropzone-msg-title">Arrastra los archivos, o da clic para seleccionarlos.</h3>
                                                                        <span class="dropzone-msg-desc">Solo archivos de tipo pdf y Excel</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--begin: Tite-->
                                                        <a  class="text-dark-75 font-weight-bold mt-15 font-size-lg btn btn-primary" id="bnt_enviar_archivo" >Cargar Archivo</a>
                                                        <!--end: Tite-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end:: Card-->
                                        </div>
                                        <!--end::Col-->
                                        @endif
                                        @foreach($seccion->documentos()->noBorrados()->get() as $documento)

                                            @include("seccionesDocumentos._single_file",['documento'=>$documento,'extencion'=>strtoupper(substr($documento->filename, -3))])

                                        @endforeach


                                    </div>
                                </div>
                                <!--end::Content-->



                            </div>
                            <!--end::Profile Account Information-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->

   
   

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
    <!--end::Scrolltop-->



    <!--begin::Demo Panel-->
    <div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
            <h4 class="font-weight-bold m-0">Numerales de Acta entrega</h4>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content">
            <form name="dynamicData_form" id="dynamicData_form">
                @csrf
                <input type="hidden" name="seccion" value="{{$seccion->id}}">
                <!--begin::Wrapper-->
                <div class="offcanvas-wrapper mb-5 scroll-pull">
                    @foreach($seccion->seccion_dynamicdata as $sec_dyn_data)
                        @if($sec_dyn_data->dynamicdata->dynamicdata_template->id_fuente_info=='D')

                            <div class="form-group">

                                <label>{{$sec_dyn_data->dynamicdata->dynamicdata_template->clave_dynamicdata}} {{$sec_dyn_data->dynamicdata->dynamicdata_template->dynamicdata}}</label>
                                <input type="hidden" name="dynamicdata[]" value="{{$sec_dyn_data->dynamicdata->id}}">
                                <input type="text" class="form-control" placeholder="" name="valor[]" value="{{$sec_dyn_data->dynamicdata->valor}}">
                                <span class="form-text text-muted" style="display: none">mensaje de error o informacion</span>
                            </div>
                        @endif

                    @endforeach
                </div>
                <!--end::Wrapper-->
                <!--begin::Purchase-->
                <div class="offcanvas-footer">
                    <button class="btn btn-block btn-primary btn-shadow font-weight-bolder text-uppercase">Guardar</button>
                </div>
                <!--end::Purchase-->
            </form>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Demo Panel-->

    @include('actas.modal_visualizar')
@endsection


@section('scripts')
    <script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>

    @if (session('message'))
        <script>
            setTimeout(function() {
                swal.fire('¡Aviso!', "{{session('message')}}", 'success');
            }, 500);
        </script>
    @endif

    <script type="text/javascript">
        "use strict";


        // Class definition
        var KTProfile = function () {
            // Elements
            var avatar;
            var offcanvas;

            // Private functions
            var _initAside = function () {
                // Mobile offcanvas for mobile mode
                offcanvas = new KTOffcanvas('kt_profile_aside', {
                    overlay: true,
                    baseClass: 'offcanvas-mobile',
                    //closeBy: 'kt_user_profile_aside_close',
                    toggleBy: 'kt_subheader_mobile_toggle'
                });
            }

            return {
                // public functions
                init: function() {
                    _initAside();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTProfile.init();
        });

    </script>
    <script src="{{ asset('js/entregas/quienrecibe.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/entregas/testigos.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/entregas/enviar.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/entregas/visualizar_acta.js') }}" type="text/javascript"></script>




    <script type="text/javascript">

        


        Dropzone.autoDiscover = false;
        var seccionId  = $("#seccionId").val();
        var maxFiles = 1; //solo se pueden subir de dos en dos
        var maxFilesize = 10 ;//MB
        Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancelar carga";
        Dropzone.prototype.defaultOptions.dictRemoveFile = "Eliminar archivo";
        Dropzone.prototype.defaultOptions.dictFileTooBig = "El archivo es demasiado grande. El Tamaño máximo de archivo es de:"+maxFilesize+" MB.";
        Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "Has revasado el límite de archivos permitidos.";
        Dropzone.prototype.defaultOptions.dictInvalidFileType = "No se permite este tipo de archivo.";



        var myDropzone = new Dropzone("#archivos", {
            url: url+'seccion/'+seccionId+'/documentos',
            method: "POST",
            paramName: "file", // The name that will be used to transfer the file
            acceptedFiles: "application/pdf,.xls,.xlsx ",
            autoProcessQueue: false,
            uploadMultiple: true,
            addRemoveLinks: true,
            maxFiles: maxFiles,
            maxFilesize: maxFilesize, // MB
            dictInvalidFileType: "Por favor seleccione el archivo correcto",
            sending: function (file, xhr, formData) {
                //formData.append("_token", $('#_token').val());
                formData.append("_token", "{{ csrf_token() }}");
                //$('#buttonEntrar').attr("disabled", true);
                //$("#buttonEntrar").addClass("spinner spinner-white spinner-right");
            },
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });

        myDropzone.on("addedfile", function(file, data) {
            /* Maybe display some more file information on your page */
            //$('#buttonEntrar').show();
            if (this.files.length > maxFiles) {
                this.removeFile(this.files[0]);
            }
        });

        myDropzone.on("maxfilesexceeded", function(file, data) {
            alert("No more files please!");
            this.removeFile(file);
        });

        myDropzone.on("error", function(file, message) {
            swal.fire('Ups!', message, 'error');
            this.removeFile(file);
        });

        myDropzone.on("success", function(archivo, response){
            if(response.success){
                //$('#buttonEntrar').attr("disabled", false);
                //$("#buttonEntrar").removeClass("spinner spinner-white spinner-right");

                this.removeFile(this.files[0]);
                $.each(response.data, function (ind, elem) {
                    $("#seccion_document_container").append(elem);
                });

                swal.fire({
                    title: 'Exito',
                    text: "Se cargaron los documetos exitosamente",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        //window.location.href = "{{ url('entidad') }}";
                    }
                });
            } else {
                //$('#buttonEntrar').attr("disabled", false);
                //$("#buttonEntrar").removeClass("spinner spinner-white spinner-right");
                swal.fire('Error', response.mensaje, 'error');
                $('#password').val('');
                //this.removeAllFiles();
                this.removeFile(this.files[0]);
            }
        });

        $("#bnt_enviar_archivo").click(function(e){
            myDropzone.processQueue();
        });

    </script>
    <script type="text/javascript">

        $("#dynamicData_form").submit(function(e){
            e.preventDefault();
            e.stopPropagation();
            var formulario = $(this);
            $.ajax({
                url: url+ 'dynamicdata',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                data: formulario.serialize(),
            }).done(function (response) {

                if(response.success)
                {
                    //TODO::TENEMOS QUE REEMPLZAR EL CONTENIDO PARA REFRESCXARLO
                    $("#contenido_content").html(response.data.contenido);
                    swal.fire('Exito', 'se guardaron los datos correctamente', 'success');
                } else {
                    swal.fire('Algo ocurrio al guardar', response.mensaje, 'error');
                }
            }).fail(function (response_error) {
                console.log("error");
                console.log(response_error);

            });
        });


        $('.seccion').click(function(e){
            e.preventDefault();
            //preloaderShow("Cargando Sección ...");
            pageloader_in('fast','Cargando seccion');
            window.location.href = $(this).attr('href');
        });


    </script>

    <script type="text/javascript">
        $( "input.aplica_check[type=checkbox]" ).on( "click",function(){
            var form = $(this).parents(".aplica_form");
            form.submit();
            var elementosHijos = $( "[seccion_primaria='"+form.attr("seccion")+"']" );
            console.log(elementosHijos);
            if($(this).is(':checked')) {
                //estaactivdado
                elementosHijos.show();
                $("#seccion_texto_adicional_container").fadeIn( "slow" );
                $("#btn_texto_adicional_guardar").fadeIn( "slow" );
                $("#dropzone_container").fadeIn( "slow" );
                $("#kt_demo_panel_toggle").fadeIn( "slow" );

            }else{
                elementosHijos.hide();
                $("#seccion_texto_adicional_container").fadeOut( "slow");
                $("#btn_texto_adicional_guardar").fadeOut( "slow");
                $("#dropzone_container").fadeOut( "slow");
                $("#kt_demo_panel_toggle").fadeOut( "slow" );
            }

        } );

        $("form.aplica_form").submit(function(e){
            e.preventDefault();
            e.stopPropagation()
            var form_aplica = $(this);
            $.ajax({
                url: form_aplica.attr("action"),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: form_aplica.attr("method"),
                dataType: 'JSON',
                data: form_aplica.serialize(),
            }).done(function (response) {
                if(response.success)
                {   
                    //swal.fire('Exito', 'se guardaron los datos correctamente', 'success');
                } else {
                    swal.fire('Algo ocurrio', response.mensaje, 'error');
                }
            }).fail(function (response_error) {
                console.log("error");
                console.log(response_error);
            });
        });

    </script>

    <script type="text/javascript">
        //DOCUMENTOS
        function documentDeleteConfirmation(seccion, documento){


            swal.fire({
                title: "¿Seguro que Deseas eliminar el documento?",
                text: "Una vez que se elimine no se podra revertir.",
                icon: "warning",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Si',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.value) {
                    documentDelete(seccion,documento,function(response_delete){
                        //TODO::eliminar el id del elemento
                        $("#document_container_"+documento).hide();

                    })
                }
            });

        }
        function documentDelete(seccion,document,callback){

            $.ajax({
                url: url+ 'seccion/'+seccion+'/documentos/'+document,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                dataType: 'JSON',
                data: {
                    'documento':document,
                    '_token': '{{ csrf_token() }}',
                },
            }).done(function (response) {

                if(response.success)
                {
                    swal.fire('Exito', response.mensaje, 'success');
                    callback();
                } else {
                    swal.fire('Algo ocurrio al guardar', response.mensaje, 'error');
                }
            }).fail(function (response_error) {
                console.log("error");
                console.log(response_error);

            });

        }
    </script>
@endsection