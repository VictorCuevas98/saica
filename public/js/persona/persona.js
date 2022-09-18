"use strict";
$('input[type=checkbox][name=uploadafter]').change(function() {
    const container = document.getElementById('docs');
  if ($(this).is(':checked')) {
    container.style.display='none';
  }
  else {
    container.style.display='block';
  }
});
// Class definition
var KTWizard2 = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizard;
	var _validations = [];
   
	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		_wizard = new KTWizard(_wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: false // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
		});
        $('#guardaP').click(function(){
            _validations[1].validate().then(function (status) {
				if (status == 'Valid') {
                    $('#guardaP').attr("disabled", true);
                    $("#guardaP").addClass("spinner spinner-white spinner-right");
                }else{
					swal.fire({
						text: "Debes capturar los campos obligatorios, inténtalo de nuevo.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok!",
						confirmButtonClass: "btn font-weight-bold btn-light"
					}).then(function () {
                        $('#guardaP').attr("disabled", false);
                        $("#guardaP").removeClass("spinner spinner-white spinner-right");
						KTUtil.scrollTop();
					});
                }
            })
        }),
		// Validation before going to next page
		_wizard.on('beforeNext', function (wizard) {
			_validations[wizard.getStep() - 1].validate().then(function (status) {
				if (status == 'Valid') {
					_wizard.goNext();
                    KTUtil.scrollTop();
				} else {
					swal.fire({
						text: "Debes capturar los campos obligatorios, inténtalo de nuevo.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok!",
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
            _validations.push(FormValidation.formValidation(
                _formEl,
                {
                    fields: {
                        cpostal_fiscal: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese un código postal'
                                }
                            }
                        },
                        id_entidad_fiscal: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione una entidad federativa'
                                }
                            }
                        },
                        id_alcaldia_fiscal: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione alcaldía o municipio'
                                }
                            }
                        },
                        id_colonia_fiscal: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione colonia'
                                }
                            }
                        },
                        calle_fiscal: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese la calle'
                                }
                            }
                        },
                        nexterior_fiscal: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese número exterior'
                                }
                            }
                        },
                        cpostal_notificaciones: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese código postal'
                                }
                            }
                        },
                        id_entidad_notificaciones: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione entidad federativa'
                                }
                            }
                        },
                        id_alcaldia_notificaciones: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione alcaldía o municipio'
                                }
                            }
                        },
                        id_colonia_notificaciones: {
                            validators: {
                                notEmpty: {
                                    message: 'Seleccione colonia'
                                }
                            }
                        },
                        calle_notificaciones: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese la calle'
                                }
                            }
                        },
                        nexterior_notificaciones: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese número exterior'
                                }
                            }
                        },
                        ntelefono1: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese número de teléfono'
                                }
                            }
                        },
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese correo electrónico'
                                }
                            }
                        }
                        
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap()
                    }
                }
            ));
           
		// Step 2
        	_validations.push( FormValidation.formValidation(
			_formEl,
			{
				fields: {
					DOCPJ: {
						validators: {
							notEmpty: {
                                message: 'Adjunta un documento'
                            },
                            file: {
                                extension: 'pdf',
                                type: 'application/pdf',
                                maxSize: 10485760, // 10240 * 1024
                                message: 'El archivo seleccionado sobrepasa los 10 MegaBytes!.'
                            },
						}
					},
                    DOCOF: {
						validators: {
							notEmpty: {
                                message: 'Adjunta un documento'
                            },
                            file: {
                                extension: 'pdf',
                                type: 'application/pdf',
                                maxSize: 10485760, // 10240 * 1024
                                message: 'El archivo seleccionado sobrepasa los 10 MegaBytes!.'
                            },
						}
                    },
                    DOCOFICIAL: {
                        validators: {
                            notEmpty: {
                                message: 'Seleccione tipo de documento'
                            }
                        }
                    },
                    manifiesto: {
						validators: {
							choice: {
								min:1,
								message: 'Debe aceptar el manifiesto!.'
							}
						}
					},
					
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    excluded: new FormValidation.plugins.Excluded(),
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),     
				}
			}
        ).on('core.form.validating', function() {
            $('#guardaP').attr("disabled", true);
            $("#guardaP").addClass("spinner spinner-white spinner-right");
        })
    );
        
      
    /*document.getElementById('moreInfoButton').addEventListener('click', function() {
        const container = document.getElementById('moreInfoFields');
        container.style.display = container.style.display === 'none' ? 'block' : 'none';
    });*/
}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_wizard_v2');
			_formEl = KTUtil.getById('kt_form');

			initWizard();
            initValidation();
           
		}
	};
}();

jQuery(document).ready(function () {
	KTWizard2.init();
});
