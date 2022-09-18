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
                         <h4 class="card-title">Catálogo Partidas especificas</h4>
                    </div>
                </div>
            </div>

			<div class="card-body">	
				<div class="row">
					<div class="col-md-12">
						<div class="tab-content">
		                    <div class="tab-pane active" role="tabpanel">
		                    	<div class="float-left mb-3">
									
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
		                                    <th>Clave elemento</th>
		                                    <th>Elemento</th>
		                                    <th>Estatus</th>
		                                    <th>Acciones</th>
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
	<input type="hidden" name="url" id="url" value="{{url('/partidas')}}">
	{{-- Scripts --}}
	@section('scripts')
	<script src="{{ asset('js/jquery-base64.js')}}" type="text/javascript"></script>
	<script src="{{ asset('js/dataTable/dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/catalogos/catalogos.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        tablaPartidas();
    </script>	
    @endsection
@endsection