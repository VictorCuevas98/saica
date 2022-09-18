@extends('layout.default')
@section('content')

<div class="card card-custom card-sticky" id="kt_page_sticky_card">
    <div class="card-header" style="">
        <div class="card-title">
            <h3 class="card-label text-dark">Nuevo Usuario {{$role}}
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="{{url('/')}}" class="btn btn-light-success font-weight-bolder mr-2">
                <i class="ki ki-long-arrow-back icon-sm"></i>Regresar</a>
            <div class="btn-group">
                <button type="submit" id="registrarUsuario" class="btn btn-success font-weight-bolder" form="guardaUsuarioEnte">
                    <i class="ki ki-check icon-sm"></i>Guardar</button>
                
            </div>
        </div>
    </div>
    <div class="card-body">
        <!--begin::Form-->
        <form class="form" id="guardaUsuarioEnte" method="post" action="{{ url('guardaUsuarioEnte')}}">
            @csrf
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="my-5">
                        <h3 class="text-dark font-weight-bold mb-10">Información personal:</h3>
                        <div class="form-group row">
                            <label class="col-3">CURP</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="curp" name="curp" maxlength="18">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">RFC</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="rfc" name="rfc" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Homoclave</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="homoclave" name="homoclave" maxlength="3">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Nombre(s)</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="nombre" name="nombre" maxlength="60">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Apellido Paterno</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="paterno" name="paterno" maxlength="60">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Apellido Materno</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="materno" name="materno" maxlength="60">
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="my-5">
                        <h3 class="text-dark font-weight-bold mb-10">Contacto:</h3>
                        <div class="form-group row">
                            <label class="col-3">Correo electrónico</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="correo" name="correo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Confirmar correo electrónico</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="confirmacorreo" name="confirmacorreo">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Número telefónico</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="telefono" name="telefono" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Confirmar número telefónico</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="confirmatelefono" name="confirmatelefono" maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="my-52">
                        <h3 class="text-dark font-weight-bold mb-10">Permisos:</h3>
                        <div class="form-group row">
                            <label class="col-3">Tipo de Perfil</label>
                            <div class="col-9">
                                <select class="form-control form-control-solid" id="perfil" name="perfil">
                                    <option value="">--Selecciona--</option>
                                    @php
                                        $role_name="";
                                    @endphp
                                    @foreach($cat_roles as $roles)
                                        @php
                                            if($roles->name == 'RECONSTRUCCION')
                                                $role_name = 'OPERADOR';
                                        @endphp
                                    <option value="{{$roles->id}}">{{$role_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed my-10"></div>
                    <div class="my-52">
                        <h3 class="text-dark font-weight-bold mb-10">Datos laborales:</h3>
                        <div class="form-group row">
                            <label class="col-3">Área</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="area" name="area" maxlength="100">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3">Cargo</label>
                            <div class="col-9">
                                <input class="form-control form-control-solid" type="text" id="cargo" name="cargo" maxlength="100">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2"></div>
            </div>
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/entidades/usuarios.js') }}" type="text/javascript"></script>
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