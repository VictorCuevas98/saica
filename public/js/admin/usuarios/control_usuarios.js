
var formElE;
var validatorE;
formElE = $('#editarUsuarioEnte');
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });
/*   $.ajax({
    url: url+'documentoEditar',
    type: 'POST',
    dataType: "html",
    data: 'hashid='+hashid,
    success: function(respuesta){
        $('#contenedor_modal_doc').html(respuesta);
        $('#modal_edita_doc').modal('show');
    }
  }); */
var initValidationE = function() {
    validatorE = formElE.validate({
        // Validate only visible fields
        ignore: ":hidden",

        // Validation rules
        rules: {
            curpE: {
                required: true,
                minlength: 18,
            },
            rfcE: {
                required: true
            },
            homoclaveE: {
                required: true,
                minlength: 3
            },
            nombreE: {
                required: true
            },
            paternoE: {
                required: true
            },
            maternoE:{
                required: true
            },
            correoE:{
                required: true
            },
            confirmacorreoE:{
                required: true,
                equalTo: '#correoE'
            },
            telefonoE:{
                required: true
            },
            confirmatelefonoE:{
                required: true,
                equalTo: '#telefonoE'
            },
            perfilE:{
                required: true
            },
            dependenciaE:{
                required: true
            },
            areaE:{
                required: true
            },
            cargoE:{
                required: true
            },
            contratacionE: {
                required: true
            }
        },
        messages:{
            curpE: {
                minlength: 'Escribe correctamente el CURP',
                remote: 'CURP no valido',
                required: 'Campo obligatorio'
            },
            rfcE: {
                required: 'Campo obligatorio',
                rfCurp: 'El RFC no coincide con el CURP'
            },
            homoclaveE: {
                required: 'Campo obligatorio',
                minlength: 'La homoclave debe ser de 3 digitos',
                remote: 'El rfc no se encuentra registrado en la base de datos'
            },
            nombreE: {
                required: 'Campo obligatorio'
            },
            paternoE: {
                required: 'Campo obligatorio'
            },
            maternoE:{
                required: 'Campo obligatorio'
            },
            correoE:{
                required: 'Campo obligatorio'
            },
            confirmacorreoE:{
                required: 'Campo obligatorio',
                equalTo: 'No coincide con el correo'
            },
            telefonoE:{
                required: 'Campo obligatorio'
            },
            confirmatelefonoE:{
                required: 'Campo obligatorio',
                equalTo: 'No coincide con el telefono'
            },
            perfilE:{
                required: 'Campo obligatorio'
            },
            dependenciaE:{
                required: 'Campo obligatorio'
            },

            areaE:{
                required: 'Campo obligatorio'
            },
            cargoE:{
                required: 'Campo obligatorio'
            },
            contratacionE: {
                required: 'Campo obligatorio'
            }
        },
        errorClass: "error-class",
        validClass:"valid_class",
        errorElement:"em",
        success: function(label) {
            label.addClass("valid_class").append('&#10004;')
        },

        // Display error
        invalidHandler: function(event, validator) {
            swal.fire({
                "title": "",
                "text": 'El campo '+ validator.errorList[0].element.labels[0].innerText+' es obligatorio',
                "icon": "error",
                "buttonStyling": false,
                "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
            });
        },

        // Submit valid form
        submitHandler: function (form) {

        }
    });
};

