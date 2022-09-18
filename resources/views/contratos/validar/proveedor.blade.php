@extends('contratos.crear.registro_layout')
@section('contrato')

    <div class="content-wizard" id="proveedor_validar_contrato">
        <form name="" id="frm_nueva_entrada" action="" method="post">
            @method('POST')
            @csrf
            <div class="form-group row">
                <div class="col-lg-3">
                    <label>Folio:</label>
                    <input id="folio" type="text" class="form-control{{ $errors->has('folio') ? ' is-invalid' : '' }}" name="folio" value="FOC-2021-{{Str::random(4)}}"   readonly="readonly" autofoc>
                    @if ($errors->has('folio'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('folio') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="col-lg-3">
                    <label>Oficio adjudicación:</label>
                    <input id="oficio_de_adjudicacion" type="text" class="form-control{{ $errors->has('oficio_de_adjudicacion') ? ' is-invalid' : '' }}" name="oficio_de_adjudicacion" value="{{ old('oficio_de_adjudicacion') }}"  autofoc>
                    @if ($errors->has('oficio_de_adjudicacion'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('oficio_de_adjudicacion') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    <label>número de contrato:</label>
                    <input id="numero_de_contrato" type="text" class="form-control{{ $errors->has('numero_de_contrato') ? ' is-invalid' : '' }}" name="numero_de_contrato" value="{{ old('numero_de_contrato') }}"  autofoc>
                    @if ($errors->has('numero_de_contrato'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('numero_de_contrato') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    <label>número de requisición:</label>
                    <input id="numero_de_requisicion" type="text" class="form-control{{ $errors->has('numero_de_requisicion') ? ' is-invalid' : '' }}" name="numero_de_requisicion" value="{{ old('numero_de_requisicion') }}"  autofoc>
                    @if ($errors->has('numero_de_requisicion'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('numero_de_requisicion') }}</strong>
                        </span>
                    @endif
                </div>
            </div><hr>

            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{{ __('RFC (con homoclave) del proveedor:') }}</label>
                    <div class="input-group">
                        <input id="rfc_del_proveedor" type="text" class="form-control{{ $errors->has('rfc_del_proveedor') ? ' is-invalid' : '' }}" name="rfc_del_proveedor" value="{{ (old('rfc_del_proveedor'))? old('rfc_del_proveedor') : 'CSI130326HD1' }}"  autofocus>

                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="btn-proveedor-searh">buscar</button>
                        </div>
                        @if ($errors->has('rfc_del_proveedor'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('rfc_del_proveedor') }}</strong>
                            </span>
                        @endif
                    </div>
                    <span class="form-text text-muted">Buscar proveedor por RFC</span>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Nombre/Razón social:') }}</label>
                    <input  type="text" class="form-control{{ $errors->has('razon_social_del_proveedor') ? ' is-invalid' : '' }}" name="razon_social_del_proveedor" id="razon_social_del_proveedor" value="{{ old('razon_social_del_proveedor') }}" disabled="" autofoc>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Domicilio:') }}</label>
                    <input type="text" class="form-control{{ $errors->has('domicilio_del_proveedor') ? ' is-invalid' : '' }}" name="domicilio_del_proveedor" value="{{ old('domicilio_del_proveedor') }}" id="domicilio_del_proveedor" disabled="" autofoc>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{{ __('Teléfono:') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control{{ $errors->has('telefono_del_proveedor') ? ' is-invalid' : '' }}" name="telefono_del_proveedor" id="proveedor_telefono" value="{{ old('telefono_del_proveedor') }}" disabled="" autofoc>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Correo electrónico:') }}</label>
                    <input  type="text" class="form-control{{ $errors->has('correo_del_proveedor') ? ' is-invalid' : '' }}" name="correo_del_proveedor" id="correo_del_proveedor" value="{{ old('correo_del_proveedor') }}" disabled="" autofoc>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Representante:') }}</label>
                    <input  type="text" class="form-control{{ $errors->has('representante_del_proveedor') ? ' is-invalid' : '' }}" id="proveedor_representante" name="representante_del_proveedor" value="{{ old('representante_del_proveedor') }}" disabled="" autofoc>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Giro:') }}</label>
                    <input  type="text" class="form-control{{ $errors->has('giro_del_proveedor') ? ' is-invalid' : '' }}" id="giro_del_proveedor" name="giro_del_proveedor" value="{{ old('giro_del_proveedor') }}" disabled="" autofoc>
                </div>
            </div>

            <input type="text" style="display: none;" value="{{$contrato->id}}" id="contrato_id" name="contrato_id">

            <div class="modal-footer">
                <input type="button" id="btn-wiz-2" class="btn btn-primary nextBtnW"
                       value="Guardar">
            </div>
        </form>
    </div>

@endsection
