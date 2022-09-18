<!-- sample modal content -->
<div id="validarContrato" class="modal animated bounceInRight " tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title">Validar Contrato</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="" method="post">
                @method('POST')
                @csrf
                <div class="modal-body">
                    {{--fecha, numero de contrato--}}
                    <div class="form row">
                        <div class="col-lg-6 mb-3">
                            <label for="crear_fecha">{{ __('Fecha') }}</label>

                            <input id="validar_fecha" type="date"
                                   class="form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" name="fecha"
                                   value="{{ old('fecha') }}" required autofocus>
                            @if ($errors->has('fecha'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('fecha') }}</strong>
							</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="crear_numerocontrato">{{ __('Número de contrato') }}</label>

                            <input id="validar_numerocontrato" type="number"
                                   class="form-control{{ $errors->has('numerocontrato') ? ' is-invalid' : '' }}"
                                   name="numerocontrato" value="{{ old('numerocontrato') }}" required autofocus>
                            @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('date') }}</strong>
							</span>
                            @endif
                        </div>
                    </div>

                    {{--tipo de contrato, numero de requisiscion--}}
                    <div class="form row">
                        <div class="col-lg-6 mb-3">
                            <label>{{ __('Tipo de contrato') }}</label>
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="crear_tipocontrato" required
                                           class="{{ $errors->has('tipocontrato') ? ' is-invalid' : '' }}"/>
                                    <span></span>
                                    Cerrado
                                </label>
                                <label class="radio">
                                    <input type="radio" name="crear_tipocontrato"
                                           required {{ $errors->has('tipocontrato') ? ' is-invalid' : '' }}/>
                                    <span></span>
                                    Abierto
                                </label>
                            </div>
                            <span style="font-size: 1rem" class="form-text text-muted">Información adicional acerca de los tipos de contrato</span>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="crear_adquisicion">{{ __('Número de adquisición') }}</label>

                            <input id="validar_adquisicion" type="number"
                                   class="form-control{{ $errors->has('adquisicion') ? ' is-invalid' : '' }}"
                                   name="adquisicion"
                                   value="{{ old('adquisicion') }}" required autofocus>
                            @if ($errors->has('adquisicion'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('adquisicion') }}</strong>
							</span>
                            @endif
                        </div>
                    </div>

                    {{--proveedor, sitio--}}
                    <div class="form row">
                        <div class="col-lg-6 mb-3">
                            <label for="proveedor">{{__('Proveedor')}}</label><br>
                            <select
                                class="proveedor_select select2 form-control {{ $errors->has('proveedor') ? ' is-invalid' : '' }}"
                                id="validar_proveedor_select"
                                name="param"
                                required>
                                <option label="Label"></option>
                                <option>2C MEX, SA DE CV</option>
                                <option>2E ESPACIO EMPRESARIAL, S.A DE C.V</option>
                                <option>5M2ANDENES SA PI DE CV</option>
                                <option>6B INVENT GERMANT, S.A DE C.V</option>
                                <option>7 KAT, S.A DE C.V</option>
                                <option>A1, S.A DE C.V</option>
                                <option>ABA GRADAS, EVENTOS Y VALLAS DE SA DE CV</option>
                                <option>ABALAT, S.A DE C.V</option>
                                <option>ABAMEX CHEVROLET, S.A DE C.V</option>
                                <option>ABASI SERVICIOS INTEGRALES S.A DE C.V</option>
                                <option>ABASTECEDORA COMERCIAL DEL VALLE SA DE CV</option>
                                <option>ABASTECEDORA COYOACAN SA DE CV</option>
                                <option>ABASTECEDORA DE COLCHONES Y ACCESORIOS S.A DE C.V</option>
                                <option>ABASTECEDORA DE COLCHONES Y ACCESORIOS, S.A DE C.B.</option>
                                <option>ABASTECEDORA DE INSUMOS PARA LA SALUD S.A. DE C.V.</option>
                                <option>ABASTECEDORA LIVIER SA DE CV</option>
                                <option>ABASTECEDORA MEDICA DEL GOLFO AMEGOL SA DE CV</option>
                                <option>ABASTECEDORA MERCURIO, S.A DEC.V.</option>
                            </select>
                            @if($errors->has('proveedor'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('proveedor') }}</strong>
							</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="sitio">{{__('Sitio')}}</label>
                            <br>
                            <select
                                class="sitio_select select2 form-control {{ $errors->has('sitio') ? ' is-invalid' : '' }}"
                                id="validar_sitio_select"
                                name="param"
                                required>
                                <option label="Label"></option>
                                <option>Almacén alterno de la Secretaría de Salud</option>
                                <option>Almacén Central de la Secretaría de Salud</option>
                                <option>CENDI</option>
                                <option>Centro de Readaptación Social Masculino Santa Marta</option>
                                <option>Centro De Readaptación Social Varonil</option>
                                <option>Centro de Sanciones Administrativas</option>
                                <option>Centros Feminil De Readaptacion Social Santa Martha Acatitla</option>
                                <option>Centro Regulador de Urgencias Médicas</option>
                                <option>CENTRO VARONIL DE SEGURIDAD PENITENCIARIA TORRE I</option>
                                <option>CENTRO VARONIL DE SEGURIDAD PENITENCIARIA TORRE II</option>
                                <option>Cevarepsi</option>
                                <option>Clínica Hospital de Especialidades Toxicolóficas Venustiano Carranza</option>
                                <option>Clínica Hospital Emiliano Zapata</option>
                                <option>Comunidad de Diagnóstico Integral para Adolecentes</option>
                            </select>
                            @if($errors->has('sitio'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('sitio') }}</strong>
							</span>
                            @endif
                        </div>
                    </div>

                    {{--tipo de movimiento, fundamento legal--}}
                    <div class="form row">
                        <div class="col-lg-6 mb-3">
                            <label for="tipomovimiento">{{__('Tipo de movimiento')}}</label>
                            <select
                                class="tipomovimiento_select select2 form-control {{ $errors->has('tipomovimiento') ? ' is-invalid' : '' }}"
                                id="validar_tipomovimiento_select"
                                name="param"
                                required>
                                <option label="Label"></option>
                                <option>Adjudicación Directa</option>
                                <option>Licitación por Invitación restringida</option>
                                <option>Licitación Pública Internacional</option>
                                <option>Licitación Pública Nacional</option>
                            </select>
                            @if($errors->has('tipomovimiento'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('tipomovieminto') }}</strong>
							</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="flegal">{{__('Fundamento legal')}}</label>
                            <select
                                class="flegal_select select2 form-control {{ $errors->has('flegal') ? ' is-invalid' : '' }}"
                                id="validar_flegal_select"
                                name="flegal"
                                required>
                                <option label="Label"></option>
                                <option>Art. 54 fracc. III.</option>
                                <option>Art. 54 fracc. VI.</option>
                                <option>Art. 54 fracc. VII.</option>
                                <option>Art. 54 fracc. VIII.</option>
                                <option>Art. 54 fracc. IX.</option>
                                <option>Art. 54 fracc. X</option>
                                <option>Art. 54 fracc. XI</option>
                                <option>Art. 54 fracc. XII</option>
                                <option>Art. 54 fracc. XIII</option>
                                <option>Art. 54 fracc. XIV</option>
                                <option>Art. 1.</option>
                                <option>Art. 30 fracc. I.</option>
                                <option>Art. 30 fracc. II.</option>
                                <option>Art. 54 fracc. I.</option>
                                <option>Art. 54 fracc. II.</option>
                            </select>
                            @if($errors->has('flegal'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('flegal') }}</strong>
							</span>
                            @endif
                        </div>
                    </div>

                    {{--origen del recurso, oficio de adjudicacion--}}
                    <div class="form row">
                        <div class="col-lg-6 mb-3">
                            <label for="orecurso">{{__('Origen del recurso')}}</label>
                            <select
                                class="orecursos_select select2 form-control {{ $errors->has('orecurso') ? ' is-invalid' : '' }}"
                                id="valirar_orecurso_select"
                                name="param"
                                required>
                                <option label="Label"></option>
                                <option>Seguro Popular</option>
                                <option>Equipamiento con recursos federales</option>
                                <option>Programa de Violencia de Género</option>
                                <option>Cruzada Nacional por la calidad de los SS</option>
                                <option>Recursos autogenerados</option>
                            </select>
                            @if($errors->has('orecurso'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('orecurso') }}</strong>
							</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="crear_adjudicacion">{{ __('Oficio de adjudicación') }}</label>
                            <input id="validar_adjudicacion" type="text"
                                   class="form-control{{ $errors->has('adjudicacion') ? ' is-invalid' : '' }}"
                                   name="adjudicacion"
                                   value="{{ old('adjudicacion') }}" required autofocus>
                            @if ($errors->has('adjudicacion'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('adjudicacion') }}</strong>
							</span>
                            @endif
                        </div>
                    </div>

                    {{--monto, observaciones--}}
                    <div class="form row">
                        <div class="col-lg-6 mb-3">
                            <label for="crear_motno">{{ __('Monto') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$ 0.00 MXN</span>
                                </div>
                                <input id="validar_monto" type="number"
                                       class="form-control{{ $errors->has('monto') ? ' is-invalid' : '' }}" name="monto"
                                       value="{{ old('monto') }}" required autofocus>
                                @if ($errors->has('monto'))
                                    <span class="invalid-feedback" role="alert">
								        <strong>{{ $errors->first('monto') }}</strong>
							        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="crear_observaciones">{{ __('Observaciones') }}</label>
                            <textarea class="form-control {{$errors->has('observaciones') ? 'is-invalid' : ''}}"
                                      id="validar_observaciones"
                                      name="observaciones"
                                      rows="3"
                                      value="{{old('observaciones')}}" required autofocus></textarea>
                            @if ($errors->has('observaciones'))
                                <span class="invalid-feedback" role="alert">
								<strong>{{ $errors->first('observaciones') }}</strong>
							</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <input type="submit" href="" class="btn btn-primary" value="Guardar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.modal -->

