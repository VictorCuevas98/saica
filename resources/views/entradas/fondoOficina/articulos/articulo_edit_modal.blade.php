<div class="modal fade" id="exampleModalArticuloNuevo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog   modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Artículo</h4>
                    <small class="font-bold">&nbsp;</small>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
<!--============================================================================================================================================= -->

                    
        <!--begin::Details-->
        <div class="d-flex mb-9">
            <!--begin: Pic-->
            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                <div class="symbol ">
                    <span class="symbol-label"><i class="fas fa-pills  icon-lg icon-5x"></i></span>
                </div>
                <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                    <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                </div>
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between flex-wrap mt-1">
                    <div class="d-flex mr-3">
                        <a href="#" class="text-dark-75 mr-3 text-justify">
                            {{ Str::limit($articulo->artmed, $limit = 250, $end = '...') }}
                        </a>
                        <a href="#" id="" class="  btn btn-icon btn-success" data-toggle="tooltip" data-placement="top" title="{{$articulo->artmed}}">
                            <i class="fas fa-info "></i>
                        </a>
                        <!--<a href="#">
                            <i class="flaticon2-correct text-success font-size-h5"></i>
                        </a>-->
                    </div>
                    <a href="#" id="btn-modal-search-artmed-for-edit" class=" btn-xs btn btn-icon btn-outline-warning">
                        <i class="fas fa-undo "></i>
                    </a>
                    
                </div>
                <!--end::Title-->
                <!--begin::Content-->
                <div class="d-flex flex-wrap justify-content-between mt-1">
                    <div class="d-flex flex-column flex-grow-1 pr-8">
                        <div class="d-flex flex-wrap mb-4">
                            <a href="#" class="text-dark-50 text-hover-primary  mr-lg-8 mr-5 mb-lg-0 mb-2">
                            <i class="fas fa-keyboard mr-2 font-size-lg"></i>{{$articulo->clave_artmed}}</a>
                            <a href="#" class="text-dark-50 text-hover-primary  mr-lg-8 mr-5 mb-lg-0 mb-2">
                            <i class="fas fa-box-open mr-2 "></i>{{$articulo->unidad_medida}}</a>
                            <!--<a href="#" class="text-dark-50 text-hover-primary font-weight-bold">
                            i class="flaticon2-placeholder mr-2 font-size-lg"></i>Melbourne</a>-->
                        </div>
                        <!--<span class="font-weight-bold text-dark-50">----------------</span>-->
                        
                    </div>
                    
                </div>
                <!--end::Content-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->
        <div class="separator separator-solid"></div>
            
                                                 
<!---->
        <form class="form" id="kt_form_articulo" action="{{route('entradas.fondoOficinas.checklist.articulos.update',[$adquisicionId,$entradaId,$articuloId])}}" method="post"  >
            @method('PUT')
            @csrf
            <input type="hidden" name="artmed" value="{{$articuloId}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="">
                            <label>* Cantidad:</label>
                            <div class="input-group">
                                    <div class="input-group-prepend">
                                     <span class="input-group-text" ><i class="fas fa-boxes fas fa-cubes fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="" value="{{$entradaAdquisicionDetalle->cantidad_unidades}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <div class="">
                            <label>* Precio Unitario:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                 <span class="input-group-text" ><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" class="form-control" name="precio_unitario" id="precio_unitario" placeholder="" value="{{$entradaAdquisicionDetalle->monto_unitario}}"/>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                   

                    <div class="form-group">
                        <div class="">
                         <label>* Iva:</label>
                            <div class="input-group">
                                <span class="switch switch-icon">
                                    <label>
                                        @php
                                        $ivaChecked = ($entradaAdquisicionDetalle->monto_impuesto >0 ) ? 'checked="checked"' :'';  ;
                                        @endphp
                                         <input type="checkbox" {{$ivaChecked}} name="iva_check" id="iva_check"/>
                                         <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                     </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        <div class="">
                         <label>* Laboratorio:</label>
                            <select class="form-control" name="laboratorio" id="laboratorio">
                                <option value="">Seleccionar</option>
                                
                                @foreach($catLaboratorio as $laboratorio)
                                    @php
                                        $selectedLaboratorio =($laboratorio->id == $entradaAdquisicionDetalle->id_laboratorio )? 'selected' : '' ;
                                    @endphp
                                    <option value="{{$laboratorio->clave_laboratorio}}" {{$selectedLaboratorio}}>{{$laboratorio->laboratorio}}</option>
                                @endforeach
                           </select>
                        </div>
                     </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="">
                         <label>* Lote:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                 <span class="input-group-text" ><i class="fas fa-box-open"></i></span>
                                </div>
                                <input type="text" class="form-control" name="lote" placeholder="" value="{{$entradaAdquisicionDetalle->num_lote}}"/>
                            </div>
                        </div>
                     </div>
                </div>
               

                <div class="col-md-6">
                    
                    <div class="form-group row">
                        <label class=" col-sm-12 ">Caducidad *</label>
                        <div class="col-sm-12">
                            <div class="input-group">
                                
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control kt_datepicker"  placeholder="fecha de caducidad" name="caducidad" id="caducidad" value="{{Carbon::parse($entradaAdquisicionDetalle->fecha_caducidad)->format('d/m/Y') }}" />
                            </div>
                            <span class="form-text text-muted"></span>
                        </div>
                    </div>

                </div>


            </div>
           
            
                                        
                                                 

                                         <div class="separator separator-dashed my-10"></div>


                                         <div class="row">
                                          <div class="col-lg-12 ml-lg-auto">
                                           <button type="reset" class=" btn btn-secondary  mr-3 ">Reestablecer</button>
                                           <button type="submit" class="btn btn-primary mr-2 float-right">Guardar</button>
                                          </div>
                                         </div>
                                        </form>

                                        <!---->
                                   
<!--============================================================================================================================================= -->                            







                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                </div>
                
        </div>
    </div>
</div>
{{-- el siguiente es un ejemplo de como se debe de hacer el boton de llamada al modal --}}
{{--
<div class="text-center">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalArticuloNuevo">
        accion
    </button>
</div> --}}