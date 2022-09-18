<div id="exampleModalArticuloEdit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y: scroll;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content animated bounceInRight">
            <div class="modal-header">
                <h4 class="modal-title">Detalles del Artículo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <input type="text" class="id_contrato" value="{{$contrato_id ?? ''}}" hidden>
                <input type="text" class="id_artmed" value="{{$element_id ?? ''}}" hidden>
                <div id="form-artmed-periodo">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <!--begin::Details-->
                            <div class="d-flex mb-9">
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
                                                <a href="#" class="text-dark-50 text-hover-primary  mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                    <i class="fas fa-keyboard mr-2 font-size-lg"></i>{{$artmed->clave_artmed}}</a>
                                                <a href="#" class="text-dark-50 text-hover-primary  mr-lg-8 mr-5 mb-lg-0 mb-2">
                                                    <i class="fas fa-box-open mr-2 "></i>{{$artmed->unidad_medida}}</a>
                                                <!--<a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                                                i class="flaticon2-placeholder mr-2 font-size-lg"></i>Melbourne</a>-->
                                            </div>
                                            <!--<span class="font-weight-bold text-dark-50">----------------</span>-->

                                        </div>

                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Details-->
                            @switch($option)
                                @case(1)
                                @include('contratos.articulos._form_1')
                                @break

                                @case(2)
                                @include('contratos.articulos._form_2')
                                @break
                            @endswitch
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button style="margin-left: 30px;" type="button" class="btn btn-primary guardar-artmed-contratos">Guardar</button>
            </div>
        </div>
    </div>
</div>

