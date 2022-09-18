<div class="modal fade" id="registro" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
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
                        <center><h4>AVISO DE PRIVACIDAD SIMPLE</h4></center>
                        <p class="mb-0">La Secretaría de Administración y Finanzas, con domicilio en Calle Dr. Lavista 144, Colonia Doctores, Alcaldía Cuauhtémoc, C.P. 06720, Ciudad de México, es la responsable del tratamiento de los datos personales que nos proporcione, mismos que se encuentran protegidos por la Ley de Protección de Datos Personales en Posesión de Sujetos Obligados de la Ciudad México y demás normativa que resulte aplicable.</p><br>
                        <h6>¿Para qué fines utilizaremos sus datos personales?</h6>
                        Sus datos personales serán utilizados en “Agenda Maap”, para el registro de su asistencia a las diversas conferencias, pláticas, conversatorios que sean organizados y que previamente seleccione.<br><br>
                        <h6>¿Con quién compartimos su información personal y para qué fines?</h6>
                        No se realizará transferencia alguna de los datos personales proporcionados, salvo aquellos casos en que sean previsto por la normativa aplicable al caso concreto.  
                    </div>
                </div>
            <form class="form" id="registroUsuario">
            @csrf
                <div class="card-body">
                    <div id="personafisica">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>RFC:</label>
                                <input type="text" class="form-control" name="txtrfc" id="txtrfc" readonly/>
                            </div>
                            <div class="col-lg-4">
                                <label>Tipo de Contratación:</label>
                                <select id="tipo_contratacion" name="tipo_contratacion" class="form-control form-control-solid" onchange="limpiar_puestos();">
                                   <option value="">Selecciona</option>
                                   @foreach($catTipoContratacion as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->tipo_contratacion}}</option>
                                   @endforeach
                                </select>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <label>Nombre(s):</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="txtnombre" id="txtnombre" readonly/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido paterno:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="txtapaterno" id="txtapaterno" readonly/>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>Apellido materno:</label>
                                <div class="input-group">
                                    <input type="text"  class="form-control" name="txtamaterno" id="txtamaterno" readonly/>
                                </div>
                            </div>
                        </div>

                        <div id="conSectPres" class="d-none">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Ente público:</label>
                                    <input type="text" class="form-control" name="txtentep" id="txtentep" readonly/>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Área</label>
                                    <div class="form-group">
                                        <select id="area" name="area" class="form-control form-control-solid form-control-lg" style="width:100%;" onchange="buscar_puestos();"></select>
                                        <span class="form-text text-muted">* Campo obligatorio</span>
                                    </div>        
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Puesto:</label>
                                    <div class="form-group">
                                        <select id="puesto" name="puesto" class="form-control form-control-solid form-control-lg" style="width:100%;" onchange="valida_otro();">
                                        </select>
                                        <span class="form-text text-muted">* Campo obligatorio</span>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <div id="sinSectPres" class="d-none">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Ente público:</label>
                                    
                                    <select name="txtentep" id="txtentep_sin" class="form-control form-control-solid form-control-lg" style="width:100%;" onchange="getUnidadesSinSectPres(this.value)"></select>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Área</label>
                                    <div class="form-group">
                                        <select id="area_sin" name="area" class="form-control form-control-solid form-control-lg" style="width:100%;" onchange="buscar_puestos_sin_sec_pres();"></select>
                                        <span class="form-text text-muted">* Campo obligatorio</span>
                                    </div>        
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Puesto:</label>
                                    <div class="form-group">
                                        <select id="puesto_sin" name="puesto" class="form-control form-control-solid form-control-lg" style="width:100%;" onchange="valida_otro_sin();">
                                        </select>
                                        <span class="form-text text-muted">* Campo obligatorio</span>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <div id="textopuesto">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Otro puesto:</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="txtpuesto" id="txtpuesto_sin"  placeholder="Puesto" maxlength="200"/>
                                        <span class="form-text text-muted">* Campo obligatorio</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
{{--                         <div class="separator separator-solid separator-border-3"></div><br>
                        <h4>Domicilio particular para oír y recibir notificaciones ubicado en:</h4><br>
                        <div class="form-group row">
                            <div class="col-lg-2">
                                <label>CP:</label>
                                <input type="text" class="form-control" name="txtcp" id="txtcp"  placeholder="Código postal" onchange="buscar_cp();"/>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                            <div class="col-lg-5">
                                <label>Entidad federativa</label>
                                <select name="id_entidad" id="id_entidad" required class="form-control form-control-solid">
                                    <option value="0">Selecciona</option>
                                </select>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                            <div class="col-lg-5">
                                <label>Alcaldía o Municipio</label>
                                <select name="id_alcaldia" id="id_alcaldia" class="form-control form-control-solid">
                                    <option value="0">Selecciona</option>
                                </select>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                        </div> --}}
{{--                         <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Colonia:</label>
                                <div class="input-group">
                                    <select name="id_colonia" id="id_colonia" class="form-control form-control-solid" required>
                                        <option value="0">Selecciona</option>
                                    </select>
                                </div>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                            <div class="col-lg-6">
                                <label>Calle:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="txtcalle" id="txtcalle" placeholder="Calle"/>
                                </div>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <label>Número exterior:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="txtnexterior" id="txtnexterior" placeholder="Número exterior"/>
                                </div>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                            <div class="col-lg-3">
                                <label>Número interior:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="txtninterior" id="txtninterior" placeholder="Número interior"/>
                                </div>
                            </div>
                        </div> --}}
                        <div class="separator separator-solid separator-border-3"></div><br>
                        <h4>Contacto:</h4><br>

                        <div class="form-group row">
                            
                            <div class="col-lg-6">
                                <label>Correo Electrónico:</label>
                                <div class="input-group">
                                    <input type="mail" class="form-control" name="email" id="email" placeholder="Correo electrónico"/>
                                </div>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                            <div class="col-lg-6">
                                <label>Confirmar Correo Electrónico:</label>
                                <div class="input-group">
                                    <input type="mail" class="form-control" name="emailconfirm" id="emailconfirm" placeholder="Correo electrónico"/>
                                </div>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Número Telefónico:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control tel3" name="telefonoF" id="telefonoF"  placeholder="Número Telefónico"/>
                                </div>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                            <div class="col-lg-6">
                                <label>Confirmar Número Telefónico:</label>
                                <div class="input-group">
                                    <input type="mail" class="form-control tel4" name="telefonoconfirmF" id="telefonoconfirmF"  placeholder="Número Telefónico"/>
                                </div>
                                <span class="form-text text-muted">* Campo obligatorio</span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="" name="txtcurp" id="txtcurp"/>
                <input type="hidden" value="" name="txtnumemp" id="txtnumemp"/>
                <input type="hidden" value="" name="txtgenero" id="txtgenero"/>
            </form>
            </div>

            <div class="modal-footer">
                <button type="button" id="cerrarReg" class="btn btn-light font-weight-bold" data-dismiss="modal" >Cerrar</button>
                <button type="button" class="btn btn-success font-weight-bold" id="guardarUsuario" name="guardarUsuario">Guardar</button>
            </div>
        </div>
    </div>
</div>
