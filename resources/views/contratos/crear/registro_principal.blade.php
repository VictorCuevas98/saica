@extends('contratos.crear.registro_layout')
@section('contrato')

    <div class="content-wizard" id="tk_tab_wiz_1">
        <form method="post" id="form-contratos" name="form-contratos">
            <div class="modal-body">
                <h4 class="mb-10 font-weight-bold text-dark">Contrato</h4>
                {{--fecha, numero de contrato--}}
                <div class="mb-6"><p style="font-size: 1rem" class="form-text text-muted">Los campos con&nbsp;<span
                            style="color: red">*</span> son obligatorios</p></div>
                <div class="form-group row">
                    <div class="col-lg-6 mb-3">
                        <label for="crear_fecha">{{ __('Fecha') }}</label>&nbsp;<span style="color: red">*</span>
                        <div class="input-group date">
                            <input type="text" class="form-control" readonly
                                   placeholder="dd/mm/AAAA" id="crear_fecha_contrato" name="crear_fecha_contrato"
                                   value="{{ old('crear_fecha') }}" required/>
                            <div class="input-group-append">
                               <span class="input-group-text">
                                <i class="flaticon-time-3"></i>
                               </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="crear_contrato">Contrato</label>&nbsp;<span
                            style="color: red">*</span>

                        <input id="crear_contrato" type="text"
                               class="form-control"
                               name="crear_contrato" value="{{ old('crear_contrato') }}" autocomplete="off">
                    </div>
                </div>

                {{--tipo de contrato, numero de adquisicion--}}
                <div class="form-group row">
                    <div class="col-lg-6 mb-3">
                        <label>{{ __('Tipo de contrato') }}</label>&nbsp;<span style="color: red">*</span>
                        <div class="radio-inline" name="tipocontrato">
                            @if(isset($tipo_contratos))
                                @foreach($tipo_contratos as $tipo_contrato)
                                    <label class="radio">
                                        <input type="radio" name="crear_tipocontrato" required
                                               value="{{$tipo_contrato->clave_tipo_contrato}}"/>
                                        <span></span>
                                        {{$tipo_contrato->tipo_contrato}}
                                    </label>
                                @endforeach
                            @endif
                        </div>
                        <span style="font-size: 1rem" class="form-text text-muted">Información adicional acerca de los tipos de contrato</span>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label
                            for="crear_num_oficio_adjudicacion">{{ __('Oficio de adjudicación') }}</label>&nbsp;<span
                            style="color: red">*</span>

                        <input id="crear_num_oficio_adjudicacion" type="text"
                               class="form-control"
                               name="crear_num_oficio_adjudicacion"
                               value="{{ old('crear_num_oficio_adjudicacion') }}" required autocomplete="off">
                    </div>
                </div>

                {{--partida especifica, fundamento legal--}}
                <div class="form-group row">
                    <div class="col-lg-6 mb-3">
                        <label for="crear_flegal_select">{{__('Fundamento legal')}}</label>&nbsp;<span
                            style="color: red">*</span>
                        <select
                            class="form-control flegal_select select2"
                            id="crear_flegal_select"
                            name="crear_flegal_select"
                            required multiple="multiple">
                            <option label="Label"></option>
                            @if(isset($fundamentos))
                                @foreach($fundamentos as $fundamento)
                                    <option
                                        value="{{$fundamento->clave_fundamento_legal}}">{{$fundamento->fundamento_legal}}</option>
                            @endforeach
                        @endif
                        <!--
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
                            -->
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="crear_observaciones">{{ __('Observaciones') }}</label>
                        <textarea
                            class="form-control"
                            id="crear_observaciones"
                            name="crear_observaciones"
                            rows="3"
                            value="{{old('crear_observaciones')}}"></textarea>
                    </div>
                </div>
                <!-- CONTRATO ABIERTO -->

                <!-- Radio button monto o cantidad
                <div id="elemento_opcional_radiobtn" style="display: none">
                    <div class="separator separator-dashed my-8"></div>
                    <div class="my-6"><p style="font-size: 1rem" class="form-text text-muted h3">Montos o Cantidades</p>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 mb-3">
                            <label for="">Elige por monto ó cantidad</label>
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" name="element1" value="monto"><span></span>Monto
                                </label>
                                <label class="radio">
                                    <input type="radio" name="element1" value="cantidad"><span></span>Cantidad
                                </label>
                            </div>
                            <span style="font-size: 1rem" class="form-text text-muted">Informacion adicional acerca de monto ó cantidad</span>
                        </div>
                    </div>

                    <div class="form-group row" id="sec_monto" style="display: none">
                        <div class="col-lg-6 mb-3">
                            <label for="">Monto (mínimo)</label>
                            <input type="number" class="form-control" id="monto_minimo" name="monto_minimo">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="">Monto (máximo)</label>
                            <input type="number" class="form-control" id="monto_maximo" name="monto_maximo">
                        </div>
                    </div>
                </div>
                -->
                <!-- END CONTRATO ABIERTO -->

                <div class="crear_adjudicacion-selected" style="display: none">
                    <div class="separator separator-dashed my-8"></div>
                    <div class="my-6"><p style="font-size: 1rem" class="form-text font-weight-bold h3 adquisicion-title">Crear Adquisición</p></div>
                    {{--numero de requisicion, origen de recurso--}}
                    <div class="form-group row">
                        <div class="col-lg-6 mb-3">
                            <label for="numero_requisicion">Número de Requisición</label> &nbsp;<span style="color: red">*</span>
                            <input class="form-control sec-adjudicar" type="text" id="numero_requisicion"
                                   name="numero_requisicion" autocomplete="off">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="crear_orecurso_select">{{__('Origen del recurso')}}</label>
                            <select
                                class="orecursos_select select2 sec-adjudicar"
                                id="crear_orecurso_select"
                                name="crear_orecurso_select"
                                data-width="100%"
                                required>
                                <option label="Label"></option>
                                @if(isset($origenes))
                                    @foreach($origenes as $origen)
                                        <option
                                            value="{{$origen->clave_origen_recurso}}">{{$origen->origen_recurso}}</option>
                                @endforeach
                            @endif
                            <!--
                            <option>Seguro Popular</option>
                            <option>Equipamiento con recursos federales</option>
                            <option>Programa de Violencia de Género</option>
                            <option>Cruzada Nacional por la calidad de los SS</option>
                            <option>Recursos autogenerados</option>
                            -->
                            </select>
                        </div>
                    </div>

                    {{--tipo de movimiento, numero de licitacion --}}
                    <div class="form-group row">
                        <div class="col-lg-6 mb-3">
                            <label
                                for="crear_tipomovimiento_select">{{__('Tipo de adquisición')}}</label>
                            <select
                                class="tipomovimiento_select select2 sec-adjudicar"
                                id="crear_tipomovimiento_select"
                                name="crear_tipomovimiento_select"
                                data-width="100%"
                                required>
                                <option label="Label"></option>
                                <option value="adjudicacion_directa">Adjudicación Directa</option>
                                <option value="licitacion1">Licitación por Invitación restringida
                                </option>
                                <option value="licitacion2">Licitación Pública Internacional</option>
                                <option value="licitacion3">Licitación Pública Nacional</option>
                                <option value="licitacion4_consolidada">Licitación Pública Internacional Consolidada
                                </option>
                                <option value="licitacion5_consolidada">Licitación Pública Nacional Consolidada
                                </option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3" style="display:none;"
                             id="elemento_opcional_contratos2">
                            <label for="crear_licitation">{{ __('Número de Licitación') }}</label>&nbsp;<span
                                style="color: red">*</span>
                            <input id="crear_licitacion" type="text"
                                   class="form-control sec-adjudicar"
                                   name="crear_licitacion"
                                   value="{{ old('crear_licitacion') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-6 mb-3" style="display: none" id="unidades_consolidadoras">
                            <label
                                for="unidad_consolidadora_select">{{__('Unidad Consolidadora')}}</label>&nbsp;<span
                                style="color: red">*</span>
                            <select
                                class="unidad_consolidadora_select select2 sec-adjudicar"
                                id="unidad_consolidadora"
                                name="unidad_consolidadora"
                                data-width="100%">
                                <option label="Label"></option>
                                @if(isset($unidades_consolidadoras))
                                @foreach($unidades_consolidadoras as $unidad)
                                        <option value="{{$unidad->clave_unidad_consolidadora}}">{{$unidad->unidad_consolidadora}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <hr>
                    {{--Begin: proveedor: --}}
                    <div class="pb-5" data-wizard-type="step-content">
                        <label for="">PROVEEDOR</label>
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>RFC</label>

                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-lg sec-adjudicar"
                                       aria-label="botón para buscar el rfc en el padrón de proveedores"
                                       name="rfc_del_proveedor" id="rfc_del_proveedor"
                                       value="{{$adquisicion->proveedor->rfc ?? ''}}"/>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary " id="btn-proveedor-search">
                                        Buscar RFC
                                    </button>
                                </div>
                            </div>
                            <span class="form-text text-muted"></span>
                        </div>
                        <!--end::Input-->


                        <div class="row">

                            <div class="col-xl-6">
                                <!--begin::Select-->
                                <div class="form-group">
                                    <label>Tipo de persona</label>
                                    <select name="tipo_de_persona"
                                            class="form-control form-control-solid form-control-lg sec-adjudicar"
                                            disabled id="tipo_de_persona">
                                        <option value="">Selecionar...</option>
                                        <option value="F">Fisica</option>
                                        <option value="M">Moral</option>
                                    </select>
                                </div>
                                <!--end::Select-->
                            </div>
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Razón social</label>
                                    <input type="text"
                                           class="form-control form-control-solid form-control-lg sec-adjudicar"
                                           name="razon_social_del_proveedor" id="razon_social_del_proveedor"
                                           placeholder="" value="{{$adquisicion->proveedor->razon_social ?? ''}}"
                                           disabled/>
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--begin::Input-->
                        <div class="form-group">
                            <label>Representante legal:</label>
                            <input type="text" class="form-control form-control-solid form-control-lg sec-adjudicar"
                                   name="representante_del_proveedor" id="representante_del_proveedor"
                                   placeholder="" value="" disabled/>
                            <span class="form-text text-muted"></span>
                        </div>
                        <!--end::Input-->
                        <div class="row persona_fisica_content">
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input type="text"
                                           class="form-control form-control-solid form-control-lg sec-adjudicar"
                                           name="nombres" placeholder="" id="nombres"
                                           value="{{$adquisicion->proveedor->fisica_nombre ?? ''}}" disabled/>
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Primer apellido</label>
                                    <input type="text"
                                           class="form-control form-control-solid form-control-lg sec-adjudicar"
                                           name="primer_apellido" id="primer_apellido" placeholder=""
                                           value="{{$adquisicion->proveedor->fisica_primer_ap ?? ''}}" disabled/>
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>
                        <div class="row persona_fisica_content">
                            <div class="col-xl-6">
                                <!--begin::Input-->
                                <div class="form-group">
                                    <label>Segundo apellido</label>
                                    <input type="text"
                                           class="form-control form-control-solid form-control-lg sec-adjudicar"
                                           name="segundo_apellido" id="segundo_apellido" placeholder=""
                                           value="{{$adquisicion->proveedor->fisica_segundo_ap ?? ''}}" disabled/>
                                    <span class="form-text text-muted"></span>
                                </div>
                                <!--end::Input-->
                            </div>
                        </div>

                    </div>
                    {{--End:: Proveedor--}}
                </div>

            </div>
            <div class="modal-footer">
                <input type="submit" id="btn-wiz-1" class="btn btn-success nextBtnW"
                       value="Guardar">
            </div>
        </form>
    </div>

    <!-- BEGIN: campos origen recurso, almacenes, tipo de movimiento, proveedor -->
    <div class="content-wizard" id="proveedor_validar_contrato" style="display: none">

    </div>

@endsection
