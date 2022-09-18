{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<!--begin::Subheader-->
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
                    <span class="text-muted">Crear Pedido</span>
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


<div class="card card-custom">
 <div class="card-header">
  <h3 class="card-title">
  Pedidos - Elaborar nuevo pedido
  </h3>
  <h5 class="card-subtitle">&nbsp;</h5>
<div class="ml-auto d-flex no-block align-items-center">
 <a class="btn btn-light-info" href="{{ url('pedidosProgramacion/consultarPedidos') }}"> Consultar Pedido</a>
 </div>
 </div><br><br>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<form id="form_pedido" name="form_pedido">

						<div class="form-group">						
						<div class="row lg-3 justify-content-center">
						   <label for="staticEmail" class="col-sm-2 col-form-label">Fecha de envió de solicitud:</label>
						    <div class="col-md-5">
						      <input type="date" class="form-control" name="fec_env_sol" id="fec_env_sol"  value="<?php echo date("Y-m-d");?>">
						    </div>
						</div>


						<div class="form-group justify-content-center align-items-center">
			              <div class="form-row justify-content-center align-items-center">
			                @foreach($tipoSolicitudAbastecimiento as $tipo)
			                  <div class="form-check form-check-inline">	
			                    <label class="option">
			                        <span class="option-control">
				                        <span class="radio">
										    <input class="form-check-input" type="radio" name="tipo" id="tipo" value="{{$tipo->id}}" required="required" checked>
										 	<span></span>
				                     	</span>
			                     	</span>
				                    <span class="option-label">
				                     	<span class="option-head">
					                      <span class="option-title">{{$tipo->tipo_solicitud_abastecimiento}}</span>
				                       </span>
				                    </span>
			                    </label>
			                    @if($tipo->id == "O")
				                    {{--<div class="form-group col-sm-8 my-1 justify-content-center align-items-center">
				                      <select name="periodo" id="periodo" class="form-control">
				                        <option value='@php if(date("m") == 1) {$year = date("Y") - 1; echo ($year."-12-01");} else {$mes = date("m") - 1; echo (date("Y")."-".$mes."-01");} @endphp'>@php if (date("m") == 1) {$year = date("Y") - 1; echo ($year."-12-01");} else {$mes = date("m") - 1; echo (date("Y")."-".$mes."-01");} @endphp</option>
				                        <option value='@php echo (date("Y-m-01")); @endphp' selected >@php echo (date("Y-m-01")); @endphp</option>
				                        <option value='@php if (date("m") == 12) {$year = date("Y") + 1; echo ($year."-01-01");} else {$mes = date("m") + 1; echo (date("Y")."-".$mes."-01");} @endphp'>@php if (date("m") == 12) {$year = date("Y") + 1; echo ($year."-01-01");} else {$mes = date("m") + 1; echo (date("Y")."-".$mes."-01");} @endphp</option>
				                      </select>
				                    </div>--}}

				                    <div class="form-group col-sm-8 my-1 justify-content-center align-items-center">
				                      <select name="periodo" id="periodo" class="form-control">
				                        <option  value="">Periodo</option>
										@foreach($periodos as $periodo)
										<option value="{{$periodo->id}}"> {{$periodo->periodo}}</option>
										@endforeach
				                      </select>
				                    </div>
			                    @endif
			                  </div>
			                @endforeach
			              </div>
			            </div>

				{{--<div class="row lg-3 justify-content-center">
						  
				  <div class="col-sm-2">
                  <label class="option">
                  <span class="option-control">
                  <span class="radio">
                  <input type="radio" id ="inlineRadio1"name="inlineRadio1"  value="1" checked="checked"/>
                 <span></span>
                </span>
               </span>
                 <span class="option-label">
                   <span class="option-head">
                      <span class="option-title">
                               Ordinario
                      </span>
                       </span>
                        </span>
                         </label>
                          </div>
						  <div class="col-md-2">
						    <select name="periodo" id="periodo" class="form-control" >
							     <option value='@php if(date("m") == 1) {$year = date("Y") - 1; echo ($year."-12-01");} else {$mes = date("m") - 1; echo (date("Y")."-".$mes."-01");} @endphp'>@php if (date("m") == 1) {$year = date("Y") - 1; echo ($year."-12-01");} else {$mes = date("m") - 1; echo (date("Y")."-".$mes."-01");} @endphp</option>
							     <option value='@php echo (date("Y-m-01")); @endphp' selected >@php echo (date("Y-m-01")); @endphp</option>
							     <option value='@php if (date("m") == 12) {$year = date("Y") + 1; echo ($year."-01-01");} else {$mes = date("m") + 1; echo (date("Y")."-".$mes."-01");} @endphp'>@php if (date("m") == 12) {$year = date("Y") + 1; echo ($year."-01-01");} else {$mes = date("m") + 1; echo (date("Y")."-".$mes."-01");} @endphp</option>
						     </select>
						  </div>
					<div class="col-sm-3">
                     <label class="option">
                       <span class="option-control">
                       <span class="radio">
					    <input type="radio" id="inlineRadio2" name="inlineRadio1" />
					 <span></span>
                     </span>
                     </span>
                    <span class="option-label">
                     <span class="option-head">
                      <span class="option-title">
                               Extraordinario
                      </span>
                       </span>
                        </span>
                         </label>
                          </div>
						</div>--}}
  
						
						<div class="mb-3 row justify-content-center">
						    <label for="solicitar" class="col-sm-2 col-form-label">*Solicitar a:</label>
						    <div class="col-sm-5">
						      <select class="form-control" name="solicita" id="solicita" required >
						      	<option value="" >Seleccione una opción</option>
								@foreach($almacenes as $almacen)
								<option value="{{$almacen->id}}">{{$almacen->almacen}}</option>
								@endforeach
							</select>
						    </div>
						</div>
						<div class="mb-3 row justify-content-center">
						    <label for="partida" class="col-sm-2 col-form-label">*Unidad administrativa</label>
						    <div class="col-sm-5">
						      <select class="form-control" name="UnidadAdministrativa" id="UnidadAdministrativa" required>
								<option value="">Seleccione una opción</option>
								@foreach($unidadAdministrativa as $unidad)
								<option value="{{$unidad->id}}"> {{$unidad->unidad_admin}}</option>
								@endforeach
								</select>
						    </div>
						</div>
                  
						<div class="mb-3 row justify-content-center">
						    <label for="inputPassword" class="col-sm-2 col-form-label">*Responsable de la solicitud:</label>
						    <div class="col-sm-5">
						      <input type="text" class="form-control" id="responsable" required ="required">
						    </div>
						</div>
						<div class="mb-3 row justify-content-center">
						    <label for="partida" class="col-sm-2 col-form-label">*Cargo</label>
						    <div class="col-sm-5">
						      <select class="form-control" name="Cargo" id="Cargo" required>
								<option value="">Seleccione una opción</option>
							  </select>
						    </div>
						</div>

						<div class="mb-3 row justify-content-center">
						   <label for="staticEmail" id="observaciones" class="col-sm-2 col-form-label" >Observaciones:</label>
						    <div class="col-sm-5">
						       <input type="text" class="form-control" name="observaciones" id="observaciones">
						    </div>
						</div>
						<div class="mb-3 row justify-content-center">* Datos obligatorios </div>
						
			  		</div>
		   		</form>
		   		<div class="card-footer">
	                        <div class="col-lg-12 text-lg-right">
	                        	{{--<a href="javascript:crearPedido();" type="submit" class="btn btn-primary nextBtnW">Crear Pedido</a>--}}

	                        	 <input type="submit" class="btn btn-primary nextBtnW"value="Crear Pedido"  onclick="crearPedido();" >
	                        	

							</div>	   
            			</div>
	      	</div> 
	   </div>
	</div>
</div>
<input type="hidden" name="url" id="url" value="{{url('/')}}">
@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{URL::asset('js/pedidos/crear_pedido.js')}}" type="text/javascript"></script>



@endsection