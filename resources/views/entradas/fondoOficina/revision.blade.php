@extends('layout.default')

@section('content')
<div >
	@if(count( $errors ) > 0)
	   @foreach ($errors->all() as $error)
		  <!-- Alert with image / icon -->
			<div class="alert alert-danger"> <img src="{{asset('xtreme-admin/assets/images/users/1.jpg')}}" width="30" class="rounded-circle" alt="img"> {{ $error }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
	  @endforeach
	@endif
</div>

<!-- begin::Subheader -->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Details-->
        <div class="d-flex align-items-center flex-wrap mr-2">
            <!--begin::Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Entradas</h5>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Fondo de Oficinas Centrales</span>
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
                <a  href="{{route('entradas.fondoOficinas.index')}}" class="btn btn-light-success font-weight-bold btn-sm px-4 font-size-base ml-2" >Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!-- end::Subheader -->

<!--begin::CARD-->
<div class="card card-custom">
	<div class="card-header">
  		<div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-chat-1 text-primary"></i>
            </span>
   			<h3 class="card-label">
    			Card Footer
    		<small>sub title</small>
   			</h3>
  		</div>
        <div class="card-toolbar">
            <a href="#" class="btn btn-sm btn-success font-weight-bold">
                <i class="flaticon2-cube"></i> Reports
            </a>
        </div>
 	</div>
 	<div class="card-body">
 		<form class="form">
 			<!--begin:: REVISION DOCUMENTAL -->
 			<div class="card-body">
  				<div class="form-group m-0">
  					<div class="row">
  						<div class="col-lg-6">
  							<h3>Revisión Documental:</h3>
  						</div>
  						<div class="col-lg-6">
  							<h3>Revisión Fisica:</h3>
  						</div>
  					</div><br>
   					
   					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Contrato y/o oficio de adjudicación
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Condiciones físicas de los articulos 
                				<span></span>
            				</label>
    					</div>
   					</div>

 					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Remisión y/o factura
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Embalaje de buen estado
                				<span></span>
            				</label>
    					</div>
   					</div>

					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Pedido
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Clave según catálogo de la secretaria
                				<span></span>
            				</label>
    					</div>
   					</div> 

					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Precio unitario correcto
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Descripción acorde a factura o remisión y contrato
                				<span></span>
            				</label>
    					</div>
   					</div>  

   					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Datos correctos de la factura / remisión coinciden con contrato
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Unidad de medida
                				<span></span>
            				</label>
    					</div>
   					</div>

					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Lotes identificados en la factura (por unidades)
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Cantidad
                				<span></span>
            				</label>
    					</div>
   					</div>

					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Certificado analítico por cada lote
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Lote de producción
                				<span></span>
            				</label>
    					</div>
   					</div>

					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Carta compromiso de Canje por caducidad
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Fecha de elaboración
                				<span></span>
            				</label>
    					</div>
   					</div>

					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Carta compromiso de canje por vicios ocultos
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Fecha de caducidad
                				<span></span>
            				</label>
    					</div>
   					</div>

					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Registro sanitario vigente o prorroga
                					<span></span>
            					</label>
     						</label>
    					</div>
    					<div class="col-lg-6">
     						<label class="checkbox">
                				<input type="checkbox" checked="checked"/>
                				Etiquete de idenitificación clave CNIS
                				<span></span>
            				</label>
    					</div>
   					</div>	

					<div class="row">
    					<div class="col-lg-6">
     						<label class="checked">
      							<label class="checkbox">
                					<input type="checkbox" checked="checked"/>
                					Modificación de contrato debidamente formalizado
                					<span></span>
            					</label>
     						</label>
    					</div>
   					</div>			  					
  				</div>
 			</div>
 <div class="card-footer">
  <button type="reset" class="btn btn-primary mr-2">Submit</button>
  <button type="reset" class="btn btn-secondary">Cancel</button>
 </div>
			<!-- end:: TERMINA TABLA DE REVISION DOCUMENTAL -->
 		</form>
 		

 	</div><br>
    <div class="card-footer d-flex justify-content-between">
        <a href="#" class="btn btn-light-primary font-weight-bold">Manage</a>
        <a href="#" class="btn btn-outline-secondary font-weight-bold">Learn more</a>
 	</div>
</div>
<!--end::CARD-->

@endsection