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
            <a href="{{ url('/') }}" class="btn btn-light-success font-weight-bold btn-sm px-4 font-size-base ml-2">Regresar</a>
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
                         <h4 class="card-title">Catálogo</h4>
                    </div>
                    <div class="float-right">
                        <div class="d-grid gap-2 d-md-block">
                          <div class="btn-group dropleft">
							    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="dropdownMenuButton" role="button">
							        Lista de Catálogos
							    </button>
							    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
								    <ul class="nav nav-hover flex-column">
									    <li class="nav-item">
									       <a href="#kt_tabs_7_1" class="nav-link" role="tab" data-toggle="tab">
									        <span class="nav-text">Artículos</span>
									       </a>
									     </li>
								      	<li class="nav-item">
									       <a href="#kt_tabs_7_2" class="nav-link" role="tab" data-toggle="tab">
									        <span class="nav-text">CABMS</span>
									       </a>
								      	</li>
								      	<li class="nav-item">
									       <a href="#kt_tabs_7_3" class="nav-link" role="tab" data-toggle="tab">
									        <span class="nav-text">Partidas especificas</span>
									       </a>
								      	</li>
								      	<li class="nav-item">
									       <a href="#kt_tabs_7_4" class="nav-link" role="tab" data-toggle="tab">
									        <span class="nav-text">Proveedores</span>
									       </a>
								      	</li>
								      	<li class="nav-item">
									       <a href="#kt_tabs_7_5" class="nav-link" role="tab" data-toggle="tab">
									        <span class="nav-text">Laboratorios</span>
									       </a>
								      	</li>
								      	<li class="nav-item">
									       <a href="#kt_tabs_7_6" class="nav-link" role="tab" data-toggle="tab">
									        <span class="nav-text">Almacenes</span>
									       </a>
								      	</li>
								      	<li class="nav-item">
									       <a href="#kt_tabs_7_7" class="nav-link" role="tab" data-toggle="tab">
									        <span class="nav-text">Preguntas revisión entrada</span>
									       </a>
								      	</li>
								      	<li class="nav-item">
									       <a href="#kt_tabs_7_8" class="nav-link" role="tab" data-toggle="tab">
									        <span class="nav-text">Unidades Consolidadoras</span>
									       </a>
								      	</li>
								    </ul>
							    </div>
						   </div>
                        </div>
                    </div>
                </div>
            </div>

			<div class="card-body">	
				<div class="row">
					<div class="col-md-12">
						<div class="tab-content">
							<div class="tab-pane active" id="kt_tabs_7_1" role="tabpanel">
								<div class="float-left mb-3">
									<h5 class="card-subtitle">Artículos</h5>
								</div>
		                        <div class="float-right mb-3">
		                            <a href="javascript:void(0);" onclick="add_articulo_modal();" class="btn btn-light-primary"><i class="fas fa-plus-square"></i>Agregar registro</a>
		                        </div>
		                        <br>
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
		                                    <th>Editar</th>
		                                </tr>
		                                </thead>
		                            </table>
		                        </div>
		                    </div>

		                    <div class="tab-pane" id="kt_tabs_7_2" role="tabpanel">
		                    	<div class="float-left mb-3">
									<h5 class="card-subtitle">CABMS</h5>
								</div>
		                        <div class="float-right mb-3">
		                            <a href="javascript:void(0);" onclick="add_cabms_modal();" class="btn btn-light-primary btn-elevate btn-icon-sm"><i class="fas fa-plus-square"></i>Agregar registro</a>
		                        </div>
		                        <br>
		                        <div class="table-responsive">
		                            <table class="table table-striped- table-bordered table-hover table-checkable" id="tablaCatalogoCabms">
		                                <thead>
		                                <tr>
		                                    <th>Clave cabms</th>
		                                    <th>Descripción CABMS</th>
		                                    <th>Partida</th>
		                                    <th>Unidad de medida</th>
		                                    <th>Estatus</th>
		                                    <th>Editar</th>
		                                </tr>
		                                </thead>
		                            </table>
		                        </div>
		                    </div>

		                    <div class="tab-pane" id="kt_tabs_7_3" role="tabpanel">
		                    	<div class="float-left mb-3">
									<h5 class="card-subtitle">Partidas especificas</h5>
								</div>
		                        <div class="float-right mb-3">
		                            <a href="javascript:void(0);" onclick="add_partidas_modal();" class="btn btn-light-primary btn-elevate btn-icon-sm"><i class="fas fa-plus-square"></i>Agregar registro</a>
		                        </div>
		                        <br>
		                        <div class="table-responsive">
		                            <table class="table table-striped- table-bordered table-hover table-checkable" id="tablaCatalogoPartidasCabms">
		                                <thead>
		                                <tr>
		                                    <th>Clave partida</th>
		                                    <th>Partida</th>
		                                    <th>Elemento</th>
		                                    <th>Estatus</th>
		                                    <th>Editar</th>
		                                </tr>
		                                </thead>
		                            </table>
		                        </div>
		                    </div>

		                    <div class="tab-pane" id="kt_tabs_7_4" role="tabpanel">
								<div class="float-left mb-3">
									<h5 class="card-subtitle">Proveedores</h5>
								</div>
							    <div class="float-right mb-3">
							        <a href="javascript:void(0);" onclick="add_proveedor_modal();" class="btn btn-light-primary btn-elevate btn-icon-sm"><i class="fas fa-plus-square"></i>Agregar registro</a>
							    </div>
							    <br>
							    <div class="table-responsive">
							        <table class="table table-striped- table-bordered table-hover table-checkable" id="tablaCatalogoProveedores">
							            <thead>
							            <tr>
							                <th>RFC</th>
							                <th>Tipo persona</th>
							                <th>Nombre</th>
							                <th>Apellido Paterno</th>
							                <th>Apellido Materno</th>
							                <th>Razón social</th>
							                <th>Representante Legal</th>
							                <th>Estatus</th>
							                <th>Editar</th>
							            </tr>
							            </thead>
							        </table>
							    </div>
							</div>

							<div class="tab-pane" id="kt_tabs_7_5" role="tabpanel">
								<div class="float-left mb-3">
									<h5 class="card-subtitle">Laboratorios</h5>
								</div>
							    <div class="float-right mb-3">
							        <a href="javascript:void(0);" onclick="add_laboratorio_modal();" class="btn btn-light-primary btn-elevate btn-icon-sm"><i class="fas fa-plus-square"></i>Agregar registro</a>
							    </div>
							    <br>
							    <div class="table-responsive">
							        <table class="table table-striped- table-bordered table-hover table-checkable" id="tablaCatalogoLaboratorios">
							            <thead>
							            <tr>
							                <th>Clave laboratorio</th>
							                <th>Nombre laboratorio</th>
							                <th>Estatus</th>
							                <th>Editar</th>
							            </tr>
							            </thead>
							        </table>
							    </div>
							</div>

							<div class="tab-pane" id="kt_tabs_7_6" role="tabpanel">
								<div class="float-left mb-3">
									<h5 class="card-subtitle">Almacenes</h5>
								</div>
							    <div class="float-right mb-3">
							        <a href="javascript:void(0);" onclick="add_almacen_modal();" class="btn btn-light-primary btn-elevate btn-icon-sm"><i class="fas fa-plus-square"></i>Agregar registro</a>
							    </div>
							    <br>
							    <div class="table-responsive">
							        <table class="table table-striped- table-bordered table-hover table-checkable" id="tablaCatalogoAlmacenes">
							            <thead>
							            <tr>
							                <th>Clave almacén</th>
							                <th>Nombre almacén</th>
							                <th>Calle</th>
							                <th>Número exterior</th>
							                <th>Número interior</th>
							                <th>Colonia</th>
							                <th>Estatus</th>
							                <th>Editar</th>
							            </tr>
							            </thead>
							        </table>
							    </div>
							</div>

							<div class="tab-pane" id="kt_tabs_7_7" role="tabpanel">
								<div class="float-left mb-3">
									<h5 class="card-subtitle">Preguntas revision entradas</h5>
								</div>
							    <div class="float-right mb-3">
							        <a href="javascript:void(0);" onclick="add_pregunta_modal();" class="btn btn-light-primary btn-elevate btn-icon-sm"><i class="fas fa-plus-square"></i>Agregar registro</a>
							    </div>
							    <br>
							    <div class="table-responsive">
							        <table class="table table-striped- table-bordered table-hover table-checkable" id="tablaCatalogoPreguntasRevision">
							            <thead>
							            <tr>
							                <th>Clave pregunta</th>
							                <th>Pregunta</th>
							                <th>Tipo revisión</th>
							                <th>Estatus</th>
							                <th>Editar</th>
							            </tr>
							            </thead>
							        </table>
							    </div>
							</div>

							<div class="tab-pane" id="kt_tabs_7_8" role="tabpanel">
								<div class="float-left mb-3">
									<h5 class="card-subtitle">Unidades Consolidadoras</h5>
								</div>
							    <div class="float-right mb-3">
							        <a href="javascript:void(0);" onclick="add_unidad_modal();" class="btn btn-light-primary btn-elevate btn-icon-sm"><i class="fas fa-plus-square"></i>Agregar registro</a>
							    </div>
							    <br>
							    <div class="table-responsive">
							        <table class="table table-striped- table-bordered table-hover table-checkable" id="tablaCatalogoUnidadConsolidadora">
							            <thead>
							            <tr>
							                <th>Clave unidad consolidadora</th>
							                <th>Unidad Consolidadora</th>
							                <th>Orden gobierno</th>
							                <th>Estatus</th>
							                <th>Editar</th>
							            </tr>
							            </thead>
							        </table>
							    </div>
							</div>

		                </div>    
					</div>
					<div class="col-md-12 col-sm-6">
					</div >
				</div>
			</div>
			<div class="card-footer">
                
            </div>
		</div>
	</div>
</div>
	{{-- Scripts --}}
	@section('scripts')
	<script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/catalogos/catalogos.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/catalogos/proveedores.js') }}" type="text/javascript"></script>	
    @endsection
@endsection