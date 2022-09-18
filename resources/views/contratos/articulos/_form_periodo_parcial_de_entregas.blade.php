<div class="row form-group">
    <div id="pariodo_parcial_entregas" class="mx-auto">
        <div class="separator separator-solid my-10"></div>
        <div class="my-6"><p style="font-size: 1rem" class="form-text h4">Periodo parcial de
                entregas</p></div>
        <span
            class="form-text text-muted">Seleccione un rango de fechas</span><br>
        <div id="ter-table">
            <div class="art-periodo">
                <table class="table table-bordered table-FOC-periodo">
                    <tr>
                        <td>Periodo</td>
                        <td>Cantidad</td>
                        <td>Acciones</td>
                    </tr>
                    @if(!isset($contratoArtmed->periodos))
                        <tr class="periodo1">
                            <td class="fecha-periodo">
                                <div class="input-daterange input-group my-auto kt_datepicker_5">
                                    <input type="text" class="form-control fecha-start" placeholder="Desde" id="fecha_start1" name="fecha_start1"/>

                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ki ki-more-hor"></i></span>
                                    </div>

                                    <input type="text" class="form-control fecha-end" placeholder="Hasta" id="fecha_end1" name="fecha_end1"/>
                                </div>
                            </td>
                            <td>
                                <div class="my-auto">
                                    <input type="number" class="form-control cantidad-de-articulos-a-entregar" id="cantidad_de_articulos_a_entregar1" name="cantidad_de_articulos_a_entregar1">
                                </div>
                            </td>
                            <td>
                                <button title="eliminar" type="submit"
                                        class="btn btn-sm font-weight-bolder data-repeater-delete">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endif
                    @if(isset($contratoArtmed->periodos))
                    @foreach($contratoArtmed->periodos as $key => $periodo)
                        <tr name="{{'periodo' . ($key+1)}}">
                            <td class="fecha-periodo">
                                <div class="input-daterange input-group my-auto kt_datepicker_5">
                                    <input type="text" class="form-control fecha-start" placeholder="Desde" value="{{$periodo->fecha_inicio ?? ''}}" id="{{'fecha_start' . ($key+1)}}" name="{{'fecha_start' . ($key+1)}}"/>

                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ki ki-more-hor"></i></span>
                                    </div>

                                    <input type="text" class="form-control fecha-end" placeholder="Hasta" value="{{$periodo->fecha_termino ?? ''}}" id="{{'fecha_end' . ($key+1)}}" name="{{'fecha_end' . ($key+1)}}"/>
                                </div>
                            </td>
                            <td>
                                <div class="my-auto">
                                    <input type="number" class="form-control cantidad-de-articulos-a-entregar" value="{{$periodo->cantidad_unidades ?? ''}}" id="{{'cantidad_de_articulos_a_entregar' . ($key+1)}}" name="{{'cantidad_de_articulos_a_entregar' . ($key+1)}}">
                                </div>
                            </td>
                            <td>
                                <button title="eliminar" type="submit"
                                        class="btn btn-sm font-weight-bolder data-repeater-delete">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                </table>
                <div class="form-group row">
                    <div class="col-lg-4">
                        <a href="javascript:;"
                           class="btn btn-sm font-weight-bolder btn-light-primary data-repeater-create">
                            <i class="ki ki-plus icon-sm"></i>Añadir
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