var initSubmitE = function() {
    var btn = formElE.find('#editarUsuario');
    //var url = window.location.href;
    btn.on('click', function(e) {
        e.preventDefault();

        if (validatorE.form()) {
            // See: src\js\framework\base\app.js
            //KTApp.progress(btn);
            //KTApp.block(formEl);

            // See: http://malsup.com/jquery/form/#ajaxSubmit
            formElE.ajaxSubmit({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url+"admin/usuarios/editar",
                type: 'POST',
                dataType: 'JSON',
                data: formElE.serialize(),
                beforeSend: function () {
                    $('#editarUsuario').attr('disabled', true);
                    $('#editarUsuario').addClass('spinner spinner-light');
                },
                success: function(response) {
                    //KTApp.unprogress(btn);
                    $('#editarUsuario').removeClass('spinner spinner-light');
                    $('#editarUsuario').attr('disabled', false);
                    //KTApp.unblock(formEl);
                    console.log(response);
                    if(response.codigo == 200) {
                        swal.fire({
                            title: 'Usuario actualizado',
                            text: "Los datos han sido actualizados",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ok',
                        }).then((result) => {
                            if (result.value) {
                                window.location.reload();
                            } else {
                                window.location.reload();
                            }
                        });
                    } else {
                        swal.fire({
                            "title": "",
                            "text": response.mensaje,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                },
                error: function (error) {
                    // $('#botonSubmit').removeClass('spinner spinner-light');
                    $('#editarUsuario').removeClass('spinner spinner-light');
                    $('#editarUsuario').attr('disabled', false);
                    console.log(error);
                    swal.fire({
                        "title": "",
                        "text": "Hay un error con la solicitud al servidor",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            });
        }
    });
};



//console.log('entro en usuarios control');

    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var avatar;
    formEl = $('#guardaUsuarioEnte');
$('#perfil').val(4).change();
$('#seccionPermisos').hide();
$('.noMostrar').hide();
$('#botonSubmit').hide();
$('#botonContinuar').hide();

function limpiarModal() {
        validator.resetForm();
    $('#perfil').val(4).change();
    $('#seccionPermisos').hide();
    $('.noMostrar').hide();
    $('#botonSubmit').hide();
    $('#botonContinuar').hide();
    //$('#homoclave').val('---').change();

}

function continuarRegistro() {
    $('#botonSubmit').show();
    $('#botonContinuar').hide();
    $('.noMostrar').show();
}

jQuery.validator.addMethod("rfCurp", function(value, element, param) {

    if(value === $('#curp').val().slice(0, 10)){
        return true;
    } else {
        return false;
    }

});
var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                curp: {
                    required: true,
                    minlength: 18,
                    remote: {
                        url: url + 'admin/usuarios/buscar_curp',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                       // async: false,
                        data: {
                            curp: function () {
                                return $('#curp').val();
                            }
                        },
                        dataFilter: function(response) {
                            var data = JSON.parse(response);
                            return data;
                        },
                        beforeSend: function () {
                            $('#spinerCurp').show();
                        },
                        complete: function(response){
                            var data = JSON.parse(response.responseText);
                            $('#spinerCurp').hide();
                            $('#rfc').val(data.rfc);
                            $('#nombre').val(data.nombre);
                            $('#paterno').val(data.apellido1);
                            $('#materno').val(data.apellido2);
                            validarRfc();


                        }
                    }
                },
                rfc: {
                    required: true
                    //rfCurp: "'"+$('#curp').val().slice(0, 10)+"'"
                },
                homoclave: {
                    required: true,
                    minlength: 3,
                    remote: {
                        url: url + 'admin/usuarios/buscar_rfc',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        // async: false,
                        data: {
                            rfc: function () {
                                return $('#rfc').val()+$('#homoclave').val();
                            }
                        },
                        dataFilter: function(response) {
                            var data = JSON.parse(response);
                            return data;
                        },
                        beforeSend: function () {
                            console.log('cambios')
                            $('#spinerRFC').show();
                        },
                        complete: function(response){
                            var data = JSON.parse(response.responseText);
                            $('#spinerRFC').hide();
                            var element = $(this).find('#homoclave')[0];
                            var previous = validator.previousValue( element );
                            var valid, //add your valid condition here
                                errors, message, submitted;

                            if(Number(data.data.error) === 0){
                                valid = true;
                                var curp = $('#curp');
                                if(curp.val() === ''){
                                    curp.val(data.data.curp);
                                    $('#nombre').val(data.data.nombre);
                                    $('#paterno').val(data.data.apellidoP);
                                    $('#materno').val(data.data.apellidoM);
                                    $('#dependencia').val(data.data.entidad);
                                    $('#botonContinuar').show();
                                    buscarAreas(data.datosUA);
                                }
                            } else if(Number(data.data.error) === 1){
                                valid = false;
                            }
                            else if(Number(data.data.error) === 2){
                                valid = false;
                            }
                            else if(Number(data.data.error) === 3){
                                valid = false;
                            }

                            validator.settings.messages[ element.name ].remote = previous.originalMessage;
                            if ( valid ) {
                                submitted = validator.formSubmitted;
                                validator.prepareElement( element );
                                validator.formSubmitted = submitted;
                                validator.successList.push( element );
                                delete validator.invalid[ element.name ];
                                validator.showErrors();
                            } else {
                                errors = {};
                                message = data.data.mensaje || validator.defaultMessage( element, "remote" );
                                errors[ element.name ] = previous.message = $.isFunction( message ) ? message( value ) : message;
                                validator.invalid[ element.name ] = true;
                                validator.showErrors( errors );
                            }
                            previous.valid = valid;
                            validator.stopRequest( element, valid );
                        }
                    }
                },
                nombre: {
                    required: true
                },
                paterno: {
                    required: true
                },
                materno:{
                    required: true
                },
                correo:{
                    required: true
                },
                confirmacorreo:{
                    required: true,
                    equalTo: '#correo'
                },
                telefono:{
                    required: true
                },
                confirmatelefono:{
                    required: true,
                    equalTo: '#telefono'
                },
                perfil:{
                    required: true
                },
                dependencia:{
                    required: true
                },
                area:{
                    required: true
                },
                cargo:{
                    required: true
                },
                contratacion: {
                    required: true
                }
            },
            messages:{
                curp: {
                    minlength: 'Escribe correctamente el CURP',
                    remote: 'CURP no valido',
                    required: 'Campo obligatorio'
                },
                rfc: {
                    required: 'Campo obligatorio',
                    rfCurp: 'El RFC no coincide con el CURP'
                },
                homoclave: {
                    required: 'Campo obligatorio',
                    minlength: 'La homoclave debe ser de 3 digitos',
                    remote: 'El rfc no se encuentra registrado en la base de datos'
                },
                nombre: {
                    required: 'Campo obligatorio'
                },
                paterno: {
                    required: 'Campo obligatorio'
                },
                materno:{
                    required: 'Campo obligatorio'
                },
                correo:{
                    required: 'Campo obligatorio'
                },
                confirmacorreo:{
                    required: 'Campo obligatorio',
                    equalTo: 'No coincide con el correo'
                },
                telefono:{
                    required: 'Campo obligatorio'
                },
                confirmatelefono:{
                    required: 'Campo obligatorio',
                    equalTo: 'No coincide con el telefono'
                },
                perfil:{
                    required: 'Campo obligatorio'
                },
                dependencia:{
                    required: 'Campo obligatorio'
                },

                area:{
                    required: 'Campo obligatorio'
                },
                cargo:{
                    required: 'Campo obligatorio'
                },
                contratacion: {
                    required: 'Campo obligatorio'
                }
            },
            errorClass: "error-class",
            validClass:"valid_class",
            errorElement:"em",
            success: function(label) {
                label.addClass("valid_class").append('&#10004;')
            },

            // Display error
            invalidHandler: function(event, validator) {
                KTUtil.scrollTop();
                console.log(validator.errorList[0]);
                swal.fire({
                    "title": "",
                    "text": 'El campo '+ validator.errorList[0].element.labels[0].innerText+' es obligatorio',
                    "icon": "error",
                    "buttonStyling": false,
                    "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    };

    var initSubmit = function() {
        var btn = formEl.find('#botonSubmit');
        //var url = window.location.href;
        btn.on('click', function(e) {
            e.preventDefault();
            console.log('validasr')
            if (validator.form()) {
                // See: src\js\framework\base\app.js
                //KTApp.progress(btn);
                //KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : url+"admin/usuarios/guardar",
                    type: 'POST',
                    dataType: 'JSON',
                    data: formEl.serialize(),
                    beforeSend: function () {
                        $('#botonSubmit').attr('disabled', true);
                        $('#botonSubmit').addClass('spinner spinner-light');
                    },
                    success: function(response) {
                        //KTApp.unprogress(btn);
                        $('#botonSubmit').removeClass('spinner spinner-light');
                        $('#botonSubmit').attr('disabled', false);
                        //KTApp.unblock(formEl);
                        console.log(response);
                        if(response.codigo == 200) {
                            swal.fire({
                                title: 'Usuario registrado',
                                text: "Se le hará llgar un correo con el link de activación al usuario",
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'ok',
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = url+'admin/usuarios/'+response.mensaje.entePub.id;
                            } else {
                                    window.location.href = url+'admin/usuarios/'+response.mensaje.entePub.id;
                            }
                        });
                        } else {
                            swal.fire({
                                "title": "",
                                "text": response.mensaje,
                                "type": "error",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }
                    },
                    error: function (error) {
                       // $('#botonSubmit').removeClass('spinner spinner-light');
                        $('#botonSubmit').removeClass('spinner spinner-light');
                        $('#botonSubmit').attr('disabled', false);
                        console.log(error);
                        swal.fire({
                            "title": "",
                            "text": "No se subieron algunos archivos, vuelvelo a intentar!",
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                });
            }
        });
    };


    function validarRfc() {
        console.log('validarfc');

    }

// Mostrar modal para alta de usuario
function agregar_usuario_modal() {

    $('#modal_agregar_usuario').modal('show');
    $('#id_rol').html('');
    rolesUsuarisNuevos.forEach(function (rol) {
        $('#id_rol').append('<option value="'+ rol.id +'">'+ rol.name +'</option>')
    });
}
//buscar las areas que pertenecen a la entidad
 function buscarAreas(unidadesA) {
     $('#seccionAreaAdscripcion').show();
     $('#area').html('');
     $('#area').append('<option value="0" selected disabled>Selecciona el área a la que pertences</option>');
                 for(var area of unidadesA) {
                     $('#area').append('<option value="' + area.id + '">' + area.unidad_admin + '</option>');
                 }

 }

function buscarPuestos(tipoContratacion) {
        console.log('entro en buscar cargos');
    $('#spinerContratacion').show();

    $('#cargo').html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url + "admin/usuarios/cargos",
        type: 'POST',
        data: {
            areaId: $('#area').val(),
            tipoContratacion: tipoContratacion
        },
        dataType: 'json',
        success: function(respuesta) {
            console.log(respuesta);
            if (respuesta.codigo === 200) {
                $('#cargo').append('<option selected disabled>Selecciona tu puesto o cargo</option>');
                for(var cargo of respuesta.mensaje) {
                    $('#cargo').append('<option value="' + cargo.id + '">' + cargo.puesto_funcional + '</option>');
                }
                $('#seccionCargo').show();
            } else {
                swal.fire('error', respuesta.mensaje,"error");
            }
            $('#spinerContratacion').hide();
        },
        error: function(xhr) {
            //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
            swal.fire('¡Alerta!', xhr, 'warning');
            $('#spinerContratacion').hide();

        }
    });

}

async function agregarPuesto() {
    try {
        const { value: formValues } = await swal.fire({
            title: 'Registrar Puesto',
            html:
                '<div class="">'+
                '<label for="areaR">Área</label>'+
                '<div class="col-12">'+
                '<input hidden class="form-control form-control-solid" id="areaRId" name="areaRId" value="'+ $("#area").val() +'">'+
                '<input readonly class="form-control form-control-solid" id="areaR" name="areaR" value="'+ $("#area option:selected").text() +'" title="'+ $("#area option:selected").text() +'">'+
                '</div>'+
                '</div>'+
                '<div class="">'+
                '<label for="tipoCR">Tipo de Contratación</label>'+
                '<div class="col-12">'+
                '<input hidden class="form-control form-control-solid" id="tipoCRId" name="tipoCRId" value="'+ $("#contratacion").val() +'">'+
                '<input readonly class="form-control form-control-solid" id="tipoCR" name="tipoCR" value="'+ $("#contratacion option:selected").text() +'" title="'+ $("#contratacion option:selected").text() +'">'+
                '</div>'+
                '</div>'+
                '<div class="">'+
                '<label for="tipoCR">Puesto</label>'+
                '<div class="col-12">'+
                '<input id="puestoR" name="puestoR" type="text" class="form-control" placeholder="Ingresa el carogo o puesto">'+
                '</div>'+
                '</div>',

            confirmButtonText: 'Registrar',
            confirmButtonColor: 'success',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: 'secondary',
            onBeforeOpen: function () {
                $("#puestoR").on({
                    "focus": function(event) {
                        $(event.target).select();
                    },
                    "keyup": function(event) {
                        $(event.target).val(function(index, value) {
                            return value.toUpperCase();
                        });
                    },
                    "change": function(event) {
                        $(event.target).val($(this).val().toUpperCase());
                    }
                });
            },
            preConfirm: () => {
                return [
                    document.getElementById('areaRId'),
                    document.getElementById('tipoCRId'),
                    document.getElementById('puestoR'),
                ]
            }
        });

        if (formValues[2].value == '0' || formValues[2].value == '' || formValues[2].value == null) {
            swal.fire({
                title: 'Rellena la información',
                text: "Ingresa el puesto correctamente",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Regresar'
            }).then((result) => {
                if (result.value) {
                    agregarPuesto();
                }
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url + "admin/usuarios/cargos/registro",
                type: 'POST',
                data: {
                    areaId: formValues[0].value,
                    tipoContratacion: formValues[1].value,
                    puesto: formValues[2].value
                },
                dataType: 'json',
                success: function(respuesta) {
                    console.log(respuesta);
                    if (respuesta.codigo === 200) {
                        swal.fire('', 'Se registro el puesto o cargo, revisalo en el formulario de registro',"success");
                        buscarPuestos(formValues[1].value);
                        setTimeout(()=> {
                            $('#cargo').val(respuesta.mensaje.id).change();
                        }, 2000);
                    } else {
                        swal.fire('error', respuesta.mensaje,"error");
                    }
                },
                error: function(xhr) {
                    //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
                    swal.fire('¡Alerta!', xhr, 'warning');

                }
            });
        }
    } catch (e) {
        console.log('error:', e);
        return false;
    }
}
async function agregarPuestoE() {
    try {
        const { value: formValues } = await swal.fire({
            title: 'Registrar Puesto',
            html:
                '<div class="">'+
                '<label for="areaR">Área</label>'+
                '<div class="col-12">'+
                '<input hidden class="form-control form-control-solid" id="areaRId" name="areaRId" value="'+ $("#areaE").val() +'">'+
                '<input readonly class="form-control form-control-solid" id="areaR" name="areaR" value="'+ $("#areaE option:selected").text() +'" title="'+ $("#areaE option:selected").text() +'">'+
                '</div>'+
                '</div>'+
                '<div class="">'+
                '<label for="tipoCR">Tipo de Contratación</label>'+
                '<div class="col-12">'+
                '<input hidden class="form-control form-control-solid" id="tipoCRId" name="tipoCRId" value="'+ $("#contratacionE").val() +'">'+
                '<input readonly class="form-control form-control-solid" id="tipoCR" name="tipoCR" value="'+ $("#contratacionE option:selected").text() +'" title="'+ $("#contratacionE option:selected").text() +'">'+
                '</div>'+
                '</div>'+
                '<div class="">'+
                '<label for="tipoCR">Puesto</label>'+
                '<div class="col-12">'+
                '<input id="puestoR" name="puestoR" type="text" class="form-control" placeholder="Ingresa el carogo o puesto">'+
                '</div>'+
                '</div>',

            confirmButtonText: 'Registrar',
            confirmButtonColor: 'success',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            cancelButtonColor: 'secondary',
            onBeforeOpen: function () {
                $("#puestoR").on({
                    "focus": function(event) {
                        $(event.target).select();
                    },
                    "keyup": function(event) {
                        $(event.target).val(function(index, value) {
                            return value.toUpperCase();
                        });
                    },
                    "change": function(event) {
                        $(event.target).val($(this).val().toUpperCase());
                    }
                });
            },
            preConfirm: () => {
                return [
                    document.getElementById('areaRId'),
                    document.getElementById('tipoCRId'),
                    document.getElementById('puestoR'),
                ]
            }
        });

        if (formValues[2].value == '0' || formValues[2].value == '' || formValues[2].value == null) {
            swal.fire({
                title: 'Rellena la información',
                text: "Ingresa el puesto correctamente",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Regresar'
            }).then((result) => {
                if (result.value) {
                    agregarPuesto();
                }
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url + "admin/usuarios/cargos/registro",
                type: 'POST',
                data: {
                    areaId: formValues[0].value,
                    tipoContratacion: formValues[1].value,
                    puesto: formValues[2].value
                },
                dataType: 'json',
                success: function(respuesta) {
                    console.log(respuesta);
                    if (respuesta.codigo === 200) {
                        swal.fire('', 'Se registro el puesto o cargo, revisalo en el formulario de registro',"success");
                        buscarPuestosE(formValues[1].value);
                        setTimeout(()=> {
                            $('#cargoE').val(respuesta.mensaje.id).change();
                        }, 2000);
                    } else {
                        swal.fire('error', respuesta.mensaje,"error");
                    }
                },
                error: function(xhr) {
                    //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
                    swal.fire('¡Alerta!', xhr, 'warning');

                }
            });
        }
    } catch (e) {
        console.log('error:', e);
        return false;
    }
}

function buscarPuestosE(tipoContratacion) {
    $('#cargoE').html('');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url + "admin/usuarios/cargos",
        type: 'POST',
        data: {
            areaId: $('#areaE').val(),
            tipoContratacion: tipoContratacion
        },
        dataType: 'json',
        success: function(respuesta) {
            console.log(respuesta);
            if (respuesta.codigo === 200) {
                $('#cargoE').append('<option value="0" selected disabled>Selecciona tu puesto o cargo</option>');
                for(var cargo of respuesta.mensaje) {
                    $('#cargoE').append('<option value="' + cargo.id + '">' + cargo.puesto_funcional + '</option>');
                }
            } else {
                swal.fire('error', respuesta.mensaje,"error");
            }
        },
        error: function(xhr) {
            //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
            swal.fire('¡Alerta!', xhr, 'warning');

        }
    });

}

// Guardar nuevo usuario
function guardar_usuario() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url + "admin/usuarios/guardar",
        type: 'POST',
        data: $("#frm_nuevo_usuario").serialize(),
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.codigo === 200) {
                $('#modal_agregar_usuario').modal('hide').on('hidden.bs.modal', function() {
                    swal.fire("Proceso  correcto!", "Se  creó  correctamente  el usuario!","success");
                    llenarTabla();
                });
            } else {
                swal.fire('error', respuesta.mensaje,"error");
            }
        },
        error: function(xhr) {
            //   var message = getErrorAjax(xhr, 'Error de conectividad de red USR-02.');
            swal.fire('¡Alerta!', xhr, 'warning');

        }
    });
}
function obtenerUsuario(personaId) {
    console.log(personaId);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url + "admin/usuarios/obtener",
        dataType: 'json',
        type: 'POST',
        data:{
            id:personaId
        },
        success: function(response) {
           console.log(response);
           if(response.codigo === 200){
               $('#curpE').val(response.mensaje.persona.curp);
               $('#rfcE').val(response.mensaje.persona.rfc.slice(0, 10));
               $('#homoclaveE').val(response.mensaje.persona.rfc.slice(10, 13));
               $('#nombreE').val(response.mensaje.persona.nombre);
               $('#paternoE').val(response.mensaje.persona.primer_ap);
               $('#maternoE').val(response.mensaje.persona.segundo_ap);
               $('#correoE').val(response.mensaje.persona.email);
               //$('#confirmacorreoE').val(response.mensaje.email);
               $('#telefonoE').val(response.mensaje.persona.telefono);
              // $('#confirmatelefonoE').val(response.mensaje.telefono);
               $('#perfilE').val(response.mensaje.persona.role_id).change();
               $('#dependenciaE').val(response.mensaje.persona.ente_publico);
               $('#hashidE').val(personaId);


               for (var area of response.mensaje.unidades){
                   $('#areaE').append('<option value="'+ area.id +'">'+ area.unidad_admin +'</option>');
               }

              // for (var puesto of response.mensaje.puestos){
                //   $('#cargoE').append('<option value="'+ puesto.id +'">'+ puesto.puesto_funcional +'</option>');
               //}
               $('#areaE').val(response.mensaje.persona.id_unidad_admin).change();
               $('#contratacionE').val(response.mensaje.persona.id_tipo_contratacion).change();

               setTimeout(() => {
                   $('#cargoE').val(response.mensaje.persona.id_puesto_funcional).change();
               }, 2000);

               //$('#areaE').val(response.mensaje.);
               //$('#cargoE').val(response.mensaje.);
           } else {
               swal.fire('', response.mensaje, 'warning');
           }
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-03','warning');
        }
    });
}

