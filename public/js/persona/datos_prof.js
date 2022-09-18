"use strict";
// Class definition
var KTFormControls = function () {
	// Private functions
	var guardaProf = function () {
    const form = document.getElementById('datosProf');
	const fv =	FormValidation.formValidation(
			document.getElementById('datosProf'),
			{
				fields: {
                    nregistro: {
						validators: {
							notEmpty: {
								message: 'Ingrese su número de registro'
							},
							stringLength: {
								min:3,
								max:30,
								message: 'No debe contener mas de 30 caracteres!.'
							}
						}
                    },
                    cedula: {
						validators: {
							notEmpty: {
								message: 'Ingrese su cédula'
							},
							stringLength: {
								min:4,
								max:20,
								message: 'No debe contener mas de 20 caracteres!.'
							}
						}
                    },	
                    fprof: {
						validators: {
							notEmpty: {
								message: 'Ingrese su formación profesional'
							},
							stringLength: {
								min:4,
								max:120,
								message: 'No debe contener mas de 120 caracteres!.'
							}
						}
                    },		
                    vigencia: {
						validators: {
							notEmpty: {
								message: 'Ingrese la vigencia'
							}
						}
                    },
                    DOCOFICIAL: {
						validators: {
							notEmpty: {
								message: 'Selecciona un tipo de identificación'
							}
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
                    CARNET: {
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
                    defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}).on('core.form.validating', function() {
                $('#guardarProf').attr("disabled", true);
                $("#guardarProf").addClass("spinner spinner-white spinner-right")
            });

        guardarProf.addEventListener('click', function() {
            fv.validate().then(function(status) {            
                if(status === 'Valid'){
                    $('#guardarProf').attr("disabled", true);
                    $("#guardarProf").addClass("spinner spinner-white spinner-right");
                }else{
                    swal.fire({
						text: "Debes capturar los campos obligatorios, inténtalo de nuevo.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "Ok!",
						confirmButtonClass: "btn font-weight-bold btn-light"
					}).then(function () {
                        $('#guardarProf').attr("disabled", false);
                        $("#guardarProf").removeClass("spinner spinner-white spinner-right");
					});
                }
            });
        });
	}
	return {
		// public functions
		init: function() {
			guardaProf();
		}
	};
}();

jQuery(document).ready(function() {
	KTFormControls.init();
});
