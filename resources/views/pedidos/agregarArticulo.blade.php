@extends('layout.default')
@section('content')

<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Pedidos</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Mis Pedidos</span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Crear Pedidos</span>
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
            <a href="{{ url('/pedidosProgramacion') }}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->


<div class="row ">
    <div class="col-4">
        <div class="card">

            <div class="card-header">
                <div class="card-toolbar">
                    <div class="float-left">
                         <h3 class="card-title">Agregar Artículo(s) </h3>
                    </div>
                    <div class="float-left">
                            <label for="Folio">Folio:</label>
                            
                                <p>{{$folio->num_solicitud_abastecimiento}}  </p> 
                                
                        </div>
                    <div class="float-right">
                        <div class="">
                          <button id="btn-modal-search-artmed" class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            


            <div class="card-body">
                
                <div class="">
                    
                    <table class="table table-borderless">
                    <form class="form-horizontal" id="articulo" method="post" >
                        @csrf   
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <input  class="form-control"type="text" name="clave" id="clave" placeholder="Clave del Artículo" readonly />
                                    <input type="hidden" name="id_artmed" id="id_artmed">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input  class="form-control"type="number"  onkeypress="comprueba(this)" min="1" pattern="^[0-9]+" name="cantidad" id="cantidad" placeholder="Cantidad a solicitar"/></td>
                            </tr>
                            <tr>
                                <td colspan="2"><textarea class="col-md-12  form-control" id="descripcion"name="descripcion" placeholder="Descripción" readonly ></textarea></td>
                            </tr>
                             <tr>
                                <td colspan="2"><textarea class="col-md-12  form-control" id="observaciones"name="observaciones" placeholder="Observaciones"></textarea></td>
                            </tr>
                        </tbody>
                        
                    </form>
                    </table>     
                </div>           
            </div>
            <div class="card-footer">
                <div class="row">

                    <div class="col-md-6">
                        <a class="btn btn-sm btn-secondary btn-block" id="kt_reset">Cancelar</a>
                    </div>
                    <div class="col-md-6">
                        <button  class="btn btn-sm btn-success btn-block"  onclick="validar();">Agregar</button>
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <div class="card-toolbar">
                    <div class="float-left">
                         <h3 class="card-title">Artículos Agregados</h3>
                    </div>
                    <div class="float-right">
                        <div class="d-grid gap-2 d-md-block">
                          <a href="#" data-toggle="modal" data-target="#myModalFormato"class="btn btn-primary"><i class="far fa-file-pdf"></i>Generar formato</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">        
                    {{--<form method="post" action="">--}}
                       
                        <table class="table table-bordered table-striped" id="Articulos">
                            <thead>
                                <tr>
                                    <th>CLAVE</th>
                                    <th>CANTIDAD SOLICITADA</th>
                                    <th>DESCRIPCIÓN</th>
                                    <th>ACCIONES</th>

                                </tr>
                            </thead>
                            {{--<tbody>   
                                <tr>
                                    <td>103</td>
                                    <td>100</td>
                                    <td>TEST</td>
                                    <td>
                                       <button style="border: none; width: 34px;" data-toggle="modal"data-target="#exampleModal"class="btn btn-sm btn-clean btn-icon" title="Editar" ><i class="far fa-edit"></i></button>
                                       <button style="border: none; width: 34px;" type="submit"
                                        onclick="return confirm_elimination()"class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="far fa-trash-alt "></i></button>
                                        <form action="{{url('/empleado/'.$empleado->id)}}" method="post" class="d-inline eliminar">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <input type="submit"  class=" btn bg-danger" value="borrar">
                                    
                                    


                                </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>104</td>
                                    <td>110</td>
                                    <td>TEST</td>
                                    <td>
                                        <button style="border: none; width: 34px;" data-toggle="modal"data-target="#exampleModal"class="btn btn-sm btn-clean btn-icon" title="Editar" ><i class="far fa-edit"></i></button>
                                        <button style="border: none; width: 34px;" type="submit"
                                        onclick="return confirm_elimination()"class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="far fa-trash-alt "></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>105</td>
                                    <td>50</td>
                                    <td>TEST</td>
                                    <td>
                                        <button style="border: none; width: 34px;" data-toggle="modal"data-target="#exampleModal"class="btn btn-sm btn-clean btn-icon" title="Editar" ><i class="far fa-edit"></i></button>
                                        <button style="border: none; width: 34px;" type="submit"
                                        onclick="return confirm_elimination()"class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="far fa-trash-alt "></i></button>
                                    </td>
                                </tr>       
                            </tbody>--}}
                        </table>
                            
                    {{--</form>--}}
                </div>
            </div>
            <div class="card-footer">
                
            </div>
           @include('pedidos.modals.modificarPedidoModal')
        </div>
    </div>
</div>
<input type="hidden" name="url" id="url" value="{{url('/')}}">
  @include('pedidos.modals.formatoPedidoModal')
@endsection

@section('scripts') 
        <script src="{{ URL::asset('js/pedidos/agregar_Articulos.js')}}" type="text/javascript"></script>
        <script src="{{ asset('js/pedidos/aticulos.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>
        <script type="text/javascript">
            //tableDatos();
            
            $("#btn-modal-search-artmed").on('click',function(a){
                getSearchModal(function(element){
                    //AQUI VA EL CODIGO DE LA ACCION DESPUES DE DARLE CLIC A UN ARTICULO 
                    //AQUI NOS REGRESA UN OBJETO QUE SE PEUDE OCUPAR
                    console.log(element);
                    $('#id_artmed').val(element.id);
                    $("#clave").val(element.clave);
                    $("#descripcion").val(element.artmed);
                });
            });
        </script>
        <!--begin::Page Vendors(used by this page)-->
        <!--<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>-->
        <!--<script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>-->
        <!--begin::Page Scripts(used by this page)-->
        <script src="{{asset('js/cat_artmed/cat_artmed.js')}}"></script>
        <!--end::Page Scripts-->



    @endsection
   