@php
	$direction = config('layout.extras.user.offcanvas.direction', 'right');
@endphp
 {{-- User Panel --}}
<div id="kt_quick_user" class="offcanvas offcanvas-{{ $direction }} p-10">
	{{-- Header --}}
	<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
		<h3 class="font-weight-bold m-0">
			Perfil de usuario
		</h3>
		<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
			<i class="ki ki-close icon-xs text-muted"></i>
		</a>
	</div>

	{{-- Content --}}
    <div class="offcanvas-content pr-5 mr-n5">
		{{-- Header --}}
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
				<div class="symbol-label" style="background-image:url('{{ asset('media/users/blank.png') }}')">
				
				</div>
				
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
				{{Auth::user()->persona->nombre}}
				</a>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
								{{ Metronic::getSVG("media/svg/icons/Communication/Mail-notification.svg", "svg-icon-lg svg-icon-primary") }}
							</span>
                            <span id="emailGeneralUsuario" class="navi-text text-muted text-hover-primary">{{Auth::user()->persona->email}}</span>
							<input id="rfcUnicoUser" type="hidden" value="{{Auth::user()->persona->rfc}}">
                        </span>
                    </a>
                </div>
            </div>
        </div>

		{{-- Separator --}}
		<div class="separator separator-dashed mt-8 mb-5"></div>

		{{-- Nav --}}
		<div class="navi navi-spacer-x-0 p-0">
		{{--@role('ADMIN|REPRESENTANTE') --}}	
			{{-- Item --}}
		    {{--<a href="{{url('datosFiscales')}}" class="navi-item">
		        <div class="navi-link">
		            <div class="symbol symbol-40 bg-light mr-3">
		                <div class="symbol-label">
							{{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-success") }}
						</div>
		            </div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    Mis Datos Fiscales
		                </div>
		                
		            </div>
		        </div>
			</a>
			@endrole --}}
			{{-- Item --}}
		    {{-- <a href="{{url('documentosPersona')}}" class="navi-item">
		        <div class="navi-link">
		            <div class="symbol symbol-40 bg-light mr-3">
		                <div class="symbol-label">
							{{ Metronic::getSVG("media/svg/icons/Files/Folder-plus.svg", "svg-icon-md svg-icon-warning") }}
						</div>
		            </div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    Mis Documentos
		                </div>
		                
		            </div>
		        </div>
			</a> --}}


			@role('PONENTE') 	
			{{-- Item --}}
		    
			<a href="" class="navi-item"> 
		        <div class="navi-link">
		            <div class="symbol symbol-40 bg-light mr-3">
		                <div class="symbol-label">
							{{ Metronic::getSVG("media/svg/icons/Files/File.svg", "svg-icon-md svg-icon-success") }}
						</div>
		            </div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
		                    Perfil de ponente
		                </div>
		                
		            </div>
		        </div>
			</a>
			@endrole

			{{-- Item --}}
		    <a href="{{url('editPassword')}}"  class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
 						   {{ Metronic::getSVG("media/svg/icons/Communication/Shield-user.svg", "svg-icon-md svg-icon-primary") }}
 					   </div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
						Cambiar Contraseña
		                </div>
		            </div>
		        </div>
		    </a>
		    {{-- Item --}}
		    <a href="{{url('logout')}}"  class="navi-item">
		        <div class="navi-link">
					<div class="symbol symbol-40 bg-light mr-3">
						<div class="symbol-label">
 						   {{ Metronic::getSVG("media/svg/icons/Code/Lock-circle.svg", "svg-icon-md svg-icon-danger") }}
 					   </div>
				   	</div>
		            <div class="navi-text">
		                <div class="font-weight-bold">
						Cerrar Sesión
		                </div>
		            </div>
		        </div>
		    </a>
		</div>
    </div>
</div>
