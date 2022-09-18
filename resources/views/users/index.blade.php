@extends('layout.default')

@section('breadcrumbs')
    
    
    <div class="page-breadcrumb">
        <div class="row">
        
            <div class="col-6 align-self-center">
                <h4 class="page-title">&nbsp;</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="{{route('users.index')}}" >Usuarios</a></li>
                            <li class="breadcrumb-item active" aria-current="page" >Index</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-6">  
            </div>
        </div>
    </div>
@endsection

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
                    <span class="text-muted">Usuarios</span>
                </li>
            </ul>
            <!--end::Breadcrumb-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
        <!--end::Details-->
    </div>
</div>
<!--end::Subheader-->

<div >
    @if(count( $errors ) > 0)
       @foreach ($errors->all() as $error)
          <!-- Alert with image / icon -->
            <div class="alert alert-danger"> <img src="{{asset('xtreme-admin/assets/images/users/1.jpg')}}" width="30" class="rounded-circle" alt="img"> {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
      @endforeach
    @endif
</div>
<br>
<div class="card card-custom">
    <div class="card-header">
        <h4 class="card-title">
            Usuarios
        </h4>
        <h5 class="card-subtitle">&nbsp;</h5>
        <div class="ml-auto d-flex no-block align-items-center">

            <!-- nuevo usuario -->
            <div class="dl">
                @can('users.create')
                   <button type="button" class="btn btn-primary font-weight-bold btn-sm px-4 font-size-base ml-2" data-toggle="modal" data-target="#registroServidorPublicoManual">
                    Nuevo usuario
                    </button>
                    @include('users._nuevoUsuario_modal',['entesPublicos'=>$entesPublicos,'catTipoContratacion'=>$catTipoContratacion])
                @endcan
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(Session::has('flash'))
            <div class="col-sm-12">
                <div class="alert alert-success">
                    <strong>{{session('flash')}}</strong>
                </div>
            </div>
        @endif

        <div class="col-md-12">
            <form action="{{route('users.index')}}">
                <div class="form-group">

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>RFC:</label>
                            <input type="text" class="form-control" name="busquedaRfc" id="busquedaRfc" value="{{$busquedaRfc}}" placeholder="E.g:SOLC950714HG0" maxlength="13">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Nombre:</label>
                            <input type="text" class="form-control" name="busquedaNombre" id="busquedaNombre" value="{{$busquedaNombre}}" placeholder="E.g:Erik">
                        </div>
                        <div class="col-md-4">
                            <label>Apellido paterno:</label>
                            <input type="text" class="form-control" name="busquedaPrimer_ap" id="busquedaPrimer_ap" value="{{$busquedaPrimer_ap}}" placeholder="E.g:Infante">
                        </div>
                        <div class="col-md-4">
                            <label>Apellido materno:</label>
                            <input type="text" class="form-control" name="busquedaSegundo_ap" id="busquedaSegundo_ap" value="{{$busquedaSegundo_ap}}" placeholder="E.g: Galindo">
                        </div>    
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Correo electrónico:</label>
                            <input type="text" class="form-control" name="busquedaEmail" id="busquedaEmail" value="{{$busquedaEmail}}" placeholder="E.g:correo@dominio.com.mx">
                        </div>
                        <div class="col-md-4">
                            <label>Ultimo inicio de sesión:</label>
                            <select class="form-control" name="selectLastLogin" id="selectLastLogin">
                                <option value="0">Selecciona una opción</option>
                                <option value="1 hour">Menos de 1 mes</option>
                                <option value="2 hour">Menos de 2 meses</option>
                                <option value="3 hour">Menos de 3 meses</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Activo o Inactivo:</label>
                            <select class="form-control" name="selectEstadoUsuarios" id="selectEstadoUsuarios">
                                <option value="">Selecciona una opción</option>
                                <option value="true">Activos</option>
                                <option value="false">Inactivos</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8">

                            <a href="{{route('users.index')}}" class="btn btn-secondary">
                                <i class="fa fa-eraser" aria-hidden="true"></i> Restablacer
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <span class="fa fa-search" aria-hidden="true"></span>
                                Buscar
                            </button>
                        </div>  
                    </div>
                </div>
            </form>
        </div><br><br>
        <div class="col-md-12">
            <table class="table table-striped table-bordered" id="tableUsers">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>RFC</td>
                        <td>usuario</td>
                        <td>email</td>
                        <td>Proceso de<br>registro</td>
                        <td>Ultimo inicio<br>de sesión</td>
                        <td>Estado</td>
                        <td>roles</td>
                        <td>acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @if(count($usuarios) < 1)
                    <tr>
                        <td colspan="9" align="center">
                            <strong>No hay resultados</strong>
                        </td>
                    </tr>
                    @else
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->rfc}}</td>
                        <td>{{$usuario->persona->nombre}} {{$usuario->persona->primer_ap}} {{$usuario->persona->segundo_ap}}</td>
                        <td>{{$usuario->persona->email}}</td>
                        <td>
                            @switch($usuario->persona->id_status_persona)
                                @case('A')
                                    <p>ACTIVO</p>
                                @break

                                @case('P')
                                    <p>PENDIENTE</p>
                                @break

                                @case('C')
                                    <p>CANCELADO</p>
                                @break
                                @case('R')
                                    <p>EN REVISIÓN</p>
                                @break
                            @endswitch
                        </td>
                        <td>{{$usuario->last_login}}</td>
                        <td>
                            @switch($usuario->activo)
                                @case(true)
                                    <strong>Activo</strong>
                                @break

                                @case(false)
                                    <strong>Inactivo</strong>
                                @break

                                @default
                                    <strong>Inactivo</strong>
                            @endswitch
                        </td>
                            <td>
                                @foreach($usuario->getRoleNames() as $role )
                                    <span class="badge badge-default">{{$role}}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($usuario->persona->id_status_persona != 'A')
                                    <a href="{{url('/admin/usuarios/solicitudes')}}" class="btn btn-sm btn-clean btn-icon">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </a>

                                    @else
                                        @if(auth()->user()->can('users.edit') || auth()->user()->can('users.show')  )
                                            <a href="{{ route('users.show',$usuario->id) }}" class="btn btn-sm btn-clean btn-icon"><i class="fa fa-id-card" aria-hidden="true"></i></a>
                                        @endif
                                @endif
                            </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-12 " >
            {{$usuarios->onEachSide(5)->links() }}
        </div >
    </div>
        <div class="card-footer">
        </div>
 </div><br><br>

 <input type="hidden" value="{{url('/')}}/" id="url" name="url">

@endsection

{{-- Checar esta seccion --}}
@section('custom-scripts')  
<script src="{{asset('xtreme-admin/assets/extra-libs/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js')}}"></script>
<script>
    $(document).ready( function () {
        $('#tableUsers').DataTable( {
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
        });
    } );
    console.log('custom-scripts');
</script>

@endsection

@section('scripts')
    
    <script type="text/javascript">
        var url;
        url = $('#url').val();
    </script>

    {{-- <script type="text/javascript" src="{{ asset('js/login/login_.js')}}"></script> --}}
    <script type="text/javascript" src="{{ asset('js/admin/usuarios/nuevoUsuario_modal.js')}}"></script>

    <script>
   
   var urlGuardarManual = "{{route('guardarUsuario.manual')}}"
   var urlEntidades = "{{route('consulta.entidades')}}"
   var urlUnidadesAdministrativas = "{{route('consulta.unidades.administrativas')}}"
    </script>
    
@endsection
