@extends('layout.default')
@section('content')

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Control de Usuarios</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Solicitudes de Registro</span>
                </li>
            </ul>
            <!--end::Breadcrumb-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
        <!--end::Details-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="{{url('/admin/usuarios/solicitudes')}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<!-- -->
<div class="row">
    <div class="col-12">
        <div class="card card-custom">
            <div class="card-header" style="">
                <div class="card-title">
                    @php
                    $nombre_completo = $persona->nombre . ' ' . $persona->primer_ap . ' ' . $persona->segundo_ap ;
                    @endphp
                    <h3 class="card-label text-dark">Solicitud de registro de: <b>{{mb_strtoupper($nombre_completo)}}</b>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <div class="btn-group">
                        <button type="submit" id="registrarUsuario" class="btn btn-success btn-sm font-weight-bolder" form="guardaUsuarioEnte" name="aceptar" value="1">
                            <i class="ki ki-check icon-sm"></i>Aceptar</button>
                        <button type="submit" id="registrarUsuario" class="btn btn-danger btn-sm font-weight-bolder" form="guardaUsuarioEnte" name="aceptar" value="0">
                            <i class="ki ki-check icon-sm"></i>Rechazar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-5">

        <div class="card">
            <div class="card-body">
                
                @switch($persona->id_status_persona)
                                @case('A')
                                    <h5>Estado de solicitud: <strong>ACTIVO</strong></h5>
                                @break

                                @case('P')
                                    <h5>Estado de solicitud: <strong>PENDIENTE</strong></h5>
                                @break

                                @case('C')
                                    <h5>Estado de solicitud: <strong>CANCELADO</strong></h5>
                                @break
                                @case('R')
                                    <h5>Estado de solicitud: <strong>EN REVISION</strong></h5>
                                @break
                @endswitch
            </div>
            
        </div><br>

        <!-- begin:: Inicia card de informacion personal del usuario-->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Información Personal:</h3>
            </div>
            <div class="card-body">
                <form class="form" id="guardaUsuarioEnte" method="post" action="{{ route('usuarios.solicitudes.update', $solicitudId)}}">
                @csrf
                {{ method_field('PUT') }}
                <div class="">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            {{-- <tr>
                                <td>
                                    <label>Asigna un Rol:</label>
                                </td>
                                <td>
                                    <select id="rol" name="rol" class="form-control form-control-solid select2">
                                        <option value="9999">Selecciona</option>
                                        @foreach($roles as $rol)
                                            <option value="{{$rol->id}}">{{$rol->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr> --}}
                            <tr>
                                <td>Nombre (s): </td>
                                <td>
                                    <div class="col-9">
                                        {{$persona->nombre}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Apellido Paterno: </td>
                                <td>
                                    <div class="col-9">
                                        {{$persona->primer_ap}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Apellido Materno: </td>
                                <td>
                                    <div class="col-9">
                                        {{$persona->segundo_ap}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>CURP: </td>
                                <td>
                                    <div class="col-9">
                                        {{$persona->curp}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>RFC: </td>
                                <td>
                                    <div class="col-9">
                                        {{$persona->rfc}}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </form>
            </div>

        </div>
        <!-- end:: Inicia card de informacion personal del usuario-->


    </div>
    <div class="col-7">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Datos laborales:</h3>
            </div>
            <div class="card-body">
                
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>Unidad Administrativa:</td>
                                <td>
                                    <div class="col-9">
                                        @if($puestoPersona->puesto_funcional->tipoContratacion->clave_tipo_contratacion=='E')
                                            {{$puestoPersona->puesto_funcional->puestoEstructura->unidadAdministrativa->ente_publico->ente_publico}}
                                        @else
                                            {{$puestoPersona->puesto_funcional->puestoNoEstructura->puestosNoEstructuraAdscripcion}}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Área:</td>
                                <td>
                                    <div class="col-9">
                                        @if($puestoPersona->puesto_funcional->tipoContratacion->clave_tipo_contratacion=='E')
                                            {{$puestoPersona->puesto_funcional->puestoEstructura->unidadAdministrativa->unidad_admin}}
                                        @else
                                            
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Tipo de Contratación:</td>
                                <td>
                                    <div class="col-9">
                                        {{$puestoPersona->puesto_funcional->tipoContratacion->tipo_contratacion}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Puesto:</td>
                                <td>
                                    <div class="col-9">
                                        @if($puestoPersona->puesto_funcional->tipoContratacion->clave_tipo_contratacion=='E')
                                            {{$puestoPersona->puesto_funcional->puestoEstructura->puesto_estructura}}
                                        @else
                                             {{$puestoPersona->puesto_funcional->puestoNoEstructura->puesto_funcional}}
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Número de empleado:</td>
                                <td>
                                    <div class="col-9">
                                        {{$persona->num_empleado}}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="card-title">Contacto:</h3>
                    <!-- <p class="card-text">&nbsp;</p> -->
                    
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>Correo Electrónico:</td>
                                <td>
                                    <div class="col-9">
                                        {{$persona->email}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Número telefónico: </td>
                                <td>
                                    <div class="col-9">
                                        {{$persona->telefono}}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                
            </div>
            <div class="card-footer">
                
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
    <script>
        $('.select2').select2();
    </script>
<!--<script src="{{ asset('js/entidades/usuarios.js') }}" type="text/javascript"></script>-->
@if (session('error'))
<script>
    setTimeout(function() {
        swal.fire('¡Error!', "{{session('error')}}", 'error');
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