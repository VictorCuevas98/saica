<div id="exampleMostrandoDetallesArticulo" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title">Mostrando Detalles del Artículo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div class="d-flex mb-6">
                            <!--begin: Pic-->
                            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                <div class="symbol ">
                                    <span class="symbol-label"><i class="fas fa-pills  icon-lg icon-5x"></i></span>
                                </div>
                                <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                    <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between flex-wrap mt-1">
                                    <div class="d-flex mr-3">
                                        <a href="#" class="text-dark-75 mr-3">
                                            {{$artmed->artmed}}
                                        </a>
                                        <!--<a href="#">
                                            <i class="flaticon2-correct text-success font-size-h5"></i>
                                        </a>-->
                                    </div>
                                    <!-- boton volver
                                    <a href="#" id="btn-modal-search-artmed" class=" btn-xs btn btn-icon btn-outline-warning">
                                        <i class="fas fa-undo "></i>
                                    </a>
                                    -->

                                </div>
                                <!--end::Title-->
                                <!--begin::Content-->
                                <div class="d-flex flex-wrap justify-content-between mt-1">
                                    <div class="d-flex flex-column flex-grow-1 pr-8">
                                        <div class="d-flex flex-wrap mb-4">
                                            <a href="#"
                                               class="text-dark-50 text-hover-primary  mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <i class="fas fa-keyboard mr-2 font-size-lg"></i>{{$artmed->clave_artmed}}
                                            </a>
                                            <a href="#"
                                               class="text-dark-50 text-hover-primary  mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                <i class="fas fa-box-open mr-2 "></i>{{$artmed->unidad_medida}}</a>
                                            <!--<a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                            i class="flaticon2-placeholder mr-2 font-size-lg"></i>Melbourne</a>-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Info-->
                        </div>
                        @switch($option)
                            @case(1)
                            <div class="row mb-4">
                                <!--
                                <i class="fas fa-hashtag mr-2"></i>
                                <i class="fas fa-dollar-sign mr-2"></i>
                                -->
                                <div class="col-lg-3">
                                    <label for=""><strong>Cantidad:</strong></label>
                                    <span>{{$contratoArtmed->cantidad_unidades ?? ''}}</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for=""><strong>Monto:</strong></label>
                                    <span>{{$contratoArtmed->monto_unitario ?? ''}}</span>
                                </div>
                            </div>
                            <div class="row mb-12">
                                <div class="col-lg-3">
                                    <label for=""><strong>Subtotal:</strong></label>
                                    <span>{{$contratoArtmed->monto_subtotal ?? ''}}</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for=""><strong>Iva:</strong></label>
                                    <span>{{$contratoArtmed->monto_impuesto ?? ''}}</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for=""><strong>Total:</strong></label>
                                    <span>{{$contratoArtmed->monto_total ?? ''}}</span>
                                </div>
                            </div>
                            <div class="d-flex mb-9">
                                <!--begin: Pic-->
                                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                    <div class="symbol ">
                                        <span class="symbol-label"><i
                                                class="fas fa-calendar-alt icon-lg icon-5x"></i></span>
                                    </div>
                                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                        <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                                    </div>
                                </div>
                                <!--end::Pic-->
                                <!--begin::Info-->
                                <div class="flex-grow-1">
                                    <!--begin::Title-->
                                    <div class="d-flex justify-content-between flex-wrap mt-1">
                                        <div class="d-flex mr-3">
                                            <a href="#" class="text-dark-75 mr-3">
                                                PERIODO PARCIAL DE ENTREGAS
                                            </a>
                                        </div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Content-->
                                    <div class="">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td>Fecha Inicio</td>
                                                <td>Fecha Termino</td>
                                                <td>Cantidad</td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($contratoArtmed->periodos))
                                            @foreach($contratoArtmed->periodos as $periodo)

                                                <tr>
                                                    <td>{{$periodo->fecha_inicio}}</td>
                                                    <td>{{$periodo->fecha_termino}}</td>
                                                    <td>{{$periodo->cantidad_unidades}}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <div class="d-flex mb-5">
                                <div class="flex-grow-1">
                                    <h4>Importes Totales</h4>
                                </div>
                            </div>
                            <div class="d-flex mb-12">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-start">
                                        <div class="mr-9">
                                            <strong>Subtotal:</strong> {{$contratoArtmed->contratoCerrado->monto_subtotal ?? ''}}
                                        </div>
                                        <div class="mr-9">
                                            <strong>IVA:</strong> {{$contratoArtmed->contratoCerrado->monto_impuesto ?? ''}}
                                        </div>
                                        <div class="mr-9">
                                            <strong>Total:</strong> {{$contratoArtmed->contratoCerrado->monto_impuesto ?? ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @break
                            @case(2)
                            <div class="row mb-10">
                                <!--
                                <i class="fas fa-hashtag mr-2"></i>
                                <i class="fas fa-dollar-sign mr-2"></i>
                                -->
                                <div class="col-lg-3">
                                    <label for=""><strong>Cantidad Mínima:</strong></label>
                                    <span>{{$contratoArtmed->cantidad_unidades_minima ?? ''}}</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for=""><strong>Cantidad Máxima:</strong></label>
                                    <span>{{$contratoArtmed->cantidad_unidades_maxima ?? ''}}</span>
                                </div>
                                <div class="col-lg-3">
                                    <label for=""><strong>Monto:</strong></label>
                                    <span>{{$contratoArtmed->monto_unitario_fijo ?? ''}}</span>
                                </div>
                            </div>
                            <h5>Importes Totales</h5>
                            <div class="row mb-3 mt-7">
                                <div class="col-lg-4">
                                    <label for=""><strong>Subtotal Mínimo:</strong></label>
                                    <span>{{$contratoArtmed->contratoAbierto->monto_subtotal_minimo ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for=""><strong>Iva Mínimo:</strong></label>
                                    <span>{{$contratoArtmed->contratoAbierto->monto_impuesto_minimo ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for=""><strong>Total Mínimo:</strong></label>
                                    <span>{{$contratoArtmed->contratoAbierto->monto_total_minimo ?? ''}}</span>
                                </div>
                            </div>
                            <div class="row mb-9">
                                <div class="col-lg-4">
                                    <label for=""><strong>Subtotal Máximo:</strong></label>
                                    <span>{{$contratoArtmed->contratoAbierto->monto_subtotal_maximo ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for=""><strong>Iva Máximo:</strong></label>
                                    <span>{{$contratoArtmed->contratoAbierto->monto_impuesto_maximo ?? ''}}</span>
                                </div>
                                <div class="col-lg-4">
                                    <label for=""><strong>Total Máximo:</strong></label>
                                    <span>{{$contratoArtmed->contratoAbierto->monto_total_maximo ?? ''}}</span>
                                </div>
                            </div>
                            @break
                        @endswitch
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