// Mostrar modal para edición de usuario
function edit_user_modal(data) {
    var id=data;
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url + "admin/edit",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $("[class='make-switch']").bootstrapSwitch('animate', true);
                $('.select2').select2({dropdownParent: $("#mod_edit_user")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-03','warning');
        }
    });
}

function edit_user() {
    if(!formValidate('#editar_usuario')){ return false; }
    var password = $('#password').removeClass('has-error').val();
    var password2 = $('#password2').removeClass('has-error').val();
    if (password != password2){
        showElementError('password2','Las contraseñas no son iguales.');
        return false;
    }
    var dataString = $("#editar_usuario").serialize();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url + "admin/update",
        type: 'POST',
        data: dataString,
        dataType: 'json',
        success: function(respuesta) {
            if (respuesta.success == true) {
                $('#mod_edit_user').modal('hide').on('hidden.bs.modal', function() {
                    Swal.fire("Proceso  correcto!", "Se  modifico  correctamente  el usuario!","success");
                    $('#users-table').DataTable().ajax.reload();
                });
            }else {
                Swal.fire('error', respuesta.message,"error");
            }
        },
        error: function(respuesta) {
            Swal.fire('¡Alerta!','Error de conectividad de red USR-04','warning');
        }
    });
}
function borrarEnte(hashid){
    swal.fire({
        title: 'Estas seguro de que quieres borrar a este usuario?',
        text: "No podras regresar los cambios!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar!',
        confirmButtonColor: '#61aa4c',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, borrar!'
    }).then((result) => {
        if (result.value) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        jQuery.ajax({
            cache: false,
            url: url+"admin/usuarios/borrar",
            method: "post",
            data: "hashid="+hashid,
            success: function (result) {
                if(result['mensaje']['success']==="true"){
                    swal.fire({
                        confirmButtonColor: '#61aa4c',
                        title: 'Eliminado!',
                        text: 'El usuario ha sido eliminado.',
                        icon: 'success'
                    }).then((result) => {
                        window.location.href = url+"admin/usuarios"
                })
                }else{
                    swal.fire({
                        confirmButtonColor: '#61aa4c',
                        title: 'Aviso!',
                        text: 'Ocurrio un error al eliminar el usuario, favor de volver a intentarlo!',
                        icon: 'error'
                    })
                }
            },
            error: function (err) {
                //mostrarAlerta('error', err);
                console.log(err)
            }
        });
    }
})
}

jQuery(document).ready(function() {
    initValidation();
    initSubmit();
    initValidationE();
    initSubmitE();
    $('.select2').select2({
        width: '100%'
    });

});
