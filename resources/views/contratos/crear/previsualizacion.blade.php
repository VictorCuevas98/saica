@extends('contratos.crear.registro_layout')
@section('contrato')

    <div class="content-wizard" id="tk_tab_wiz_3">
        <input type="text" id="id_contrato_previzualizacion" value="{{$id ?? ''}}" hidden>
        <div class="row justify-content-center py-8 px-8 px-md-0">
            <div class="col-md-11">
                <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                    <h1 class="display-4 font-weight-boldest mb-10">CONTRATO</h1>
                    <div class="d-flex px-0 align-items-start">
                        <!--begin::Logo-->
                        <a href="#" class="mb-5">
                            <img src="" alt="">
                        </a>
                        <!--end::Logo-->
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">DAT0S DEL PROVEEDOR</th>
                            </tr>
                            </thead>
                            @if(isset($proveedor))
                                <tbody>
                                <tr>
                                    <td>RFC: {{$proveedor->rfc ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Tipo persona: {{$proveedor->tipo_persona ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Razón Social: {{$proveedor->razon_social ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Representante Legal: {{$proveedor->representante_legal ?? ''}}</td>
                                </tr>
                                </tbody>
                            @endif
                        </table>


                        <!--<span class="d-flex flex-column align-items-md-end opacity-70">
                            <span class="font-weight-bolder mb-2">PROVEEDOR</span>
                            <span>Dr. Lavista 144, Doctores, Cuauhtémoc, 06720 Cuauhtemoc, CDMX</span>
                            <span>Tel: 55 5588 3388</span>
                            <span>Fax: 55 5588 3388</span>
                            <span>nsalgado@finanzas.cdmx.gob.mx</span>
                        </span>-->
                    </div>
                    <div class="d-flex align-items-start px-0 ">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">DATOS DEL CONTRATO</th>
                            </tr>
                            </thead>
                            @if(isset($contrato))
                                <tbody>
                                <tr>
                                    <td>Fecha: {{$contrato->fecha_contrato}}</td>
                                </tr>
                                <tr>
                                    <td>Número de contrato: {{$contrato->num_contrato}}</td>
                                </tr>
                                <tr>
                                    <td>Fundamento Legal:
                                        @foreach($contrato->fundamentos_legales as $fundamento)
                                            {{$fundamento->fundamento_legal}} |
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>

                    <div class="d-flex align-items-start px-0 ">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">DATOS DE LA ADQUISICIÓN</th>
                            </tr>
                            </thead>
                            @if(isset($adquisicion))
                                <tbody>
                                <tr>
                                    <td>Núm. Oficio de Adjudicación: {{$adquisicion->num_oficio_adjudicacion ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Núm Requisición: {{$adquisicion->num_requisicion ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Origen de Recurso: {{$adquisicion->origen_recurso->origen_recurso ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Núm. Licitacion: {{$adquisicion->licitacion->num_licitacion ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Unidad Consolidadora: {{$adquisicion->licitacion->unidad_consolidadora->unidad_consolidadora ?? ''}}</td>
                                </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="border-bottom w-100"></div>
                @if($cerrado)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">PARTIDA</th>
                            <th scope="col">CODIGO | DESCRIPCION DE LOS BIENES</th>
                            <th scope="col">UNIDAD DE MEDIDA</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">PRECIO UNITARIO</th>
                            <th scope="col">PRECIO TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($articulos))
                            @foreach($articulos as $articulo)
                                <tr>
                                    <td>{{$articulo->partida}}</td>

                                    <td>{{$articulo->artmed->clave_artmed}} | {{$articulo->artmed->artmed}}</td>

                                    <td>{{$articulo->artmed->unidad_medida}}</td>

                                    <td>{{$articulo->cantidad_unidades}}</td>

                                    <td>{{$articulo->monto_unitario}}</td>

                                    <td>{{$articulo->monto_subtotal}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if(isset($importe))
                        <div class="border-bottom w-100"></div>
                    <div class="d-flex flex-row-reverse">
                        <table class="table max-w-lg-350px">
                            <thead>
                            <tr>
                                <th scope="col">SUBTOTAL</th>
                                <th scope="col">I.V.A</th>
                                <th scope="col">TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$importe->monto_subtotal ?? ''}}</td>

                                <td>{{$importe->monto_impuesto ?? ''}}</td>

                                <td>{{$importe->monto_total ?? ''}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                @endif

                @if($abierto)

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">PARTIDA</th>
                            <th scope="col">CODIGO | DESCRIPCION DE LOS BIENES</th>
                            <th scope="col">UNIDAD DE MEDIDA</th>
                            <th scope="col">CANTIDAD MINIMA</th>
                            <th scope="col">CANTIDAD MAXIMA</th>
                            <th scope="col">PRECIO UNITARIO</th>
                            <th scope="col">PRECIO TOTAL MINIMO</th>
                            <th scope="col">PRECIO TOTAL MAXIMO</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($articulos))
                            @foreach($articulos as $articulo)
                                <tr>
                                    <td>{{$articulo->partida}}</td>

                                    <td>{{$articulo->artmed->clave_artmed}} | {{$articulo->artmed->artmed}}</td>

                                    <td>{{$articulo->artmed->unidad_medida}}</td>

                                    <td>{{$articulo->cantidad_unidades_minima}}</td>

                                    <td>{{$articulo->cantidad_unidades_maxima}}</td>

                                    <td>{{$articulo->monto_unitario_fijo}}</td>

                                    <td>{{$importe->monto_total_minimo}}</td>

                                    <td>{{$importe->monto_total_maximo}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    @if(isset($importe))
                        <div class="border-bottom w-100"></div>
                        <div class="d-flex flex-row-reverse">
                            <table class="table max-w-lg-450px">
                                <thead>
                                <tr>
                                    <th scope="col">SUBTOTAL MINIMO</th>
                                    <th scope="col">I.V.A MINIMO</th>
                                    <th scope="col">TOTAL MINIMO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$importe->monto_subtotal_minimo ?? ''}}</td>

                                    <td>{{$importe->monto_impuesto_minimo ?? ''}}</td>

                                    <td>{{$importe->monto_total_minimo ?? ''}}</td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex flex-row-reverse">
                            <table class="table max-w-lg-450px">
                                <thead>
                                <tr>
                                    <th scope="col">SUBTOTAL MAXIMO</th>
                                    <th scope="col">I.V.A MAXIMO</th>
                                    <th scope="col">TOTAL MAXIMO</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$importe->monto_subtotal_maximo ?? ''}}</td>

                                    <td>{{$importe->monto_impuesto_maximo ?? ''}}</td>

                                    <td>{{$importe->monto_total_maximo ?? ''}}</td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                @endif
            @endif
            <!--
                <div class="d-flex justify-content-between pt-6">
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">FECHA</span>
                        <span class="opacity-70">Dec 12, 2017</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">REMISIÓN NO.</span>
                        <span class="opacity-70">GS 000014</span>
                    </div>
                    <div class="d-flex flex-column flex-root">
                        <span class="font-weight-bolder mb-2">ENTREGADA EN.</span>
                        <span class="opacity-70">Almacen central de la secretaria de salud
                                                        <br>Av. Jardin 356, Col del Gas, Azcapotzalco, 02970 Ciudad de México, CDMX</span>
                    </div>
                </div>
                -->
            </div>


            <div class="col-md-9 mt-10">
                <span class="font-weight-bolder mb-2">OBSERVACIONES</span>
                <div class="border-bottom w-100"></div>
                <p class="text-justify">
                    {{$contrato->observaciones ?? ''}}
                </p>
            </div>


        </div>
        <div class="modal-footer">
            <a id="btn-wiz-3-back" class="btn btn-default backBtnW">Regresar</a>
            <input type="button" id="btn-wiz-3" class="btn btn-success nextBtnW" value="Guardar">
        </div>
    </div>

@endsection
