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
            <!--begin::Separator-->
            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
            <!--end::Separator-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Fondo de Oficinas Centrales</span>
                </li>
                 <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Lista de revisión</span>
                </li>
                <li class="breadcrumb-item text-muted">
                    <span class="text-muted">Nueva</span>
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
                <a  href="{{route('entradas.fondoOficinas.checklist.index',$adquisicionId)}}" class="btn btn-success font-weight-bold btn-sm px-4 font-size-base ml-2" >Regresar</a>
            <!--end::Button-->

        </div>
        <!--end::Toolbar-->
    </div>
</div>
<!-- end::Subheader -->


<div class="row" >
    @if(count( $errors ) > 0)
       @foreach ($errors->all() as $error)
          <!-- Alert with image / icon -->
            <div class="alert alert-danger"> <img src="{{asset('xtreme-admin/assets/images/users/1.jpg')}}" width="30" class="rounded-circle" alt="img"> {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
      @endforeach
    @endif
</div>
@if(Session::has('flash'))
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-success">
                                <strong>{{session('flash')}}</strong>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif






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
                                                            <i class="wizard-icon fas fa-boxes  "></i>
                                                            <h3 class="wizard-title">1. Datos de la entrada</h3>
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


                                                    <!--begin::Wizard Step 4 Nav-->
                                                    <div class="wizard-step" data-wizard-type="step">
                                                        <div class="wizard-label">
                                                            <i class="wizard-icon fas fa-clipboard-check"></i>
                                                            <h3 class="wizard-title">2. Lista revisión</h3>
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
                                                            <h3 class="wizard-title">3. Revisar y guardar</h3>
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
                                                    <form class="form" id="kt_form" action="{{route('entradas.fondoOficinas.checklist.store',[$adquisicionId])}}"  method="POST">
                                                        @method('POST')
                                                        @csrf
                                                        <!--begin::Wizard Step 1-->
                                                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                                            <div class="row">
                                                                
                                                                <div class="col-xl-6">
                                                                    <!--begin::Select-->
                                                                    <div class="form-group">
                                                                        <label>Almacén de entrada</label>
                                                                        <select name="almacen" class="form-control form-control-solid form-control-lg"  id="ingreso_almacen">
                                                                            <option value="">Selecionar...</option>
                                                                            @foreach($almacenes as $almacen)
                                                                                <option value="{{$almacen->clave_almacen}}">{{$almacen->almacen}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <!--end::Select-->
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <!--begin::Input-->
                                                                    <div class="form-group">
                                                                        <label>fecha de entrada</label>
                                                                        <input type="date" class="form-control form-control-solid form-control-lg" name="fecha_de_entrada" id="fecha_de_entrada" placeholder="" value=""  />
                                                                        <span class="form-text text-muted"></span>
                                                                    </div>
                                                                    <!--end::Input-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Wizard Step 1-->

                                                       

                                                        <!--begin::Wizard Step 4-->
                                                        <div class="pb-5" data-wizard-type="step-content">
                                                            <h4 class="mb-10 font-weight-bold text-dark">Lista de Revisión</h4>
                                                            <!--begin::FORMULARIO DE CHECKLIST-->
            
                                                            <div class="form-group row">
                                                                
                                                                <label  class="col-sm-12 col-md-2 col-lg-2 col-xl-1 col-form-label">Folio</label>
                                                                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3">
                                                                 <input class="form-control" type="text" value="XXX-{{date('m-Y')}}" id="example-text-input" name="folio_de_revision" required="" />
                                                                </div>

                                                                  <label class="col-2 col-form-label">Aprobada</label>
                                                                  <div class="col-3">
                                                                   <span class="switch switch-xl switch-icon">
                                                                    <label>
                                                                     <input type="checkbox"  name="aprobada"  />
                                                                     <span></span>
                                                                    </label>
                                                                   </span>
                                                                  </div>
                                                             </div>
                 

                                                                <div class="separator separator-dashed separator-border-2 mb-10"></div>



                                                            <div class="form-group row">
                                                                @foreach($catTiposRevision as $tipoRevision)
                                                                <!--begin::TABLA REVISION -->
                                                                <div class="col-md-6">
                                                                    <h4>{{$tipoRevision->tipo_revision}}</h4>
                                                                   <table class="table  ">
                                                                        <tbody>
                                                                            @foreach($tipoRevision->catPreguntasRevision()->activos()->get() as $catPregunta)

                                                                            <tr>
                                                                                <td class="">
                                                                                    <span class="switch switch-outline switch-icon switch-success">
                                                                                    <label>
                                                                                        <input type="checkbox"  name="respuestas[]" value="{{$catPregunta->clave_pregunta}}"/>
                                                                                        <span></span>
                                                                                        </label>
                                                                                    </span>
                                                                                </td>
                                                                                <td class="" colspan="3">{{$catPregunta->pregunta}}</td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <!--end::TABLA REVISION -->
                                                                @endforeach

                                                            </div>
                                                            

                                                        
                                                            <!--end::FORMULARIO DE CHECKLIST-->
                                                            
                                                        </div>
                                                        <!--end::Wizard Step 4-->
                                                        <!--begin::Wizard Step 5-->
                                                        <div class="pb-5" data-wizard-type="step-content">
                                                            
                                                            <!--begin::Section-->
                                                            <div class="alert alert-secundary mb-5 p-5" role="alert">
                                                                <h4 class="alert-heading">Bien!</h4>
                                                                <p>has capturado los datos necesarios.</p>
                                                                <div class="border-bottom border-white opacity-20 mb-5"></div>
                                                                <p class="mb-0">¿Estás seguro de crear una carpeta para entrada por contrato abierto?</p>
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
                            almacen: {
                                validators:{
                                    notEmpty: {
                                        message: 'Es necesario seleccionar un almacén'
                                    },
                                }
                            },
                            
                            
                            fecha_de_entrada: {
                                validators: {
                                    notEmpty: {
                                        message: 'Es necesario seleccionar la fecha de ingreso de la mercancía'
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
                            folio_de_revision: {
                                validators: {
                                    notEmpty: {
                                        message: 'El folio de la revisión es requerido'
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
        });

    </script>
@endsection