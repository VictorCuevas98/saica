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
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Administrativo</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Catálogos</span>
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
            <a href="{{ url('/admin') }}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!--end::Subheader-->

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
                <div class="card-toolbar">
                    <div class="float-left">
                         <h4 class="card-title">Catálogo Artículos</h4>
                    </div>
                </div>
            </div>

			<div class="card-body">	
				<div class="row">
					<div class="col-md-12">
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel">
		                        <div class="form-row mb-3 justify-content-end mr-0">
		                        	<a href="javascript:void(0);" onclick="add_articulo_modal();" class="btn btn-light-primary"><i class="fas fa-plus-square"></i>Agregar registro</a>   
			                    </div>

				                <form action="{{ url('articulos/catalogoArticulos') }}" method="GET">
				                    <div class="form-row mb-3 justify-content-end">
				                    	<label class="align-self-center">Buscar:</label>
				                        <div class="col-auto">
				                           <input type="text" class="form-control" id="busqueda" name="busqueda" aria-describedby="basic-addon2">
				                        </div>
				                                            
				                    </div>
				                </form>
		   	
		                        <div class="table-responsive">
		                            <table class="table table-striped- table-bordered table-hover table-checkable table-responsive-sm" id="tablaCatalogoArticulos">
		                                <thead>
		                                <tr>
		                                    <th>Clave artículo</th>
		                                    <th>Descripción artículo</th>
		                                    <th>CABMS</th>
		                                    <th>Clave partida</th>
		                                    <th>Partida</th>
		                                    <th>Unidad de medida</th>
		                                    <th>Estatus</th>
		                                    <th>Acciones</th>
		                                </tr>
		                                </thead>
		                        @if(count($articulos)>0)
				                    @foreach($articulos as $articulo) 
				                        <tr>
				                          <td align="center"> {{ $articulo->clave_artmed }} <input type="hidden" class="form-control" id="artmed" name="artmed"></td>
				                          <td align="justify">{{ $articulo->artmed }}</td>
				                          <td align="center">{{ $articulo->clave_cabms }}</td>
				                          <td align="center">{{ $articulo->clave_partida }}</td>
				                          <td align="center">{{ $articulo->partida }}</td>
				                          <td align="center">{{ $articulo->unidad_medida }}</td>

				                          <td>
								            @if($articulo->activo == false)
								            	<span class="badge badge-danger badge-inline">{{ ($articulo->activo == 0) ? 'Inactivo' : ''}}</span>
								            @else
								            	<span class="badge badge-success badge-inline">{{ ($articulo->activo != 0) ? 'Activo' : ''}}</span>
								            @endif
								          </td>
				                          <td align="center">
				                            <a class="btn btn-clean btn-icon" title="Editar" onClick="edit_articulo_modal({{$articulo->id}});" href="javascript:void(0)"><i class="far fa-edit"></i></a>
				                          </td>
				                        </tr>             
				                    @endforeach 
				                @else 
				                	<td align="justify" colspan="8">No se encuentran resultados</td>
								@endif
		                            </table>
		                        </div>
		                    </div>                    
		                </div>    
					</div>

					<div class="col-md-12 col-sm-6">
					 {{ $articulos->onEachSide(5)->links() }}
					</div >
				</div>
			</div>
			<div class="card-footer">
                
            </div>
		</div>
	</div>
</div>
	<input type="hidden" name="url" id="url" value="{{url('/articulos')}}">
	{{-- Scripts --}}
	@section('scripts')
    <script src="{{ asset('js/catalogos/catalogos.js') }}" type="text/javascript"></script>
    @endsection
@endsection