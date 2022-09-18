{{-- Extends layout --}}
@extends('layout.default')
{{-- Content --}}
@section('content')
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
                                </div>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-8">

                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-10">
                                    <!--begin::Symbol-->


                                    <div class="symbol mr-3">
                                        <span class="symbol-label"><i class="flaticon-information icon-2x text-muted font-weight-bold"></i></span>
                                    </div>

                                    <!--end::Symbol-->
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold flex-grow-1">
                                        <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">Constancias</a>
                                        <span class="text-muted">Registrar</span>
                                    </div>
                                    <!--end::Text-->
                                    <a title="Registrar constancia" href="{{route('registrar_constancia', @Hashids::encode($bloque->id))}}" class="btn btn-icon btn-light-success ml-2">
                                        <i class="flaticon2-edit"></i>
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
