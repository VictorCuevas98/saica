@extends('layout.default')
@section('content')

<!-- Nuevo Diseño-->
<div class="card card-custom">
    <div class="card-body p-0">
        <!--begin: Wizard-->
        <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="first" data-wizard-clickable="false">
            <!--begin: Wizard Nav-->
            <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                <!--begin::Wizard Step 1 Nav-->
                <div class="wizard-steps">
                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Map\Marker1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                                </svg><!--end::Svg Icon-->
                            </span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title">Domicilio Fiscal</h3>
                                <div class="wizard-desc">Ingrese su domicilio fiscal</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 1 Nav-->
                    <!--begin::Wizard Step 2 Nav-->
                    <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                        <div class="wizard-wrapper">
                            <div class="wizard-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Selected-file.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                                </svg><!--end::Svg Icon-->
                            </span>
                            </div>
                            <div class="wizard-label">
                                <h3 class="wizard-title">Documentos</h3>
                                <div class="wizard-desc">Ingrese sus documentos</div>
                            </div>
                        </div>
                    </div>
                    <!--end::Wizard Step 2 Nav-->
                </div>
            </div>
            <!--end: Wizard Nav-->
            <!--begin: Wizard Body-->
            <div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
                <!--begin: Wizard Form-->
                <div class="row">
                    <div class="offset-xxl-2 col-xxl-8">
                        <form class="form fv-plugins-bootstrap fv-plugins-framework" action="{{url('guardaDatFis')}}" method="post" id="kt_form" enctype="multipart/form-data">
                        @csrf
                            <!--begin: Wizard Step 1-->
                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                @include('persona/domicilio_fiscal')
                            </div>
                            <!--end: Wizard Step 1-->
                            <!--begin: Wizard Step 2-->
                            <div class="pb-5" data-wizard-type="step-content">
                            @if($role->name=='REPRESENTANTE' && $tipo_persona=='F')
                                @include('persona/documentos_fisica')
                            @else
                                @include('persona/documentos_moral')
                            @endif
                            </div>
                            <!--end: Wizard Step 2-->
                            <!--begin: Wizard Actions-->
                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                <div class="mr-2">
                                    <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Anterior</button>
                                </div>
                                <div>
                                    <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" id="guardaP" name="guardaP" data-wizard-type="action-submit" type="submit">Guardar</button>
                                    <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Siguiente</button>
                                </div>
                            </div>
                            <!--end: Wizard Actions-->
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </form>
                    </div>
                    <!--end: Wizard-->
                </div>
            </div>
            <!--end: Wizard Body-->
        </div>
        <!--end: Wizard-->
    </div>
</div>
@endsection
@section('scripts')
<link href="{{ asset('css/pages/wizard/wizard-2.css')}}" rel="stylesheet" type="text/css">
<script src="{{ asset('js/persona/persona.js') }}" type="text/javascript"></script>
@if (session('message'))
<script>
    setTimeout(function() {
        //swal.fire('¡Aviso!', 'Se guardo correctamente!', 'success');

        swal.fire({
            title: "Se guardo correctamente!",
            icon: "success",
            confirmButtonText: "Terminar!"
        }).then(function(result) {
            if (result.value == true || result.value == undefined) {
                window.location.href = url + "home";
            }
        });

    }, 1000);
</script>
@endif
@if (session('error'))
<script>
    setTimeout(function() {
        swal.fire('¡Alerta!', 'No se pudo guardar la información!', 'error');
    }, 1000);
