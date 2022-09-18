{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')


<!--begin::Entry-->
@if(\Illuminate\Support\Facades\Auth::user()->rfc === 'ADMINISTRADOR')
            <div class="form-group float-right">
                <a class="btn btn-success" href="{{url('admin/usuarios_dgtc')}}">Descargar Reporte DGTC</a>
            </div>



@endif
                        <div class="d-flex flex-column-fluid float-right">
                            <br>
                            <!--begin::Container-->
                            <div class="container">
                                <!--begin::Row-->
                                <div class="row">
                                    @foreach($bloques as $bloque)

                                    <div class="col-xl-4">
                                        <!--begin::List Widget 1-->
                                        <div class="card card-custom card-stretch gutter-b">

                                            <span class="label label-lg label-inline text-white font-weight-bold py-4" style="background-color: {{$bloque->evento->tipo_evento->color}}" >

                                                <div class="col-md-6 text-left">
                                                    {{$bloque->fecha_inicio}}

                                                </div>
                                                <div class="col-md-6 text-right">
                                                    {{$bloque->hora_inicio}}
                                                </div>
                                             </span>


                                            <!--begin::Header-->
                                            <div class="card-header border-0 pt-5">

                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label font-weight-bolder text-dark">{{$bloque->titulo}}</span>
                                                    <span class="text-muted mt-3 font-weight-bold font-size-sm">{{$bloque->evento->descripcion}}</span>
                                                </h3>

                                                <div class="card-toolbar">



                                                    {{-- <div class="dropdown dropdown-inline">
                                                        <a href="#" class="btn btn-light-primary btn-sm font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create</a>
                                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                            <!--begin::Navigation-->
                                                            <ul class="navi navi-hover">
                                                                <li class="navi-header pb-1">
                                                                    <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-shopping-cart-1"></i>
                                                                        </span>
                                                                        <span class="navi-text">Order</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-calendar-8"></i>
                                                                        </span>
                                                                        <span class="navi-text">Event</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-graph-1"></i>
                                                                        </span>
                                                                        <span class="navi-text">Report</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-rocket-1"></i>
                                                                        </span>
                                                                        <span class="navi-text">Post</span>
                                                                    </a>
                                                                </li>
                                                                <li class="navi-item">
                                                                    <a href="#" class="navi-link">
                                                                        <span class="navi-icon">
                                                                            <i class="flaticon2-writing"></i>
                                                                        </span>
                                                                        <span class="navi-text">File</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <!--end::Navigation-->
                                                        </div>
                                                    </div>  --}}
                                                </div>

                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body pt-8">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->



                                                    <div class="symbol mr-3">
                                                        <span class="symbol-label"><i class="flaticon-profile-1 icon-2x text-muted font-weight-bold"></i></span>
                                                    </div>

                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold flex-grow-1">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Ponentes</a>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">{{$bloque->evento->ponentes()->count()}}</span>

                                                    <a href="{{route('reportes_bloque_ponentes',@Hashids::encode($bloque->id))}}" class="btn btn-icon btn-light-success ml-2">
                                                        <i class="flaticon-download"></i>
                                                    </a>
                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->

                                                    <div class="symbol mr-3">
                                                        <span class="symbol-label"><i class="flaticon2-group  icon-2x text-muted font-weight-bold"></i></span>
                                                    </div>

                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold flex-grow-1">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Registrados</a>
                                                        <span class="text-muted"></span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">{{$bloque->asistencias()->where('activo',true)->get()->count()}}</span>

                                                    <a href="{{route('reportes_bloque_usuarios_registrados',@Hashids::encode($bloque->id))}}" class="btn btn-icon btn-light-success ml-2">
                                                        <i class="flaticon-download"></i>
                                                    </a>
                                                </div>
                                                <!--end::Item-->


                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->


                                                    <div class="symbol mr-3">
                                                        <span class="symbol-label"><i class="flaticon-presentation  icon-2x text-muted font-weight-bold"></i></span>
                                                    </div>

                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold flex-grow-1">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Asistencias</a>
                                                        <span class="text-muted">Con código</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">
                                                        

                                                        {{
                                                            $bloque->asistencias()->where('activo',true)->where('asistencia',true)->get()->count()
                                                        }}


                                                    </span>



                                                    <a href="{{route('reportes_bloque_usuarios_asistencia',@Hashids::encode($bloque->id))}}" class="btn btn-icon btn-light-success ml-2">
                                                        <i class="flaticon-download"></i>
                                                    </a>

                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->


                                                    <div class="symbol mr-3">
                                                        <span class="symbol-label"><i class="flaticon-comment icon-2x text-muted font-weight-bold"></i></span>
                                                    </div>

                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold flex-grow-1">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Solicitudes</a>
                                                        <span class="text-muted">De apertura de fecha</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">
                                                        {{$bloque->solicitudesInformacion()->whereHas('cat_solicitud_evento', function ( $query) {
                                                                $query->where('cve_solicitud', 'A');
                                                            })->get()->count()
                                                        }}
                                                    </span>



                                                    <a href="{{route('reportes_bloque_usuarios_solicitudes_apertura',@Hashids::encode($bloque->id))}}" class="btn btn-icon btn-light-success ml-2">
                                                        <i class="flaticon-download"></i>
                                                    </a>

                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->


                                                    <div class="symbol mr-3">
                                                        <span class="symbol-label"><i class="flaticon-information icon-2x text-muted font-weight-bold"></i></span>
                                                    </div>

                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold flex-grow-1">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Solicitudes</a>
                                                        <span class="text-muted">De información</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">
                                                        {{$bloque->solicitudesInformacion()->whereHas('cat_solicitud_evento', function ( $query) {
                                                                $query->where('cve_solicitud', 'I');
                                                            })->get()->count()
                                                        }}
                                                    </span>

                                                    <a href="{{route('reportes_bloque_usuarios_solicitudes_info',@Hashids::encode($bloque->id))}}" class="btn btn-icon btn-light-success ml-2">
                                                        <i class="flaticon-download"></i>
                                                    </a>

                                                </div>
                                                <!--end::Item-->

                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center mb-10">
                                                    <!--begin::Symbol-->


                                                    <div class="symbol mr-3">
                                                        <span class="symbol-label"><i class="flaticon-browser icon-2x text-muted font-weight-bold"></i></span>
                                                    </div>

                                                    <!--end::Symbol-->
                                                    <!--begin::Text-->
                                                    <div class="d-flex flex-column font-weight-bold flex-grow-1">
                                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Ingresos</a>
                                                        <span class="text-muted">Via sistema</span>
                                                    </div>
                                                    <!--end::Text-->
                                                    <span class="label label-xl label-light label-inline my-lg-0 my-2 text-dark-50 font-weight-bolder">
                                                        {{
                                                            $bloque->asistencias()->where('activo',true)->where('ingreso',true)->get()->count()
                                                        }}
                                                    </span>

                                                    <a href="{{route('reportes_bloque_ingresos_sistema',@Hashids::encode($bloque->id))}}" class="btn btn-icon btn-light-success ml-2">
                                                        <i class="flaticon-download"></i>
                                                    </a>

                                                </div>
                                                <!--end::Item-->

                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List Widget 1-->
                                    </div>

                                    @endforeach

                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->

                            </div>
                            <!--end::Container-->
                        </div>
                        <!--end::Entry-->
@endsection
@section('scripts')
  <!--<script src="{{URL::asset('js/admin/usuarios/control_usuarios.js')}}" type="application/javascript"></script>-->
@endsection
