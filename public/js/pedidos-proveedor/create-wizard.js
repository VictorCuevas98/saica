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
            startStep: 0, // initial active step number
            clickableSteps: true // allow step clicking
        });

        // Validation before going to next page
        _wizard.on('beforeNext', function (wizard) { 
            _validations[wizard.getStep() - 1].validate().then(function (status) {
                if (status == 'Valid') {
                    switch (wizard.getStep() - 1) {
                        case 0:
                            buscaContrato();
                            break;
                        case 1:
                            if (proveedorValido || proveedorManual) {
                                actualizaProveedor();
                            } else
                                swal.fire({
                                    text: 'Debes seleccionar un proveedor valido.',
                                    icon: 'error'
                                });
                            break;
                        default:
                            console.log(`Paso no manejado: ${wizard.getStep()}`);
                            break;
                    }
                } else {
                    swal.fire({
                        text: "Algunos campos son requeridos, completalos para continuar.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Aceptar",
                        confirmButtonClass: "btn font-weight-bold btn-light"
                    }).then(function () {
                        KTUtil.scrollTop();
                    });
                }
            });

            _wizard.stop(); // Don't go to the next step
        });

        // Change event
        _wizard.on('change', function (wizard) {
            KTUtil.scrollTop();
        });
    }

    var initValidation = function () {
        // Step 1
        _validations.push(FormValidation.formValidation(
            _formEl, {
                fields: {
                    adjudicacionInput: {
                        validators: {
                            notEmpty: {
                                message: 'El oficio de adjudicacion es requerido.'
                            }
                            /*
                            callback: {
                                //message: 'El oficio de adjudicación es requerido en caso de que esten vacios el número de contrato y número de requisición',

                                message: 'El oficio de adjudicación es requerido',
                                callback: function (input) {
                                    if (input.value.trim().length == 0) {
                                       // if ($('#requisicionInput').val().trim().length == 0 || $('#contratoInput').val().trim().length == 0) {

                                        //if ($('input[name="requisicionInput"]').val() == '' && $('input[name="contratoInput"]').val() == '') {
                                            return false;
                                        //} else {
                                          //  return true;
                                        //}
                                    } else {
                                        return true;
                                    }
                                }
                            }*/
                        }
                    },
                    contratoInput: {
                        validators: {
                            notEmpty: {
                                message: 'El número de contrato es requerido.',
                            }
                        }
                    },
                    /*
                    requisicionInput: {
                        validators: {
                            notEmpty: {
                                message: 'El número de requisición es requerido.',
                            }
                        }
                    },*/

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));


        // Step 2
        _validations.push(FormValidation.formValidation(
            _formEl, {
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
                                callback: function (input) {
                                    if (input.value == '') {
                                        if ($("#tipo_de_persona option:selected").val() == 'M') {
                                            return false;
                                        } else {
                                            return true;
                                        }
                                    } else {
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
                                callback: function (input) {
                                    if (input.value == '') {
                                        if ($("#tipo_de_persona option:selected").val() == 'F') {
                                            return false;
                                        } else {
                                            return true;
                                        }
                                    } else {
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
                                callback: function (input) {
                                    if (input.value == '') {
                                        if ($("#tipo_de_persona option:selected").val() == 'F') {
                                            return false;
                                        } else {
                                            return true;
                                        }
                                    } else {
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
                                callback: function (input) {
                                    if (input.value == '') {
                                        if ($("#tipo_de_persona option:selected").val() == 'F') {
                                            return false;
                                        } else {
                                            return true;
                                        }
                                    } else {
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

const goNext = () =>{
    _wizard.goNext();
    var step = _wizard.getStep()-1;
    if(step == 2)
        $('#buttonGenerar').show();
    KTUtil.scrollTop();
};

const goPrev = () =>{
    $('#buttonGenerar').hide();
    //_wizard.goPrev();
};

jQuery(document).ready(function () {
    KTWizard1.init();
});