</script>
@endif
<script>
    (function() {

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    $('input[name=check_domicilio_notificaciones]').change(function() {
        if ($('input[name=check_domicilio_notificaciones]').is(':checked')) {
            $('#cpostal_notificaciones').val("000000");
            $('#id_entidad_notificaciones').append("<option value='1' selected>lleno</option>");
            $('#id_alcaldia_notificaciones').append("<option value='1' selected>lleno</option>");
            $('#id_colonia_notificaciones').append("<option value='1' selected>lleno</option>");
            $('#calle_notificaciones').val("calle");
            $('#nexterior_notificaciones').val("numext");
            $("#cont_domicilio_notificacion").hide();
        } else {
            $('#cpostal_notificaciones').val("");
            $('#id_entidad_notificaciones').html('<option value="">Selecciona</option>');
            $('#id_alcaldia_notificaciones').html('<option value="">Selecciona</option>');
            $('#id_colonia_notificaciones').html('<option value="">Selecciona</option>');
            $('#calle_notificaciones').val("");
            $('#nexterior_notificaciones').val("");
            $("#cont_domicilio_notificacion").show();
        }
    });

    function buscar_cp() {
        if ($('#cpostal_fiscal').val() == "") {
            // limpiar combos
            $('#id_entidad_fiscal').html('<option value="">Selecciona</option>');
            $('#id_alcaldia_fiscal').html('<option value="">Selecciona</option>');
            $('#id_colonia_fiscal').html('<option value="">Selecciona</option>');
        } else {
            // busca cp
            $.ajax({
                url: "{{ url('buscar_cp')}}",
                type: 'POST',
                data: 'cp=' + $('#cpostal_fiscal').val() + '&_token=' + "{{ csrf_token() }}",
                dataType: "json",
                success: function(respuesta) {
                    console.log(respuesta);
                    // limpiar combos
                    $('#id_entidad_fiscal').html('<option value="">Selecciona</option>');
                    $('#id_alcaldia_fiscal').html('<option value="">Selecciona</option>');
                    $('#id_colonia_fiscal').html('<option value="">Selecciona</option>');

                    if (respuesta.length > 0) {
                        //agrega Entidad
                        $('#id_entidad_fiscal').append("<option value='" + respuesta[0].id_entidad + "' selected>" + respuesta[0].entidad + "</option>");
                        $('#id_alcaldia_fiscal').append("<option value='" + respuesta[0].id_alcaldia + "' selected>" + respuesta[0].alcaldia + "</option>");
                        for (var i = 0; i < respuesta.length; i++) {
                            $('#id_colonia_fiscal').append("<option value='" + respuesta[i].id + "'>" + respuesta[i].colonia + "</option>");
                        }
                    }
                },
                error: function() {
                    swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                    return false;
                }
            });
        }
    }

    function buscar_cp_notificaciones() {
        if ($('#cpostal_notificaciones').val() == "") {
            // limpiar combos
            $('#id_entidad_notificaciones').html('<option value="">Selecciona</option>');
            $('#id_alcaldia_notificaciones').html('<option value="">Selecciona</option>');
            $('#id_colonia_notificaciones').html('<option value="">Selecciona</option>');
        } else {
            // busca cp
            $.ajax({
                url: "{{ url('buscar_cp')}}",
                type: 'POST',
                data: 'cp=' + $('#cpostal_notificaciones').val() + '&_token=' + "{{ csrf_token() }}",
                dataType: "json",
                success: function(respuesta) {

                    // limpiar combos
                    $('#id_entidad_notificaciones').html('<option value="">Selecciona</option>');
                    $('#id_alcaldia_notificaciones').html('<option value="">Selecciona</option>');
                    $('#id_colonia_notificaciones').html('<option value="">Selecciona</option>');

                    if (respuesta.length > 0) {
                        //agrega Entidad
                        $('#id_entidad_notificaciones').append("<option value='" + respuesta[0].id_entidad + "' selected>" + respuesta[0].entidad + "</option>");
                        $('#id_alcaldia_notificaciones').append("<option value='" + respuesta[0].id_alcaldia + "' selected>" + respuesta[0].alcaldia + "</option>");
                        for (var i = 0; i < respuesta.length; i++) {
                            $('#id_colonia_notificaciones').append("<option value='" + respuesta[i].id + "'>" + respuesta[i].colonia + "</option>");
                        }
                    }
                },
                error: function() {
                    swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                    return false;
                }
            });
        }
    }
    $("#ntelefono1").inputmask("99-99999999");
</script>
@endsection