<!--begin: Search Form-->
                {{--<form class="kt-form kt-form--fit mb-15" id="kt_form_search_artmed">--}}
                    <div class="row mb-6">
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Clave:</label>
                            <input type="text" class="form-control datatable-input" placeholder="E.g: 4590" data-col-index="1" />
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Artículo:</label>
                            <input type="text" class="form-control datatable-input" placeholder="E.g: acido acetil " data-col-index="2" />
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Cabms:</label>
                            <input type="text" class="form-control datatable-input" placeholder="E.g: 37000" data-col-index="3" />
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Unidad de medida:</label>
                            <input type="text" class="form-control datatable-input" placeholder="E.g: pieza" data-col-index="4" />
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Revisión:</label>
                            <input type="text" class="form-control datatable-input" placeholder="" data-col-index="5" />
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Estatus:</label>
                            <select class="form-control datatable-input" data-col-index="6">
                                <option value="">Selecciona</option>
                                <option value="true">Activo</option>
                                <option value="false">Cancelado</option>
                            </select>
                        </div>
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Partida:</label>
                            <select class="form-control datatable-input" data-col-index="7" name="partida" id="partida">
                                <option value="">Selecciona</option>
                                @foreach($catPartidaEspecifica as $partida)
                                    <option value="{{$partida->clave_partida}}">{{$partida->clave_partida}} - {{$partida->partida}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mt-8">
                        <div class="col-lg-12">
                            <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                <span>
                                    <i class="fas fa-eraser"></i>
                                    <span>Limpiar</span>
                                </span>
                            </button>
                            &#160;&#160;
                            <button class="btn btn-primary btn-primary--icon" id="kt_search">
                                <span>
                                    <i class="fas fa-search"></i>
                                    <span>Buscar</span>
                                </span>
                            </button>
                        </div>
                    </div>
                {{--</form>--}}
                <!--begin: Datatable-->
                <!--begin: Datatable-->
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable_search_artmed">
                    
                </table>
                <!--end: Datatable-->