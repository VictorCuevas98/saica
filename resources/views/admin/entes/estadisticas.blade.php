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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Selección de estadistica:</h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <button name="#proyectosPorEtapas" onclick="cambioDeEstadistica(this)" class="btn btn-success btn-sm p-1 seleccion">Proyectos</button>&nbsp;&nbsp;
                    <button name="#procesosPorProyectos" onclick="cambioDeEstadistica(this)" class="btn btn-success btn-sm p-1 seleccion">Procesos</button>&nbsp;&nbsp;
                    <button name="#actividadesPorProyectos" onclick="cambioDeEstadistica(this)" class="btn btn-success btn-sm p-1 seleccion">Actividades</button>

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
                <!--<a href="{{route('agregar_usuario_ente')}}" class="btn btn-light-success font-weight-bold btn-sm px-4 font-size-base ml-2">Agregar Usuario</a>
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
                            <span id="tituloEstadistica" class="card-label font-weight-bolder text-dark">Estadística y Revisión de Proyectos</span>
                            <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                    </div>
                    <span id="spin"></span>

                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <div><hr><br><br></div>
                    <div class="row" id="proyectosPorEtapas">
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                <label><h5>Situación de proyectos por etapas</h5></label>
                            </div>
                            <div id="chart_12" class="d-flex justify-content-left" style="min-height: 265.7px;"></div>
                        </div>
                        <!--<div class="col-6">
                            <div class="d-flex justify-content-center">
                                <label><h5>Situación de proyectos firmados con Firma Fiel</h5></label>
                            </div>
                            <div id="chart_13" class="d-flex justify-content-left" style="min-height: 265.7px;"></div>
                        </div>-->
                    </div>
                    <div class="row" id="procesosPorProyectos" style="display: none;">
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <label><h5>Total de Procesos {{\Illuminate\Support\Facades\Auth::user()->persona->laboralPersona->unidadAdmin->clave_uniadm}}</h5></label>
                            </div>
                            <div id="graficaProcesosTotal" class="d-flex justify-content-left" style="min-height: 265.7px;"></div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <label><h5>Procesos {{\Illuminate\Support\Facades\Auth::user()->persona->laboralPersona->unidadAdmin->clave_uniadm}} por Proyecto</h5></label>
                            </div>
                            <div class="d-flex justify-content-center col-12">
                                <div class="form-group row">
                                    <select id="proyectos" class="js-example-basic-multiple" onchange="procesosPorProyectos(this.value)">
                                        <option value="0" disabled selected>Selecciona un proyecto</option>
                                       @foreach($proyectos as $proyecto)
                                            <option value="{{$proyecto->id}}">{{ $proyecto->folio_registro }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="contenedorProcesos">
                                <div id="graficaProcesoPorProyectos" class="d-flex justify-content-left" style="min-height: 265.7px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="actividadesPorProyectos" style="display: none;">
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <label><h5>Total de Actividades {{\Illuminate\Support\Facades\Auth::user()->persona->laboralPersona->unidadAdmin->clave_uniadm}} por Estatus</h5></label>
                            </div>
                            <div id="graficaActividadesEstatus" class="d-flex justify-content-left" style="min-height: 265.7px;"></div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-center">
                                <label><h5>Actividades {{\Illuminate\Support\Facades\Auth::user()->persona->laboralPersona->unidadAdmin->clave_uniadm}} por Proyecto</h5></label>
                            </div>
                            <div class="d-flex justify-content-center col-12">
                                <div class="form-group row">
                                    <select id="proyectosActividades" class="js-example-basic-multiple" onchange="actividadesPorProyectos(this.value)">
                                        <option value="0" disabled selected>Selecciona un proyecto</option>
                                        @foreach($proyectos as $proyecto)
                                            <option value="{{$proyecto->id}}">{{ $proyecto->folio_registro }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="contenedorActividades">
                                <div id="graficaActividadesPorPoryecto" class="d-flex justify-content-left" style="min-height: 265.7px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>

@endsection
@section('scripts')
    <script src="{{URL::asset('js/entidades/admin/estadistica.js')}}"></script>
@endsection