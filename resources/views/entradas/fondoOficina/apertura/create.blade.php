@extends('layout.default')


@section('content')

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
                    <span class="text-muted">Contratos abiertos</span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Nueva carpeta</span>
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

<div>
    <br><br>
</div>

<!--begin::INICIA CARD 2-->
<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-chat-1 text-primary"></i>
            </span>
            <h3 class="card-label">
                Datos de Apertura
            </h3>
        </div>
    </div>
    <div class="card-body">
        
        <form name="" id="frm_nueva_entrada" action="{{route('entradas.fondoOficinas.store')}}" method="post">
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
                    <label>Número de contrato:</label>
                    <input id="numero_de_contrato" type="text" class="form-control{{ $errors->has('numero_de_contrato') ? ' is-invalid' : '' }}" name="numero_de_contrato" value="{{ old('numero_de_contrato') }}"  autofoc>
                    @if ($errors->has('numero_de_contrato'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('numero_de_contrato') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-lg-3">
                    <label>Número de requisición:</label>
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
                            <button class="btn btn-primary" type="button" id="btn-proveedor-search">buscar</button>
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
                    <label>{{ __('Tipo de persona:') }}</label>
                    <div class="radio-inline">
                        <label class="radio">
                            <input type="radio" name="tipo_de_persona" id="tipo_de_persona_fisica" class="" value="F" disabled="" />{{ old('tipo_de_persona') }} Física
                            <span></span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="tipo_de_persona" id="tipo_de_persona_moral" class="" value="M" disabled="" />{{ old('tipo_de_persona') }} Moral
                            <span></span>
                        </label>
                    </div>
                </div>
                
            </div>

            <div class="form-group row">
                
                <div class="col-lg-4">
                    <label>{{ __('Representante:') }}</label>
                    <input  type="text" class="form-control{{ $errors->has('representante_del_proveedor') ? ' is-invalid' : '' }}" id="representante_del_proveedor" name="representante_del_proveedor" value="{{ old('representante_del_proveedor') }}" disabled="" autofoc>
                </div>
                
            </div>

            <div class="form-group row" id="persona_fisica_content" style="display: none;">
                <div class="col-lg-4">
                    <label>{{ __('Nombres:') }}</label>
                    <input type="text" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" value="{{ old('nombres') }}" id="nombres" disabled="" autofoc >
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Primer apellido:') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control{{ $errors->has('primer_apellido') ? ' is-invalid' : '' }}" name="primer_apellido" id="primer_apellido" value="{{ old('primer_apellido') }}" disabled="" autofoc>
                    </div>
                </div>
                <div class="col-lg-4">
                    <label>{{ __('Segundo apellido:') }}</label>
                    <div class="input-group">
                        <input type="text" class="form-control{{ $errors->has('segundo_apellido') ? ' is-invalid' : '' }}" name="segundo_apellido" id="segundo_apellido" value="{{ old('segundo_apellido') }}" disabled="" autofoc>
                    </div>
                </div>
                
            </div>

            

        <div class="card-footer">
            <div class="row">
                <div class="col-lg-9"></div>
                <div class="col-lg-3">
                    <button type="reset" class="btn btn-secondary">Cancelar</button>
                    <button type="submit" href="" class="btn btn-primary font-weight-bold">Guardar</button>
                </div>
            </div>
        </div>      
    </form>
    <!-- end:: TERMINA FORMULARIO DATOS GENERALES -->
 </div>
</div>
<!--begin::TERMININA CARD 2 -->



@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/proveedores/proveedores.js')}}"></script>

    <script type="text/javascript">
        
        function clearProveedorFields(){
            $('#razon_social_del_proveedor').val("");
            $('#nombres').val("");
            $('#primer_apellido').val("");
            $('#segundo_apellido').val("");
            $('#tipo_de_persona_fisica').prop('checked', false);
            $('#tipo_de_persona_moral').prop('checked', false);
            $("#persona_fisica_content").hide();
            $('#representante_del_proveedor').val("");
            
        }
        function enableProveedorFields(){
            $('#razon_social_del_proveedor').attr('disabled', false);
            $('#nombres').attr('disabled', false);
            $('#primer_apellido').attr('disabled', false);
            $('#segundo_apellido').attr('disabled', false);
            $('#tipo_de_persona_fisica').attr('disabled', false);
            $('#tipo_de_persona_moral').attr('disabled', false);
            $("#persona_fisica_content").attr('disabled', false);
            $("#representante_del_proveedor").attr('disabled', false);
            
        }

        function disabledProveedorFields(){
            $('#razon_social_del_proveedor').attr('disabled', true);
            $('#nombres').attr('disabled', true);
            $('#primer_apellido').attr('disabled', true);
            $('#segundo_apellido').attr('disabled', true);
            $('#tipo_de_persona_fisica').attr('disabled', true);
            $('#tipo_de_persona_moral').attr('disabled', true);
            $("#persona_fisica_content").attr('disabled', true);
            $("#representante_del_proveedor").attr('disabled', true);
            
        }
        $('input:radio[name="tipo_de_persona"]').change(function(param){
            switch ($(this).val()) {
              case 'F':
                $("#persona_fisica_content").show();
                break;
              case 'M':
                $("#persona_fisica_content").hide();
                $('#nombres').val("");
                $('#primer_apellido').val("");
                $('#segundo_apellido').val("");
                break;
              default:
                //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                break;
            }
        });
        //option A
        $("#frm_nueva_entrada").submit(function(e){
            var form = this;
            e.preventDefault();
                swal.fire({
                    title: "¿Estas seguro?",
                    text: "Estás a punto de crear una carpeta para entradas por contrato abierto",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Si estoy seguro!",
                    cancelButtonText: "No, cancelar!",
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                       form.submit();
                    } else if (result.dismiss === "cancel") {
                        return ;
                    }
                });
        });

        $("#btn-proveedor-search").click(function(a){
            var rfc_proveedor = $("#rfc_del_proveedor").val();
            ws_proveedorBuscar(rfc_proveedor,function(res){
                if(res.error.code ==0){
                    if(typeof(res.data) =='undefined'){
                        swal.fire(
                            "Lo lamento!",
                            "El proveedor no fue encontrado.<br> ¿su rfc es correcto?",
                            "warning"
                        );
                        disabledProveedorFields();
                        clearProveedorFields();
                    }else{
                        //TODO::SE ENCONTRÓ LLENAR LOS CAMPOS
                        swal.fire(
                            "Exito",
                            "Proveedor encontrado",
                            "success"
                        );
                        disabledProveedorFields();
                        switch (res.data.tipo_persona.toLowerCase()) {
                          case 'fisica':
                            $('#razon_social_del_proveedor').val("--");
                            $('#nombres').val(res.data.nombre);
                            $('#primer_apellido').val(res.data.paterno);
                            $('#segundo_apellido').val(res.data.materno);
                            $('#tipo_de_persona_moral').prop('checked', false);
                            $('#tipo_de_persona_fisica').prop('checked', true);
                            $('#representante_del_proveedor').val('--');
                            $("#persona_fisica_content").show();
                            break;
                          case 'moral':
                            //console.log(res.data.tipo_persona.toLowerCase());
                            $('#razon_social_del_proveedor').val(res.data.razon_social);
                            $('#nombres').val('--');
                            $('#primer_apellido').val('--');
                            $('#segundo_apellido').val('--');
                            $('#tipo_de_persona_fisica').prop('checked', false);
                            $('#tipo_de_persona_moral').prop('checked', true);
                            $('#representante_del_proveedor').val('--');
                            $("#persona_fisica_content").hide();
                            break;
                          default:
                            //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                            break;
                        }
                    }
                }else{//ERROR AL CONSUMIR EL WS
                    //
                    //TODO::si existe un error entonces abrir los campos para captura
                    swal.fire(
                            "Lo lamento!",
                            "El servicio de busqueda del proveedor no esta habilitado, así que deberás agregar los datos del proveedor <strong>Manualmente</strong>",
                            "warning"
                        );
                     //clearProveedorFields();
                     enableProveedorFields();
                }
                //seteando valores
            });
            
        });//end::click btn proveedor search

        $( document ).ready(function() {
            if($("#rfc_del_proveedor").val()==""){
            }else{
                $("#btn-proveedor-search").click();
            }
        });
    </script>
@endsection