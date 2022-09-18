@extends('entradas.fondoOficina.layout')

@section('FOC_subheader_elements')
<li class="breadcrumb-item text-muted">
    <span class="text-muted">Datos de carpeta</span>
</li>
@endsection

@section('FOC_content')
    
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="card card-custom">
            <div class="card-body p-0">
                <!--begin::Wizard-->
                <div class="wizard wizard-1" id="kt_wizard_v1" data-wizard-state="step-first" data-wizard-clickable="false">
                    <!--begin::Wizard Nav-->
                    <div class="wizard-nav border-bottom">
                        <div class="wizard-steps p-8 p-lg-10">
                            <!--begin::Wizard Step 1 Nav-->
                            <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                <div class="wizard-label">
                                    <i class="wizard-icon flaticon-folder"></i>
                                    <h3 class="wizard-title">1. Datos de la carpeta</h3>
                                </div>
                                <span class="svg-icon svg-icon-xl wizard-arrow">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                            <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Wizard Step 1 Nav-->

                            <!--begin::Wizard Step 2 Nav-->
                            <!--end::Wizard Step 2 Nav-->
                            
                            <!--begin::Wizard Step 3 Nav-->
                            <!--end::Wizard Step 3 Nav-->

                            <!--begin::Wizard Step 4 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-label">
                                    <i class="wizard-icon flaticon-truck"></i>
                                    <h3 class="wizard-title">2. Datos del proveedor</h3>
                                </div>
                                <span class="svg-icon svg-icon-xl wizard-arrow">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                            <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Wizard Step 4 Nav-->
                            <!--begin::Wizard Step 5 Nav-->
                            <div class="wizard-step" data-wizard-type="step">
                                <div class="wizard-label">
                                    <i class="wizard-icon flaticon-list"></i>
                                    <h3 class="wizard-title">3. Revisar y Guardar</h3>
                                </div>
                                <span class="svg-icon svg-icon-xl wizard-arrow last">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24" />
                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                            <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Wizard Step 5 Nav-->
                        </div>
                    </div>
                    <!--end::Wizard Nav-->
                    <!--begin::Wizard Body-->
                    <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                        <div class="col-xl-12 col-xxl-7">
                            <!--begin::Wizard Form-->
                            <form class="form" id="kt_form" action="{{route('entradas.fondoOficinas.update',[$adquisicionId])}}" method="post">
                                @method('PUT')
                                @csrf
                                <!--begin::Wizard Step 1-->
                                <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                    


                                    <div class="row">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Oficio adjudicación</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="oficio_de_adjudicacion" placeholder="" value="{{$adquisicion->num_oficio_adjudicacion}}" id="oficio_de_adjudicacion"/>
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Número de requisición</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="numero_de_requisicion" placeholder="" value="{{$adquisicion->num_requisicion}}" />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                       
                                    </div>
                                </div>
                                <!--end::Wizard Step 1-->

                                <!--begin::Wizard Step 2-->
                                <!--end::Wizard Step 2-->

                                <!--begin::Wizard Step 3-->
                                <!--end::Wizard Step 3-->


                                <!--begin::Wizard Step 4-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <h4 class="mb-10 font-weight-bold text-dark">Busqueda del proveedor</h4>
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>RFC</label>
                                        
                                        <div class="input-group input-group-solid">
                                            <input type="text" class="form-control form-control-lg" aria-label="botón para buscar el rfc en el padrón de proveedores" name="rfc_del_proveedor" id="rfc_del_proveedor" value="{{$adquisicion->proveedor->rfc}}" id=""/>
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
                                                <select name="tipo_de_persona" class="form-control form-control-solid form-control-lg" disabled id="tipo_de_persona">
                                                    <option value="">Selecionar...</option>
                                                    <option value="F" {{ ($adquisicion->proveedor->tipo_persona=='F') ? 'selected' : ''}}>Fisica</option>
                                                    <option value="M" {{ ($adquisicion->proveedor->tipo_persona=='M') ? 'selected' : ''}}>Moral</option>
                                                </select>
                                            </div>
                                            <!--end::Select-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Razón social</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="razon_social_del_proveedor" id="razon_social_del_proveedor" placeholder="" value="{{$adquisicion->proveedor->razon_social}}" disabled />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <!--begin::Input-->
                                    <div class="form-group">
                                        <label>Representante legal:</label>
                                        <input type="text" class="form-control form-control-solid form-control-lg" name="representante_del_proveedor" id="representante_del_proveedor" placeholder="" value="" disabled/>
                                        <span class="form-text text-muted"></span>
                                    </div>
                                    <!--end::Input-->
                                    <div class="row persona_fisica_content"  style="display: {{ ($adquisicion->proveedor->tipo_persona=='F') ? '' : 'none'}};">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Nombres</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="nombres" placeholder="" id="nombres" value="{{$adquisicion->proveedor->fisica_nombre}}" disabled />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Primer apellido</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="primer_apellido" id="primer_apellido" placeholder="" value="{{$adquisicion->proveedor->fisica_primer_ap}}" disabled/>
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="row persona_fisica_content" style="display: {{ ($adquisicion->proveedor->tipo_persona=='F') ? '' : 'none'}};">
                                        <div class="col-xl-6">
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Segundo apellido</label>
                                                <input type="text" class="form-control form-control-solid form-control-lg" name="segundo_apellido" id="segundo_apellido" placeholder="" value="{{$adquisicion->proveedor->fisica_segundo_ap}}" disabled />
                                                <span class="form-text text-muted"></span>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    
                                </div>
                                <!--end::Wizard Step 4-->
                                <!--begin::Wizard Step 5-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    
                                    <!--begin::Section-->
                                    <div class="alert alert-secundary mb-0 p-5" role="alert">
                                        <h4 class="alert-heading">Bien!</h4>
                                        <p>has capturado los datos necesarios.</p>
                                        <div class="border-bottom border-white opacity-20 mb-5"></div>
                                        <p class="mb-0">¿Estás seguro de editar los datos relacionados con la carpeta ?</p>
                                    </div>
                                    
                                    <!--end::Section-->
                                    
                                   
                                </div>
                                <!--end::Wizard Step 5-->
                                <!--begin::Wizard Actions-->
                                <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                    <div class="mr-2">
                                        <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Anterior</button>
                                    </div>
                                    <div>
                                        <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">Aceptar</button>
                                        <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Siguiente</button>
                                    </div>
                                </div>
                                <!--end::Wizard Actions-->
                            </form>
                            <!--end::Wizard Form-->
                        </div>
                    </div>
                    <!--end::Wizard Body-->
                </div>
            </div>
            <!--end::Wizard-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection

