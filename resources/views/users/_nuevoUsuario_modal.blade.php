<div class="modal inmodal" id="registroServidorPublicoManual" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content animated bounceInRight">
          <div class="modal-header">
          <!--<i class="fa fa-question modal-icon"></i>-->
            <h2 class="modal-title">Nuevo usuario</h2>
            <small class="font-bold">&nbsp;
              <!--AQUI MOSTRAMOS LOS ERRORES-->
            </small>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          </div>
      <form  method="post" id="registroUsuarioManualAdmin">
        @method('POST')
        @csrf
        <div class="card-body" id="kt_card_nuevo_usuario">
          <h4>Datos persona</h4>
          <div class="form-group row">
              <div class="col-md-6">
                  <label>{{ __('Curp:') }}</label>
                  <input id="txtCurpManual" name="txtCurpManual" type="text" class="form-control{{ $errors->has('txtCurpManual') ? ' is-invalid' : '' }}" value="{{ old('txtCurpManual') }}" placeholder="Curp" onchange="getDatosCurp(this.value)" onkeyup="this.value=this.value.toUpperCase()" maxlength="18">
                    @if ($errors->has('txtCurpManual'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('txtCurpManual') }}</strong>
                      </span>
                    @endif
                    <span class="form-text text-muted">*Campo obligatorio</span>
              </div>
              <div class="col-md-6">
                  <label>{{ __('RFC (Homoclave):') }}</label>
                  <input id="txtrfcManual" type="text" class="form-control{{ $errors->has('txtrfcManual') ? ' is-invalid' : '' }}" name="txtrfcManual" value="{{ old('txtrfcManual') }}" placeholder="RFC" style="text-transform: uppercase"  onkeyup="this.value=this.value.toUpperCase()" maxlength="13">
                    @if ($errors->has('txtrfcManual'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('txtrfcManual') }}</strong>
                      </span>
                    @endif
                    <span class="form-text text-muted">*Campo obligatorio</span>
              </div>
          </div>

          <div class="form-group row">
            <div class="col-md-4">
              <label>{{ __('Nombre(s):') }}</label>
              <input id="txtnombre_manual" name="txtnombre_manual" type="text" class="form-control{{ $errors->has('txtnombre_manual') ? ' is-invalid' : '' }}" value="{{ old('txtnombre_manual') }}" placeholder="Nombre" style="text-transform: uppercase" >
                @if ($errors->has('txtnombre_manual'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('txtnombre_manual') }}</strong>
                  </span>
                @endif
                <span class="form-text text-muted">*Campo obligatorio</span>
            </div>
            <div class="col-md-4">
              <label>{{ __('Apellido paterno:') }}</label>
              <input id="txtapaterno_manual" name="txtapaterno_manual" type="text" class="form-control{{ $errors->has('txtapaterno_manual') ? ' is-invalid' : '' }}" value="{{ old('txtapaterno_manual') }}" placeholder="apellido paterno" style="text-transform: uppercase" >
                @if ($errors->has('txtapaterno_manual'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('txtapaterno_manual') }}</strong>
                  </span>
                @endif
                <span class="form-text text-muted">*Campo obligatorio</span>
            </div>
              <div class="col-md-4">
                <label>{{ __('Apellido Materno:') }}</label>
                <input id="txtamaterno_manual" name="txtamaterno_manual" type="text" class="form-control{{ $errors->has('txtamaterno_manual') ? ' is-invalid' : '' }}" value="{{ old('txtamaterno_manual') }}" placeholder="apellido materno" style="text-transform: uppercase" >
                  @if ($errors->has('txtamaterno_manual'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('txtamaterno_manual') }}</strong>
                    </span>
                  @endif
                  <span class="form-text text-muted">*Campo obligatorio</span>
              </div>
            </div>

            <hr>
            <h4>Datos empleado</h4>
            <div class="form-group row">
              <div class="col-md-6">
                <label>{{ __('Número de empleado:') }}</label>
                <input type="text" class="form-control" name="num_empleado" id="num_empleado" value="{{ old('num_empleado') }}" maxlength="14" placeholder="Número de empleado"/>
              </div>
              <div class="col-md-6">
                <label>{{ __('Tipo de contratación:') }}</label>
                <select class="form-control col-md-12 {{ $errors->has('tipo_contratacion_manual') ? ' is-invalid' : '' }} " id="tipo_contratacion_manual" name="tipo_contratacion_manual" onchange="tipoDeContratacionChange();">
                  <option value="">
                    selecciona una opción
                  </option>
                  @foreach($catTipoContratacion as $tipo)
                    <option value="{{$tipo->clave_tipo_contratacion}}" {{ old('tipo_contratacion_manual') == $tipo->id ? 'selected' : '' }}>
                      {{$tipo->tipo_contratacion}}
                    </option>
                  @endforeach
                </select>

                @if($errors->has('tipo_contratacion_manual'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('tipo_contratacion_manual') }}</strong>
                    </span>
                @endif

                <span class="form-text text-muted">*Campo obligatorio</span>
              </div>
            </div>

            <div class="form-group row">
              <div class="col-lg-12">
                <label>{{ __('Ente público:') }}</label>
                <select id="entes_llenados" name="entes_llenados" class="form-control col-md-12 {{ $errors->has('entes_llenados') ? ' is-invalid' : '' }} " style="width:100%;" onchange="getUnidades(this.value);">
                  <option value="">Seleccione</option>
                  @foreach($entesPublicos as $ente)
                    <option value="{{$ente->id}}">{{$ente->ente_publico}}</option>
                  @endforeach
                </select>
                @if ($errors->has('entes_llenados'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('entes_llenados') }}</strong>
                  </span>
                @endif
                <span class="form-text text-muted">* Campo obligatorio</span>
              </div>   
            </div>
            <div class="form-group row">
              <div class="col-lg-12">
                <label>{{ __('Área:') }}</label>
                <div class="form-group">
                  <select id="areas_llenados" name="areas_llenados" class="form-control col-md-12 {{ $errors->has('areas_llenados') ? ' is-invalid' : '' }} " style="width:100%;" onchange="buscar_puestos_manual();"></select>
                  @if ($errors->has('areas_llenados'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('areas_llenados') }}</strong>
                  </span>
                  @endif
                  <span class="form-text text-muted">* Campo obligatorio</span>
                </div>        
              </div>
            </div>
            <div class="form-group row" id="puesto_manual_container">
              <div class="col-lg-12">
                <label>{{ __('Puesto:') }}</label>
                                {{-- <div class="form-group"> --}}
                <select id="puesto_manual" name="puesto_manual" class="form-control col-md-12 {{ $errors->has('puesto_manual') ? ' is-invalid' : '' }}" style="width:100%;" onchange="valida_otro_manual();">
                </select>
                @if ($errors->has('puesto_manual'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('puesto_manual') }}</strong>
                  </span>
                  @endif
                <span class="form-text text-muted">* Campo obligatorio</span>
                                {{-- </div> --}}   
              </div>
                        
            </div>


            <div id="textopuesto_manual">
              <div class="form-group row">
                <div class="col-lg-12">
                    <label>{{ __('Otro puesto:') }}</label>
                    <div class="form-group">
                      <input type="text" class="form-control {{ $errors->has('') ? ' is-invalid' : '' }}" name="txtpuestomanual" id="txtpuesto_sin" placeholder="Puesto" maxlength="200" style="text-transform: uppercase"  />
                      @if ($errors->has('txtpuestomanual'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('txtpuestomanual') }}</strong>
                        </span>
                      @endif
                      <span class="form-text text-muted">* Campo obligatorio</span>
                    </div>   
                </div>
              </div>
            </div>
            <hr>
            <h4>Datos de contacto</h4>
            <div class="form-group row">
              
                <div class="col-md-6">
                  <label>{{ __('Correo electrónico:') }}</label>
                  <input id="emailManual" type="text" class="form-control{{ $errors->has('emailManual') ? ' is-invalid' : '' }} {{ $errors->has('emailManual') ? ' is-invalid' : '' }}" name="emailManual" value="{{ old('emailManual') }}" placeholder="Correo electrónico"  >

                  @if ($errors->has('email_confirmation'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email_confirmation') }}</strong>
                    </span>
                  @endif
                  <span class="form-text text-muted">*Campo obligatorio</span>
                </div>

                <div class="col-md-6">
                <label>{{ __('Confirmación de correo electrónico:') }}:</label>
                <input id="emailconfirmManual" type="text" class="form-control{{ $errors->has('emailconfirmManual') ? ' is-invalid' : '' }}" name="emailconfirmManual" value="{{ old('emailconfirmManual') }}" placeholder="Correo electrónico" >
                  @if ($errors->has('emailconfirmManual'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('emailconfirmManual') }}</strong>
                    </span>
                  @endif
                  <span class="form-text text-muted">*Campo obligatorio</span>
                </div>
            </div>

            <div class="form-group row">

                <!-- campo 2 (confirmación de telefono) --> 
                <div class="col-md-6">
                  <label>{{ __('Número de telefónico:') }}</label>
                  <input id="telefono_confirmation" type="text" class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }} {{ $errors->has('telefono_confirmation') ? ' is-invalid' : '' }}" name="telefono_confirmation" value="{{ old('telefono_confirmation') }}" placeholder="Número telefónico" maxlength="10">
                  @if ($errors->has('telefono_confirmation'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('telefono_confirmation') }}</strong>
                    </span>
                  @endif
                  <span class="form-text text-muted">*Campo obligatorio</span>
                </div>
                <!-- campo 1 --> 
                <div class="col-md-6">
                  <label>{{ __('Confirmación de número telefónico:') }}</label>
                  <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" placeholder="Número telefónico" maxlength="10">
                    @if ($errors->has('telefono'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('telefono') }}</strong>
                      </span>
                    @endif
                    <span class="form-text text-muted">*Campo obligatorio</span>
                </div>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
          <input type="submit" href="" class="btn btn-success" value="Guardar" id="btn-guardarUsuarioManualAdmin">
        </div>
      </form>
      
    </div>
  </div>
</div>        
