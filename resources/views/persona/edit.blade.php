@extends('layout.default')
@section('content')


<div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label font-weight-bolder text-dark">Mis Datos Fiscales</span>

        </h3>
        <div class="card-toolbar">

        </div>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-8">
        <form class="form needs-validation" id="editDatosFis" action="{{url('editarDatFis')}}" method="post" novalidate>
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <h3 class="mb-10 font-weight-bold text-dark">Domicilio Fiscal</h3>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Código postal</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" maxlength="6" value="{{$datosColonia[0]->cp}}" required name="cpostal_fiscal" id="cpostal_fiscal" onchange="buscar_cp();">
                            <span class="form-text text-muted">Este campo es obligatorio.</span>
                        </div>
                        <!--end::Input-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Entidad Federativa</label>
                            <select name="id_entidad_fiscal" id="id_entidad_fiscal" required class="form-control form-control-solid form-control-lg">
                                <option value="">Selecciona</option>
                                @foreach($datosColonia as $dc)
                                <option value="{{$dc->id_entidad}}" selected>{{$dc->entidad}}</option>
                                @endforeach
                            </select>
                            <span class="form-text text-muted">Este campo es obligatorio.</span>
                        </div>
                        <!--end::Input-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Alcaldía o Municipio</label>
                            <select name="id_alcaldia_fiscal" id="id_alcaldia_fiscal" required class="form-control form-control-solid form-control-lg">
                                <option value="">Selecciona</option>
                                @foreach($datosColonia as $da)
                                <option value="{{$da->id_alcaldia}}" selected>{{$da->alcaldia}}</option>
                                @endforeach
                            </select>
                            <span class="form-text text-muted">Este campo es obligatorio.</span>
                        </div>
                        <!--end::Input-->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Colonia</label>
                            <select name="id_colonia_fiscal" id="id_colonia_fiscal" required class="form-control form-control-solid form-control-lg">
                                <option value="">Selecciona</option>
                                @foreach($datosColonia as $dic)
                                    @if($dic->id==$infoFiscal[0]->idcoloniaf)
                                        <option value="{{$dic->id}}" selected>{{$dic->colonia}}</option>
                                    @else 
                                        <option value="{{$dic->id}}">{{$dic->colonia}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="form-text text-muted">Este campo es obligatorio.</span>
                        </div>
                        <!--end::Input-->
                    </div>
                    <div class="col-xl-8">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Calle</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" required maxlength="400" value="{{$infoFiscal[0]->callef}}" name="calle_fiscal" id="calle_fiscal">
                            <span class="form-text text-muted">Este campo es obligatorio.</span>
                        </div>
                        <!--end::Input-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>N. Exterior</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" required maxlength="100" value="{{$infoFiscal[0]->num_ext}}" name="nexterior_fiscal" id="nexterior_fiscal">
                            <span class="form-text text-muted">Este campo es obligatorio.</span>
                        </div>
                        <!--end::Input-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>N. Interior</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" value="{{$infoFiscal[0]->num_int}}" maxlength="100" name="ninterior_fiscal">
                        </div>
                        <!--end::Input-->
                    </div>
                </div>
                <div class="form-group">
                    <h3 class="mb-10 font-weight-bold text-dark">Representante Legal</h3>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label>Nombre(s)</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" value="{{$infoFiscal[0]->repleg_nombre}}" maxlength="200" name="nombre_representante_legal" id="nombre_representante_legal">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label>Apellido Paterno</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" value="{{$infoFiscal[0]->repleg_primerap}}" maxlength="200" name="paterno_representante_legal" id="paterno_representante_legal">
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="form-group">
                            <label>Apellido Materno</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" value="{{$infoFiscal[0]->repleg_segundoap}}" maxlength="200" name="materno_representante_legal" id="materno_representante_legal">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3 class="mb-10 font-weight-bold text-dark">Domicilio para recibir notificaciones</h3>
                </div>

                <!--<div class="form-group">
                            <label class="checkbox checkbox-success">
                                <input type="checkbox" id="check_domicilio_notificaciones" name="check_domicilio_notificaciones" onclick="valida_dnotificaciones();">
                                <div style="text-align:justify">
                                    Mi domicilio para recibir notificaciones es el mismo que el domicilio Fiscal.
                                </div>
                                <span></span>
                            </label>
                        </div>-->
                <div id="cont_domicilio_notificacion">
                    <div class="row">
                        <div class="col-xl-4">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Código postal</label>
                                <input type="text" class="form-control form-control-solid form-control-lg" required value="{{$datosColoniaCont[0]->cp}}" maxlength="6" name="cpostal_notificaciones" id="cpostal_notificaciones" onchange="buscar_cp_notificaciones();">
                                <span class="form-text text-muted">Este campo es obligatorio.</span>
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-4">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Entidad Federativa</label>
                                <select name="id_entidad_notificaciones" id="id_entidad_notificaciones" required class="form-control form-control-solid form-control-lg">
                                    <option value="">Selecciona</option>
                                    @foreach($datosColoniaCont as $dcc)
                                    <option value="{{$dcc->id_entidad}}" selected>{{$dcc->entidad}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text text-muted">Este campo es obligatorio.</span>
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-4">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Alcaldía o Municipio</label>
                                <select name="id_alcaldia_notificaciones" id="id_alcaldia_notificaciones" required class="form-control form-control-solid form-control-lg">
                                    <option value="">Selecciona</option>
                                    @foreach($datosColoniaCont as $dca)
                                    <option value="{{$dca->id_alcaldia}}" selected>{{$dca->alcaldia}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text text-muted">Este campo es obligatorio.</span>
                            </div>
                            <!--end::Input-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-4">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Colonia</label>
                                <select name="id_colonia_notificaciones" id="id_colonia_notificaciones" required class="form-control form-control-solid form-control-lg">
                                    <option value="">Selecciona</option>
                                    @foreach($datosColoniaCont as $dco)
                                        @if($dco->id==$infoFiscal[0]->idcoloniac)
                                            <option value="{{$dco->id}}" selected>{{$dco->colonia}}</option>
                                        @else 
                                            <option value="{{$dco->id}}">{{$dco->colonia}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="form-text text-muted">Este campo es obligatorio.</span>
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-8">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>Calle</label>
                                <input type="text" class="form-control form-control-solid form-control-lg" required value="{{$infoFiscal[0]->callec}}" maxlength="400" name="calle_notificaciones" id="calle_notificaciones">
                                <span class="form-text text-muted">Este campo es obligatorio.</span>
                            </div>
                            <!--end::Input-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>N. Exterior</label>
                                <input type="text" class="form-control form-control-solid form-control-lg" required value="{{$infoFiscal[0]->numext}}" maxlength="100" name="nexterior_notificaciones" id="nexterior_notificaciones">
                                <span class="form-text text-muted">Este campo es obligatorio.</span>
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="col-xl-4">
                            <!--begin::Input-->
                            <div class="form-group">
                                <label>N. Interior</label>
                                <input type="text" class="form-control form-control-solid form-control-lg" value="{{$infoFiscal[0]->numint}}" maxlength="100" name="ninterior_notificaciones">
                            </div>
                            <!--end::Input-->
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h3 class="mb-10 font-weight-bold text-dark">Datos de Contacto</h3>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Teléfonos</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" required value="{{$telefono}}" maxlength="11" name="ntelefono1" id="ntelefono1">
                            <span class="form-text text-muted">Este campo es obligatorio.</span>
                        </div>
                        <!--end::Input-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="text" class="form-control form-control-solid form-control-lg" value="{{$email}}" maxlength="100" name="email" id="email">
                        </div>
                        <!--end::Input-->
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-9"></div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">EDITAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <!--end::Body-->
</div>
@endsection
@section('scripts')
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
        swal.fire('¡Alerta!', "{{session('error')}}", 'warning');
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