@section('scripts')
    <link href="{{asset('css/pages/wizard/wizard-1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/pages/wizard/sedesa/wizard-1.css')}}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{asset('js/proveedores/proveedores.js')}}"></script>
    
    <script type="text/javascript">
        function clearProveedorFields(){
            $('#razon_social_del_proveedor').val("");
            $('#nombres').val("");
            $('#primer_apellido').val("");
            $('#segundo_apellido').val("");
            $('#tipo_de_persona option[value=M]').prop('selected',null);
            $('#tipo_de_persona option[value=F]').prop('selected',null);
            $(".persona_fisica_content").hide();
            $('#representante_del_proveedor').val("");
            
        }
        function enableProveedorFields(){
            $('#razon_social_del_proveedor').attr('disabled', false);
            $('#nombres').attr('disabled', false);
            $('#primer_apellido').attr('disabled', false);
            $('#segundo_apellido').attr('disabled', false);
            $('#tipo_de_persona').attr('disabled', false);
            $("#representante_del_proveedor").attr('disabled', false);
            
        }

        function disabledProveedorFields(){
            $('#razon_social_del_proveedor').attr('disabled', true);
            $('#nombres').attr('disabled', true);
            $('#primer_apellido').attr('disabled', true);
            $('#segundo_apellido').attr('disabled', true);
            $('#tipo_de_persona').attr('disabled', true);
            $("#representante_del_proveedor").attr('disabled', true);
            
        }
        $('select[name="tipo_de_persona"]').change(function(param){
            switch ($(this).val()) {
              case 'F':
                $(".persona_fisica_content").show();
                break;
              case 'M':
                $(".persona_fisica_content").hide();
                $('#nombres').val("");
                $('#primer_apellido').val("");
                $('#segundo_apellido').val("");
                break;
              default:
                //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                break;
            }
            _validations[1].revalidateField("razon_social_del_proveedor");
            _validations[1].revalidateField("nombres");
            _validations[1].revalidateField("primer_apellido");
            _validations[1].revalidateField("segundo_apellido");
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
                             $('#tipo_de_persona option[value=M]').prop('selected',null);
                            $('#tipo_de_persona option[value=F]').prop('selected','selected');
                            $('#representante_del_proveedor').val('--');
                            $(".persona_fisica_content").show();
                            break;
                          case 'moral':
                          console.log("persona moral");
                            //console.log(res.data.tipo_persona.toLowerCase());
                            $('#razon_social_del_proveedor').val(res.data.razon_social);
                            $('#nombres').val('--');
                            $('#primer_apellido').val('--');
                            $('#segundo_apellido').val('--');
                            $('#tipo_de_persona option[value=F]').prop('selected',null);
                            $('#tipo_de_persona option[value=M]').prop('selected','selected');
                            $('#representante_del_proveedor').val('--');
                            $(".persona_fisica_content").hide();
                            break;
                          default:
                            //Declaraciones ejecutadas cuando ninguno de los valores coincide con el valor de la expresión
                            break;
                        }
                        _validations[1].revalidateField("tipo_de_persona");
                        _validations[1].revalidateField("razon_social_del_proveedor");
                        

                    }
                }else{//ERROR AL CONSUMIR EL WS
                    //
                    //TODO::si existe un error entonces abrir los campos para captura
                    swal.fire(
                            "Lo lamento!",
                            "El servicio de busqueda del proveedor no esta habilitado, así que deberás agregar los datos del proveedor <strong>Manualmente</strong>",
                            "warning"
                        );
                     clearProveedorFields();
                     enableProveedorFields();
                }
                //seteando valores
            });
            
        });//end::click btn proveedor search


       "use strict";
       // Base elements
            var _wizardEl;
            var _formEl;
            var _wizard;
            var _validations = [];
        // Class definition
        var KTWizard1 = function () {
            

            // Private functions
            var initWizard = function () {
                // Initialize form wizard
                _wizard = new KTWizard(_wizardEl, {
                    startStep: 1, // initial active step number
                    clickableSteps: true  // allow step clicking
                });

                // Validation before going to next page
                _wizard.on('beforeNext', function (wizard) {
                    _validations[wizard.getStep() - 1].validate().then(function (status) {
                        if (status == 'Valid') {
                            _wizard.goNext();
                            KTUtil.scrollTop();
                        } else {
                            swal.fire({
                                text: "¡Lo lamento!, se ha detectado un algunos errores, por favor intentalo de nuevo.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Aceptar",
                                confirmButtonClass: "btn font-weight-bold btn-light"
                            }).then(function () {
                                KTUtil.scrollTop();
                            });
                        }
                    });

                    _wizard.stop();  // Don't go to the next step
                });

                // Change event
                _wizard.on('change', function (wizard) {
                    KTUtil.scrollTop();
                });
            }

            var initValidation = function () {
                // Step 1
                _validations.push(FormValidation.formValidation(
                    _formEl,
                    {
                        fields: {
                            folio: {
                                validators: {
                                    notEmpty: {
                                        message: 'El folio de la carpeta es requerido'
                                    }
                                }
                            },
                            oficio_de_adjudicacion: {
                                validators: {
                                    notEmpty :{
                                        message:'El oficio de adjudicación es requerido'
                                    },
                                    
                                    remote: {

                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        method: 'POST',
                                        type: 'POST',
                                        dataType : 'jsonp',
                                        contentType: "application/json; charset=utf-8",                                       
                                        async: true,
                                        url: "{{route('adquisicion.check_adjudicacion')}}",
                                        delay: 1000,
                                        message: 'Ya existe un proceso de adquisición con este oficio de adjudicación ',
                                        // Send { username: 'its value', email: 'its value' } to the back-end
                                        data: function() {
                                            return {
                                                oficio_de_adjudicacion : _formEl.querySelector('input[name="oficio_de_adjudicacion"]').value,
                                                form_validation_format : true,
                                                adquisicion : '{{$adquisicionId}}',
                                            };
                                        },
                                    },
                                }
                            },
                            
                            numero_de_requisicion: {
                                validators: {
                                    
                                    remote: {
                                        message: 'Ya existe una requisición con este número ',
                                        //method: 'GET',
                                        delay: 1000,
                                        type: 'GET',
                                        url: url+'/adquisiciones/checkExistAdquisicion/requisicionHaveAny/',
                                        data: function() {
                                            return {
                                                numero_de_requisicion : _formEl.querySelector('input[name="numero_de_requisicion"]').value,
                                                form_validation_format : true,
                                                adquisicion : '{{$adquisicionId}}',
                                            };
                                        },
                                    },
                                }
                            },
                            
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap()
                        }
                    }
                ));

                
                // Step 2
                _validations.push(FormValidation.formValidation(
                    _formEl,
                    {
                        fields: {
                            rfc_del_proveedor: {
                                validators: {
                                    notEmpty: {
                                        message: 'El rfc del proveedor es requerido'
                                    }
                                }
                            },
                            tipo_de_persona: {
                                validators: {
                                    notEmpty: {
                                        message: 'Aún no se ha especificado el tipo de persona'
                                    }
                                }
                            },
                            razon_social_del_proveedor: {
                                validators: {
                                    callback: {
                                        message: 'la razon social del proveedor es requerida',
                                        callback: function(input) {
                                            if(input.value==''){
                                                if($( "#tipo_de_persona option:selected" ).val()=='M'){
                                                    return false;
                                                }else{
                                                    return true;
                                                }
                                            }else{
                                                return true;
                                            }
                                        }
                                    }
                                }
                            },
                            nombres: {
                                validators: {
                                    callback: {
                                        message: 'Es necesario proporcionar el nombre de la persona física',
                                        callback: function(input) {
                                            if(input.value==''){
                                                if($( "#tipo_de_persona option:selected" ).val()=='F'){
                                                    return false;
                                                }else{
                                                    return true;
                                                }
                                            }else{
                                                return true;
                                            }
                                        }
                                    }
                                }
                            },
                            primer_apellido: {
                                validators: {
                                    callback: {
                                        message: 'Es necesario proporcionar el primer apellido de la persona física',
                                        callback: function(input) {
                                            if(input.value==''){
                                                if($( "#tipo_de_persona option:selected" ).val()=='F'){
                                                    return false;
                                                }else{
                                                    return true;
                                                }
                                            }else{
                                                return true;
                                            }
                                        }
                                    }
                                }
                            },
                            segundo_apellido: {
                                validators: {
                                    callback: {
                                        message: 'Es necesario proporcionar el segundo apellido de la persona física',
                                        callback: function(input) {
                                            if(input.value==''){
                                                if($( "#tipo_de_persona option:selected" ).val()=='F'){
                                                    return false;
                                                }else{
                                                    return true;
                                                }
                                            }else{
                                                return true;
                                            }
                                        }
                                    }
                                }
                            },
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap()
                        }
                    }
                ));
            }

            return {
                // public functions
                init: function () {
                    _wizardEl = KTUtil.getById('kt_wizard_v1');
                    _formEl = KTUtil.getById('kt_form');

                    initWizard();
                    initValidation();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTWizard1.init();
            //$("#btn-proveedor-search").click();
            



           
            

                                       
        });

    </script>
@endsection