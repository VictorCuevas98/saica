<div id="registroServidorPublicoManual" class="modal fade"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                <button type="button" id="closeRegisro" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-custom alert-light-dark fade show mb-5" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text" style="text-align:justify">
                        <center><h4>AVISO DE PRIVACIDAD SIMPLIFICADO</h4></center>
                        <p class="mb-0">La Secretaría de Salud de la Ciudad de México, con domicilio en Avenida Insurgentes Norte Conjunto Urbano Nonoalco, No. 423, Colonia Nonoalco Tlatelolco, Alcaldía Cuauhtémoc, C.P. 06900, Ciudad de México, es la responsable del tratamiento de los datos personales que nos proporcione, mismos que se encuentran protegidos por la Ley de Protección de Datos Personales en Posesión de Sujetos Obligados de la Ciudad México y demás normativa que resulte aplicable.</p><br>
                        <h6>¿Para qué fines utilizaremos sus datos personales?</h6>
                        Sus datos personales serán utilizados en el Sistema de Abasto, Inventario y Control de Almacenes “SAICA”, para el correspondiente registro como usuarios del mismo entre los que se encuentran personal administrativo de la Dirección General de Administración, personal de farmacias de las Unidades Médicas Hospitalarias, todos de la Secretaría de Salud de la Ciudad de México.<br><br>
                        <h6>¿Con quién compartimos su información personal y para qué fines?</h6>
                        No se realizará transferencia alguna de los datos personales proporcionados, salvo aquellos casos en que sean previsto por la normativa aplicable al caso concreto.
                    </div>
                </div>
            <form class="form" id="registroUsuarioManual">
            @csrf
                <div class="card-body">
                    <div id="personafisica">
                        <div class="form-group row">
                            <div class="col-lg-4" id="spinerCurp">
                                <label>CURP:</label>
                                {{-- <div class="input-group"> --}}
                                    <input type="text" maxlength="18" onchange="getDatosCurp(this.value)" style="text-transform: uppercase" class="form-control" name="txtCurpManual" id="txtCurpManual" placeholder="Buscar CURP ...."/>
                                {{-- </div> --}}
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label class="pt-2">RFC:</label>
                                <input type="text"  style="text-transform: uppercase"  class="form-control" name="txtrfcManual" id="txtrfcManual" maxlength="13" readonly/>
                            </div>
                            <div class="col-lg-4">
                                <label class="pt-2">Tipo de Contratación:</label>
                                <select id="tipo_contratacion_manual" name="tipo_contratacion_manual" class="form-control form-control-solid" onchange="tipoDeContratacionChange();">
                                   <option value="">Selecciona</option>
                                   @foreach($catTipoContratacion as $tipo)
                                        <option value="{{$tipo->clave_tipo_contratacion}}">{{$tipo->tipo_contratacion}}</option>
                                   @endforeach
                                </select>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>


                            <div class="col-lg-4">
                                <!--begin::Input-->
                                <div class="form-group pt-2">
                                    <label>fecha de inicio en el puesto </label>
                                    <input type="date" class="form-control form-control-lg" name="fecha_de_contratacion_inicial" id="fecha_de_contratacion_inicial" placeholder="" value=""  />
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>



                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Numero empleado:</label>
                                <input type="text" class="form-control form-control-solid" name="txtNUmEmpleadosManual" maxlength="14" id="txtNUmEmpleadosManual" maxlength="10"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Nombre(s):</label>
                                {{-- <div class="input-group"> --}}
                                    <input type="text" class="form-control" name="txtnombre_manual" id="txtnombre_manual" readonly style="text-transform: uppercase" />
                                {{-- </div> --}}
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido paterno:</label>
                                {{-- <div class="input-group"> --}}
                                    <input type="text" class="form-control" name="txtapaterno_manual" id="txtapaterno_manual" readonly style="text-transform: uppercase" />
                                {{-- </div> --}}
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido materno:</label>
                                {{-- <div class="input-group"> --}}
                                    <input type="text"  class="form-control" name="txtamaterno_manual" id="txtamaterno_manual" style="text-transform: uppercase"  readonly/>
                                {{-- </div> --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Ente público:</label>
                                <select id="entes_llenados" name="entes_llenados" class="form-control form-control-solid form-control-lg" style="width:100%;" onchange="getUnidades(this.value);">
                                    <option value="">Seleccione</option>
                                      @foreach($entesPublicos as $ente)
                                        <option value="{{$ente->id}}">{{$ente->ente_publico}}</option>
                                      @endforeach

                                </select>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Área</label>
                                <div class="form-group">
                                    <select id="areas_llenados" name="areas_llenados" class="form-control form-control-solid form-control-lg" style="width:100%;" onchange="buscar_puestos_manual();"></select>
                                    <span class="form-text text-muted">* Campo obligatorio</span>
                                </div>        
                            </div>
                        </div>
                       
                        <div class="form-group row" id="puesto_manual_container">
                            <div class="col-lg-12">
                                <label>Puesto:</label>
                                {{-- <div class="form-group"> --}}
                                    <select id="puesto_manual" name="puesto_manual" class="form-control form-control-solid form-control-lg" style="width:100%;" onchange="valida_otro_manual();">
                                    </select>
                                    <span class="form-text text-muted">* Campo obligatorio</span>
                                {{-- </div> --}}   
                            </div>
                        
                        </div>
                        <div id="textopuesto_manual">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Otro puesto:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="txtpuestomanual" id="txtpuesto_sin"  placeholder="Puesto" maxlength="200"  style="text-transform: uppercase"  />
                                        <span class="form-text text-muted">* Campo obligatorio</span>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-solid separator-border-3"></div><br>
                        <h4>Contacto:</h4><br>

                        <div class="form-group row">
                            
                            <div class="col-lg-6">
                                <label>Correo Electrónico:</label>
                                {{-- <div class="input-group"> --}}
                                    <input type="mail" class="form-control" name="emailManual" id="emailManual" placeholder="Correo electrónico"  />
                                {{-- </div> --}}
                                <span class="form-text text-muted">* Campo obligatorio</span>
                                <div class="fv-plugins-message-container"></div>
                            </div>
                            <div class="col-lg-6">
                                <label>Confirmar Correo Electrónico:</label>
                                {{-- <div class="input-group"> --}}
                                    <input type="mail" class="form-control" name="emailconfirmManual" id="emailconfirmManual" placeholder="Correo electrónico"  />
                                {{-- </div> --}}
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Número Telefónico:</label>
                                {{-- <div class="input-group"> --}}
                                    <input type="text" class="form-control tel3" name="telefonoFManual" id="telefonoFManual" maxlength="12"  placeholder="Número Telefónico"/>
                                {{-- </div> --}}
                            </div>
                            <div class="col-lg-6">
                                <label>Confirmar Número Telefónico:</label>
                                {{-- <div class="input-group"> --}}
                                    <input type="mail" class="form-control tel4" name="telefonoconfirmFManual" maxlength="12" id="telefonoconfirmFManual"  placeholder="Número Telefónico"/>
                                {{-- </div> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Telefono de Oficina:</label>
                                {{-- <div class="input-group"> --}}
                                <input type="text" class="form-control tel3" name="telOficinaManual" id="telOficinaManual" maxlength="12"  placeholder="Número Telefónico de Oficina"/>
                                {{-- </div> --}}
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                            <div class="col-lg-6">
                                <label>Extension de Oficina:</label>
                                <input type="mail" class="form-control tel4" name="extension" id="extension"  placeholder="Extension"/>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="" name="txtcurp" id="txtcurp"/>
                <input type="hidden" value="" name="txtnumemp" id="txtnumemp"/>
                <input type="hidden" value="" name="txtgenero" id="txtgenero"/>
                <input type="hidden" value="" name="tipo_guardado" id="tipo_guardado"/>
            </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="cerrarReg" class="btn btn-light font-weight-bold" data-dismiss="modal" >Cerrar</button>
                <button type="button" class="btn btn-success font-weight-bold" id="guardarUsuarioManual" name="guardarUsuarioManual">Guardar</button>
            </div>
        </div>
    </div>
</div>
