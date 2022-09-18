@extends('layout.default')
@section('content')

    {{-- Dashboard 1 --}}

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
    </div>
</div>
<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column-fluid pt-10 pb-0">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">
                        <span class="card-label font-weight-bolder text-dark">Seguimiento</span>
                        <span class="d-block text-muted pt-2 font-size-sm">Solicitudes de registro de usuario</span></h3>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="datatableSolicitudes">
                        <thead>
                            <tr>
                                <th title="Field #1" >REGISTRADO EL:</th>
                                <th title="Field #3" >NOMBRE:</th>
                                <th title="Field #5" >ESTATUS:</th>
                                <th title="Field #6" >ACCIONES:</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--end::Body-->
            <div class="card-footer">
                
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
<input type="hidden" name="url" id="url" value="{{url('/')}}">
@endsection
@section('scripts')
    <script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/admin/usuarios/solicitudes/userSol.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        tablaSol();
    </script>
<script type="text/javascript">


</script>

@endsection
