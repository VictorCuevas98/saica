@extends('layout.default')
@section('content')

@include('pedidos-proveedor.modales.modal-cantidad-precio')
<button id="btn-open-modal" style="display: none;" type="button" class="btn" data-toggle="modal" data-target="#cantidad-precio-modal"></button>
<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Pedidos a Proveedor</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->

            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted font-weight-bold">Contrato:</span>
                    &nbsp;
                    <span class="text-muted">{{ $contrato->num_contrato }} </span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted font-weight-bold">Folio pedido:</span>
                    &nbsp;
                    <span class="text-muted">{{ $pedido->folio_pedido }} </span>
                </li>
            </ul>
            <!--end::Breadcrumb-->
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
        </div>
        <!--end::Details-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Button-->
            <a href="{{ url('/pedidos-proveedor') }}"
                class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon svg-icon menu-icon">
                        <!-- svg icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                    fill="#000000" opacity="0.3"></path>
                                <path
                                    d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                    fill="#000000"></path>
                                <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"></rect>
                                <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"></rect>
                            </g>
                        </svg>
                        <!-- svg icon end -->
                    </span>
                    <h3 class="card-label">Artículos en el pedido</h3>
                </div>
                <div class="d-flex align-items-center float-right">

                </div>
            </div>
            <div class="card-body">
                <!-- inicio: Formulario de busqueda -->
                <form class="kt-form kt-form--fit mb-15">
                    <div style="display: none;" class="row mb-6">
                        <div class="col-lg-3 mb-lg-0 mb-6">
                            <label>Fecha:</label>
                            <input type="text" class="form-control datatable-input"
                                id="pedidoId" value="{{ $pedido->getHashid() }}">
                        </div>
                    </div>
                    
                    <div id="buscaDiv" class="row mt-8">
                        @if ($pedido->getCurrentClaveEtapa() == "PRO")
                            <div class="col-lg-12">
                                <a class="btn btn-primary btn-primary--icon" onclick="buscaModalArtmed()"
                                    id="kt_search_contratos">
                                    <span>
                                        <i class=""></i>
                                        <span>Buscar artículo</span>
                                    </span>
                                </a>&nbsp;&nbsp;
                            </div>
                        @endif
                    </div>
                    
                </form>
                <!--BEGIN: TABLA ARTICULOS-->
                <div>
                    <div class="col-md-12">
                        <table class="table table-striped table-checkable" id="tabla-articulos">
                            <thead>
                                <tr>
                                    <th class="text-center">CLAVE</th>
                                    <th class="text-center">ARTÍCULO</th>
                                    <th class="text-center">CANTIDAD</th>
                                    <th class="text-center">ALMACÉN</th>
                                    {{--  <th class="text-center">PRECIO</th>--}}
                                    <th class="text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody id="tbody-productos">
                                @php
                                $articulos = [];
                                 @endphp
                                @foreach ($pedido->detalles as $detalle)
                                @php
                                    $currentArt = App\CatArtmed::where('id','=',$detalle->id_artmed)->first();
                                    array_push($articulos, [
                                        'artmed'=> $currentArt->artmed,
                                        'clave_artmed'=> $currentArt->clave_artmed,
                                        'id' => $currentArt->id,
                                        'unidad_medida'=> $currentArt->unidad_medida,
                                        'cantidad'=> (int)$detalle->cantidad_unidades,
                                        'precio' => App\ContratoAbiertoDetalle::where('id','=', $pedido->id_contrato_abierto)->where('id_artmed','=',$currentArt->id)->first()->monto_unitario_fijo,
                                        'id_almacen' => (int)$detalle->id_almacen
                                    ]);
                                @endphp
                                <tr id="articulo-{{ $currentArt->clave_artmed }}">
                                    <td class="text-center">{{ $currentArt->clave_artmed }}</td>
                                    <td class="text-center">{{ $currentArt->artmed }}</td>
                                    <td id="articulo-{{ $currentArt->clave_artmed  }}-cantidad" class="text-center">{{ $detalle->cantidad_unidades }}</td>
                                    <td id="articulo-{{ $currentArt->clave_artmed  }}-almacen" class="text-center"> {{App\CatAlmacen::where('id','=', $detalle->id_almacen)->first()->almacen }}</td>
                                    {{--  <td id="articulo-{{ $currentArt->clave_artmed  }}-precio" class="text-center">{{ App\ContratoAbiertoDetalle::where('id','=', $pedido->id_contrato_abierto)->where('id_artmed','=',$currentArt->id)->first()->monto_unitario_fijo }}</td>--}}
                                    <td class="text-center">
                                        @if ($pedido->getCurrentClaveEtapa() == "PRO")
                                            <button title="editar" class="btn btn-sm btn-clean btn-icon" onclick="editArticle('{{ $currentArt->getHashid() }}','{{ $detalle->cantidad_unidades }}','{{ $currentArt->clave_artmed }}')"><i class="fas fa-edit"></i></button>
                                            <button title="eliminar" type="submit" class="btn btn-sm btn-clean btn-icon" onclick="deleteRow('{{ $currentArt->clave_artmed }}')"><i class="far fa-trash-alt"></i></button>
                                        @endif
                                        {{--  <a class="btn btn-icon btn-light-warning" onclick="editArticle('{{ $currentArt->getHashid() }}','{{ $detalle->cantidad_unidades }}')"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-icon btn-light-danger"" onclick="deleteRow('{{ $currentArt->clave_artmed }}')"><i class="fa fa-trash"></i></a>
                                        --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>    
                    </div>
                   
                </div>
                <!--END: TABLA ARTICULOS-->
            </div>
            <div class="card-footer">
                <div id="footerDiv" class="float-right d-flex align-items-center">
                    @if ($pedido->getCurrentClaveEtapa() == "PRO")
                        <button onclick="finalizaPedido()" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Finalizar pedido</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript">
</script>

<script src="{{URL::asset('js/pedidos-proveedor/articles-edit.js')}}" type="text/javascript"></script>
<script src="{{asset('js/cat_artmed/cat_artmed.js')}}"></script>
<script type="text/javascript" src="{{asset('js/proveedores/proveedores.js')}}">
</script>

<script type="text/javascript">
    var articulos =  @json($articulos);
    var almacenes = @json($almacenes);
</script>
@endsection
@endsection
