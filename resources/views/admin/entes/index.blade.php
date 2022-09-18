{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Usuarios</h5>
            <!--end::Title-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Search Form-->
            <div class="d-flex align-items-center" id="kt_subheader_search">
                <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">Total: {{$total}}</span>
                <form class="ml-5">
                    <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                        <input type="text" class="form-control" id="kt_subheader_search_form" placeholder="Buscar..." />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <span class="svg-icon">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Search Form-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="#" class=""></a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{route('agregar_usuario_ente')}}" class="btn btn-light-success font-weight-bold btn-sm px-4 font-size-base ml-2">Agregar Usuario</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
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
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">
                        <span class="card-label font-weight-bolder text-dark">Alta, baja y edición de usuarios</span>
                        <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                </div>

            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body">
                <!--begin: Datatable-->
                <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                    <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                        <thead>
                            <tr>
                                <th title="Field #1">Nombre</th>
                                <th title="Field #2">RFC</th>
                                <th title="Field #4">Correo</th>
                                <th title="Field #3">Perfil</th>
                                <th title="Field #5">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datosUser as $user)
                            <tr>
                                <td>
                                    <span style="width: 250px;">
                                        <div class="d-flex align-items-center">
                                            @if(substr($user->name, 0, 5)=='ADMIN')
                                            <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">
                                            @else
                                            <div class="symbol symbol-40 symbol-light-success flex-shrink-0">
                                            @endif
                                                <span class="symbol-label font-size-h4 font-weight-bold">@php $nombre = $user->nombre; echo $nombre[0]; @endphp</span> </div>
                                            <div class="ml-4">
                                                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0">{{$user->nombre}} {{$user->primer_ap}} {{$user->segundo_ap}}</div>
                                            </div>
                                        </div>
                                    </span>
                                </td>
                                <td>{{$user->rfc}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                @php
                                    $role_name="";
                                    if($user->name == 'SEDUVI' || $user->name == 'SAF' || $user->name == 'SACMEX' || $user->name == 'SEDEMA' || $user->name == 'SERVIMET')
                                        $role_name = 'OPERADOR';
                                    else if($user->name == 'ADMINSEDUVI' || $user->name == 'ADMINSAF' || $user->name == 'ADMINSACMEX' || $user->name == 'ADMINSEDEMA' || $user->name == 'ADMINSERVIMET')
                                        $role_name =  'ADMINISTRADOR';
                                @endphp
                                {{$role_name}}
                                
                                </td>
                                <td><span style="overflow: visible; position: relative; width: 130px;">

                                        <a href="{{url('editar_ente',@Hashids::encode($user->id_persona))}}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Editar"> <span class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                                                        <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                    </g>
                                                </svg> </span>
                                        </a>
                                        <a href="javascript:;" onclick='borrarEnte("{{@Hashids::encode($user->id_persona)}}");' class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon" title="Borrar"> <span class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                                        <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                                                    </g>
                                                </svg> </span>
                                        </a>
                                    </span>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end: Datatable-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->




@endsection
@section('scripts')
<script src="{{ asset('js/entidades/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/entidades/usuarios.js') }}" type="text/javascript"></script>
@if (session('success'))
<script>
    setTimeout(function() {
        swal.fire('¡Aviso!', "{{session('success')}}", 'success');
    }, 500);
</script>
@endif
@if (session('error'))
<script>
    setTimeout(function() {
        swal.fire('¡Aviso!', "{{session('error')}}", 'error');
    }, 500);
</script>
@endif
@endsection