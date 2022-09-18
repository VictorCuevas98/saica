if (navigator.userAgent.match(/msie/i) || navigator.userAgent.match(/trident/i) || navigator.userAgent.match(/edge/i) ){
    setTimeout(function(){ window.location.href = url+"errorNavegador"; }, 100);

}
//Login ............................................

var existeSectPres = false;
function ajaxEntidades(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
	return $.ajax({
		url : urlEntidades,
		type : 'POST',
        async : false
    }
	);
}

function getEntidades(){
    ajaxEntidades().done(function(data){
        console.log('datos de getEntidades',data);
        $("#entes_llenados").empty();
        data.EntePub.forEach((element) => {
            $("#entes_llenados").append('<option value="'+ element.id +'">'+element.ente_publico+'</option>').change();
        })
    })
}
function getEntidadesSinSectPres(){
    ajaxEntidades().done(function(data){
        $("#txtentep_sin").empty();
        $("#txtentep_sin").append('<option value="">Selecciona una opción</option>');
        $.each(data.EntePub, function( index, data ) {
            //console.log(data)
            $("#txtentep_sin").append('<option value="'+data.id+'">'+data.ente_publico+'</option>');
        });
    })
}

function ajaxUnidadAdmin(idEntes){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
	return $.ajax({
		url : urlUnidadesAdministrativas,
        type : 'POST',
        data:{'idEntes':idEntes},
        async : false
    }
	);
}



function getUnidades(idEntes){
    ajaxUnidadAdmin(idEntes).done(function(data){
        $("#areas_llenados").empty();
        $("#areas_llenados").append('<option value="">Selecciona un opción</option>');
        $.each(data.datosUniAdm, function( index, data ) {
            //console.log('datos')
            $("#areas_llenados").append('<option value="'+data.id+'">'+data.unidad_admin+'</option>');
        });

    })
}


/*function getUnidadesSinSectPres(idEntes){
    ajaxUnidadAdmin(idEntes).done(function(data){
        $("#area_sin").empty();
        $("#area_sin").append('<option value="">Selecciona un opción</option>');
        $.each(data.datosUniAdm, function( index, data ) {
            //console.log('datos')
            $("#area_sin").append('<option value="'+data.id+'">'+data.unidad_admin+'</option>');
        });

    })
}
*/

function buscar_puestos_manual() {

    $("#puesto_manual_container").hide();

    if($("#tipo_contratacion_manual").val()==""){
        mensajeError("Debes seleccionar el tipo de contratación!");
        $("#area").val($("#area option:first").val());
        return false;
    }
    swal.fire({
        title: "Buscando Puestos!",
        text: "La busqueda terminará en segundos.",
        timer: 6500,
        timerProgressBar: true,
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: false,
        allowOutsideClick: false,
        onOpen: function() {
            //swal.showLoading()
        }
    }).then(function(result) {
        if (result.dismiss === "timer") {
            console.log("")
        }
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: url+"buscar_puestos",
        type: 'POST',
        data: 'area=' + $('#areas_llenados').val() +'&tipo_contratacion=' + $('#tipo_contratacion_manual').val(),
        dataType: "json",
        success: function(respuesta) {
            //console.log(respuesta);
            // limpiar combos
            //$('#puesto_manual').html('<option value="0">Selecciona una opción</option>');
            $("#puesto_manual").empty();
            $('#puesto_manual').append('<option value="" >Selecciona un puesto</option>');
            if (respuesta.length > 0) {
                for (var i = 0; i < respuesta.length; i++) {
                    $('#puesto_manual').append("<option value='" + respuesta[i].id + "'>" + respuesta[i].puesto_funcional + "</option>");
                }
            }
            if($("#tipo_contratacion_manual").val()!='E'){
                $('#puesto_manual').append('<option value="other">OTRO</option>');
            }
            $("#puesto_manual_container").show();
        },
        error: function() {
            $("#puesto_manual_container").show();
            swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
            return false;
        }
    });
}

function buscar_puestos_sin_sec_pres() {
    if($("#tipo_contratacion").val()==""){
        mensajeError("Debes seleccionar el tipo de contratación!");
        $("#area_sin").val($("#area option:first").val());
        return false;
    }
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: url+"buscar_puestos",
        type: 'POST',
        data: 'area=' + $('#area_sin').val() +'&tipo_contratacion=' + $('#tipo_contratacion').val(),
        dataType: "json",
        success: function(respuesta) {
            //console.log(respuesta);
            // limpiar combos
            $('#puesto_sin').html('<option value="0">Selecciona una opción</option>');

            if (respuesta.length > 0) {
                for (var i = 0; i < respuesta.length; i++) {
                    $('#puesto_sin').append("<option value='" + respuesta[i].id + "'>" + respuesta[i].puesto_funcional + "</option>");
                }
            }
            if($("#tipo_contratacion").val()!='E'){
                $('#puesto_sin').append('<option value="other">OTRO</option>');
            }

        },
        error: function() {
            swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
            return false;
        }
    });
}

let tipoDeContratacionChange = ()  => {    
    $("#puesto_manual_container").hide();
    $("#puesto_manual").empty();
    $("#txtpuesto_sin").val("");
    $("#textopuesto_manual").hide();
    let areaSeleccionada = $( "#areas_llenados option:selected" ).val();
    if(areaSeleccionada){
        buscar_puestos_manual();
    }
    jQuery('#tipo_contratacion_manual').valid();
    jQuery('#entes_llenados').valid();
    jQuery('#areas_llenados').valid();
    jQuery('#puesto_manual').valid();

};

var formRegistroServidorPublicos = $("#registroUsuarioManual")
var validatorManual;
var initValidationRegistroManual = function() {
    validatorManual = formRegistroServidorPublicos.validate({
        // Validate only visible fields
        ignore: ":hidden",

        // Validation rules
        rules: {
            txtCurpManual:{
                required: true,
                minlength: 18,
                rfcCurpMatch: true,
            },
            txthomoclaveManual:{
                required:true,
                minlength: 3,
                maxlength: 3
            },
            txtrfcManual: {
                required: true,
                minlength: 10,
                maxlength: 13,
                rfcValidate : true,
                rfcCurpMatch: true,
            },
            tipo_contratacion_manual: {
                required: true,
                /* valueNotEquals : '0' */
            },
            fecha_de_contratacion_inicial : {
                required: true,
            },
            txtnombre_manual: {
                required: true
            },
            txtapaterno_manual:{
                required: true
            },
            txtamaterno_manual:{
                required: true
            },
            emailManual: {
                required: true,
            },
            emailconfirmManual:{
                required: true,
                equalTo: '#emailManual'
            },
            entes_llenados:{
                required: true,
                /* valueNotEquals : '0' */
            },
            areas_llenados:{
                required: true,
                /* valueNotEquals : '0' */
            },
            txtpuestomanual:{
                required: true
            },
            telefonoFManual: {
                required: false,
            },
            telefonoconfirmFManual:{
                required: false,
                equalTo: '#telefonoFManual'
            },
            telOficinaManual: {
                required: true,
            },
            extension:{
                //required: true,
            },
        },
        messages:{
            tipo_contratacion_manual: {
                required: 'El tipo de contratación es obligatorio',
                rfCurp: 'El RFC no coincide con el CURP'
            },
            fecha_de_contratacion_inicial : {
                required: 'La fecha de inicio de en el puesto es requerida',
            },
            txtCurpManual: {
                minlength: 'Escribe correctamente el CURP',
                remote: 'CURP no valido',
                required: 'Campo obligatorio'
            },
            txtrfcManual: {
                required: 'El RFC es obligatorio',
                rfCurp: 'El RFC no coincide con el CURP',
                minlength:'El RFC debe de contener al menos 10 caracteres',
                maxlength:'El RFC no debe de tener mas de 13 Digitos'
            },
            txtnombre_manual: {
                required: 'Campo obligatorio'
            },
            txtapaterno_manual: {
                required: 'Campo obligatorio'
            },
            txtamaterno_manual:{
                required: 'Campo obligatorio'
            },

            emailManual:{
                required: 'El correo electrónico es obligatorio'
            },
            emailconfirmManual:{
                required: 'El correo de confirmación es obligatorio',
                equalTo: 'No coincide el correo electrónico'
            },
            telefonoFManual:{
                required: 'El teléfono es obligatorio'
            },
            telefonoconfirmFManual:{
                required: 'El teléfono de confirmación es obligatorio',
                equalTo: 'No coincide con el teléfono'
            },
            telOficinaManual:{
                required: "El teléfono de oficina es obligatorio",
            },
            extension:{
                required: "El campo extensión es obligatorio",
            },
            entes_llenados:{
                    required: 'Campo obligatorio'
                },

            areas_llenados:{
                required: 'El área es obligatoria'
            },
            puesto_manual:{
                required: 'Campo obligatorio'
            },
            txtpuestomanual:{
                required: 'Es necesario especificar el puesto'
            },
            contratacion: {
                required: 'Campo obligatorio'
            }
        },
        //errorClass: "error-class",
        //validClass:"valid_class",
        //errorElement:"em",
        errorClass: "is-invalid",
        validClass:"is-valid",
        
        success: function(label) {
            label.addClass("valid_class").append('&#10004;')
        },

        // Display error
        invalidHandler: function(event, validator) {
            swal.fire({
                "title": "Lo siento",
                "text": 'Al parecer existen algunos errores en los campos, por favor vuelve a revisar',
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

//Inicializar validacion form automaticos
var formRegistroAutomatico = $("#registroUsuario");
var validatorAutomaticos;
var initValidationRegistroAutomatico = function() {
    validatorAutomaticos = formRegistroAutomatico.validate({
        // Validate only visible fields
        ignore: ":hidden",

        // Validation rules
        rules: {
            txtrfc: {
                required: true,
                /* minlength: 10 */
            },
            tipo_contratacion: {
                required: true
            },
            txtentep_sin: {
                required: true
            },
            area_sin:{
                required: true
            },
            puesto_sin:{
                required: true
            },//hasta aqui
            txtpuesto_sin: {
                required: true,
            },
            email: {
                required: true,
            },
            emailconfirm:{
                required: true,
                equalTo: '#email'
            },//
            telefonoF:{
                required: true
            },
            telefonoconfirmF:{
                required: true,
                equalTo: '#telefonoF'
            },//
            area:{
                required: true
            },
            puesto:{
                required: true
            },
            txtpuesto:{
                required:true
            }
        },
        messages:{
            txtrfc: {
                required: 'Campo obligatorio'
            },
            tipo_contratacion: {
                required: 'Campo obligatorio'
            },
            txtentep_sin: {
                required: 'Campo obligatorio'
            },
            area_sin: {
                required: 'Campo obligatorio'
            },
            puesto_sin: {
                required: 'Campo obligatorio'
            },
            txtpuesto_sin:{
                required: 'Campo obligatorio'
            },
            email:{
                required: 'Campo obligatorio'
            },
            emailconfirm:{
                required: 'Campo obligatorio',
                equalTo: 'No coincide con el correo'
            },
            telefonoF:{
                required: 'Campo obligatorio'
            },
            telefonoconfirmF:{
                required: 'Campo obligatorio',
                equalTo: 'No coincide con el telefono'
            },
            area:{
                    required: 'Campo obligatorio'
                },

                puesto:{
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
                "text": 'Los campos marcados con * son obligatorios.',
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


var initSubmitAutomatico = function() {
    //console.log('in')
    var btn = $('#guardarUsuario');
    btn.on('click', function(e) {
        //console.log('entro en boton');
        e.preventDefault();


        if (validatorAutomaticos.form()) {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            jQuery.ajax({
                cache: false,
                url: url+"guardarUsuario",
                method: "post",
                data: $( "#registroUsuario" ).serialize(),
                beforeSend: function() {
                    //bloquea boton
                    $('#guardarUsuario').attr("disabled", true);
                    $("#guardarUsuario").addClass("spinner spinner-white spinner-right");
                 },
                success: function (result) {
                    if(result.tipoerror=="existe"){
                        mensajeError(result.message);
                    }else{
                        $('#registroUsuario')[0].reset();
                        $("#registro").modal('hide');
                        $('#modalRegistro').modal('show');
                        $('#rfc').val('');
                        $("#mensajeText").html("<p>"+result.message+"</p>");
                        $("#mensajeEmail").html("<p><strong>"+result.email+"</p></strong>");
                    }
                    $('#guardarUsuario').attr("disabled", false);
                       $("#guardarUsuario").removeClass("spinner spinner-white spinner-right");

                },
                error: function (err) {
                    mensajeError("Algo salio mal, favor de volver a intentar!");
                    $('#guardarUsuario').attr("disabled", false);
                    $("#guardarUsuario").removeClass('spinner spinner-white spinner-right');
                }

            });
        }
    });
};



//Fin validaciones
var initSubmitManual = function() {
    //console.log('in')
    var btn = $('#guardarUsuarioManual');
    //var url = window.location.href;
    btn.on('click', function(e) {
        //console.log('entro en boton');
        e.preventDefault();
        //if($("#noMostrar").is(":visible")) {
        //    console.log('entro en boton');
       //     $('#botonSubmit').show();
      //      $('#botonContinuar').hide();
       //     $('.noMostrar').show();
       //     return;
        //}

        if (validatorManual.form()) {
            var curp = $('#txtCurpManual').val().toUpperCase();
            var rfc = $('#txtrfcManual').val().toUpperCase();
            //console.log('CURP = ',curp.substr(0,10), 'RFC = ',rfc.substr(0,10));
            if(curp.substr(0,10) != rfc.substr(0,10)){
                swal.fire('Atención','El CURP y el RFC no coinciden','warning');
                return $('#txtCurpManual').focus();
            }
            // See: src\js\framework\base\app.js
            //KTApp.progress(btn);
            //KTApp.block(formEl);

            // See: http://malsup.com/jquery/form/#ajaxSubmit
/*             formRegistroServidorPublicos.ajaxSubmit({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url+"oci/usuarios/guardar",
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
            }); */
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            jQuery.ajax({
                cache: false,
                url: urlGuardarManual,
                method: "post",
                data: formRegistroServidorPublicos.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    //bloquea boton
                    btn.attr("disabled", true);
                    btn.addClass("spinner spinner-white spinner-right");
                 },
                success: function (result) {
                    //validatorManual.resetForm()
                    if(result.tipoerror=="existe"){
                        mensajeError(result.message);
                    }else{
                        mensajeError(result.message);
                        $("#registroServidorPublicoManual").modal('hide')
/*                         $('#registroUsuario')[0].reset();
                        $("#registro").modal('hide');
                        $('#modalRegistro').modal('show');
                        $('#rfc').val('');
                        $("#mensajeText").html("<p>"+result.message+"</p>");
                        $("#mensajeEmail").html("<p><strong>"+result.email+"</p></strong>"); */
                    }
                    btn.attr("disabled", false);
                    btn.removeClass("spinner spinner-white spinner-right");

                },
                error: function (err) {
                    mensajeError("Algo salio mal, favor de volver a intentar!");
                    btn.attr("disabled", false);
                    btn.removeClass('spinner spinner-white spinner-right');
                }
            });
        }
    });
};


//..............................................

$('#area').select2();
$('#puesto').select2();
$('#entes_llenados').select2();
$('#areas_llenados').select2();
$('#puesto_manual').select2();
$("#loginRfc").click(function(){
    window.location.href = url+"loginRfc";
});

$("#loginEFirma").click(function(){
    window.location.href = url+"login";
});

function modal_registro(){
    setTimeout(function () {
        $("#registro").modal();
    }, 500);
}

$("#kt_login_signup").click(function(){
    $('#rfc').val('');
});

$("#kt_login_forgot").click(function(){
    $('#rfcforgot').val('');
});

$("#kt_login_signup_cancel").click(function(){
    $('#rfc').val('');
    $('#password').val('');
    $('#username').val('');
});

$("#textopuesto").hide();
$('input[type=radio][name=tipo_persona]').change(function() {
    if (this.value == '1') {
        $("#personamoral").hide();
         $("#personafisica").show();
    }else if(this.value == '2'){
        $("#personafisica").hide();
        $("#personamoral").show();
    }
});

function limpiar_puestos(){
    var puesto = $("#puesto");
    puesto.find('option').remove();
    $("#area").val($("#area option:first").val());
    $("#txtpuesto").val("");
    $("#textopuesto").hide();
}

function limpiar_puestosManual(){
    var puesto = $("#puesto_manual");
    puesto.find('option').remove();
    //console.log('reiniciarr')
    if ($("#areas_llenados").val() != null) {
        $("#areas_llenados").val('').trigger('change');
    }

    $("#txtpuesto").val("");
    $("#textopuesto_manual").hide();
}
function consultarfc(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    jQuery.ajax({
        cache: false,
        url: url+"consultarfc",
        method: "post",
        data: "curp="+$("#curp").val(),
        success: function (result) {
            if(result['nombre']===null || result['nombre']===""){
                $("#nombre").val("");
                $("#materno").val("");
                $("#paterno").val("");
                $("#rfc").val("");
                mensajeError("El CURP no existe!");
            }else{
                $("#nombre").val(result['nombre']);
                $("#materno").val(result['apellido2']);
                $("#paterno").val(result['apellido1']);
                $("#rfc").val(result['rfc']);
            }

        },
        error: function (err) {
            //mostrarAlerta('error', err);
            console.log(err)
        }
    });
}

function consultarfcExiste(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    jQuery.ajax({
        cache: false,
        url: url+"consultaRfcExiste",
        method: "post",
        data: "rfc="+$("#rfc").val()+$("#homo").val(),
        success: function (result) {
            if(result.email===null || result.email===""){
                $("#email").val("");
                $("#emailconfirm").val("");
            }else{
                $("#email").val(result.email);
                $("#emailconfirm").val(result.email);
            }

        },
        error: function (err) {
            //mostrarAlerta('error', err);
            console.log(err)
        }
    });
}

$("#curp").blur(function() {
    var value = $(this).val();
    if(value.length==18){
        consultarfc();
    }
});

$("#rfc").blur(function() {
    var value = $(this).val();
    if(value.length==10){
        consultarfcExiste();
    }
});

$("#homo").blur(function() {
    var value = $(this).val();
    if(value.length==3){
        consultarfcExiste();
    }
});

function mensajeError(mensaje){
      swal.fire('Mensaje!', mensaje, 'warning');
}

function guardarUsuario(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    jQuery.ajax({
        cache: false,
        url: url+"guardarUsuario",
        method: "post",
        data: $( "#registroUsuario" ).serialize(),
        beforeSend: function() {
            //bloquea boton
            $('#guardarUsuario').attr("disabled", true);
            $("#guardarUsuario").addClass("spinner spinner-white spinner-right");
         },
        success: function (result) {
            if(result.tipoerror=="existe"){
                mensajeError(result.message);
            }else{
                $('#registroUsuario')[0].reset();
                $("#registro").modal('hide');
                $('#modalRegistro').modal('show');
                $('#rfc').val('');
                $("#mensajeText").html("<p>"+result.message+"</p>");
                $("#mensajeEmail").html("<p><strong>"+result.email+"</p></strong>");
            }
            $('#guardarUsuario').attr("disabled", false);
               $("#guardarUsuario").removeClass("spinner spinner-white spinner-right");

        },
        error: function (err) {
            mensajeError("Algo salio mal, favor de volver a intentar!");
            $('#guardarUsuario').attr("disabled", false);
            $("#guardarUsuario").removeClass('spinner spinner-white spinner-right');
        }
    });
}



function validar_email( email )
{
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

$(".tel1").inputmask("99-99999999");
$(".tel2").inputmask("99-99999999");
$(".tel3").inputmask("99-99999999");
$(".tel4").inputmask("99-99999999");

$("#cerrarReg").click(function(){
    $('#registroUsuario')[0].reset();
    $("#personafisica").hide();
    limpiar_puestos()

});
$("#closeRegisro").click(function(){
    $('#registroUsuario')[0].reset();
    $("#personafisica").hide();
    limpiar_puestos()
});

function actualizarPsswd(){
    if($("#rfcforgot").val()==""){
        swal.fire('Alerta!', 'Ingrese su RFC!', 'warning');
        return false;
    }

    if(!(validaRfc($("#rfcforgot").val()))){
        swal.fire('Alerta','El formato del RFC no es válido','warning');
        return false;
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    jQuery.ajax({
        cache: false,
        url: url+"rememberPass",
        method: "post",
        data: $( "#rememberPass" ).serialize(),
        beforeSend: function() {
            //bloquea boton
            $('#kt_login_forgot_submit_').attr("disabled", true);
            $("#kt_login_forgot_submit_").addClass("spinner spinner-white spinner-right");
         },
        success: function (result) {
            if(result.tipoerror=="noexiste"){
                swal.fire('¡Aviso!', result.error, 'warning');
            }else if(result.tipoerror=="falloenvio"){
                swal.fire('¡Aviso!', result.error, 'danger');
            }else if(result.tipoerror=="400"){
                swal.fire('¡Aviso!', result.error, 'danger');
            }else if(result.tipoerror=="inactivo"){
                swal.fire('¡Aviso!', result.error, 'warning');
            }else{
                swal.fire('¡Aviso!', result.message, 'success');
            }
            $('#kt_login_forgot_submit_').attr("disabled", false);
            $("#kt_login_forgot_submit_").removeClass("spinner spinner-white spinner-right");
        },
        error: function (err) {
            mensajeError(err);
            $('#kt_login_forgot_submit_').attr("disabled", false);
            $("#kt_login_forgot_submit_").removeClass("spinner spinner-white spinner-right");
        }
    });

}

/*$("#kt_login_forgot_submit").click(function(){
    if($("#rfcforgot").val()==""){
        swal.fire('Alerta!', 'Ingrese su RFC!', 'warning');
        return false;
    }

    //console.log();
    if(!(validaRfc($("#rfcforgot").val()))){
        swal.fire('Alerta','El formato del RFC no es valido','warning');
        return false;
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    jQuery.ajax({
        cache: false,
        url: url+"rememberPass",
        method: "post",
        data: $( "#rememberPass" ).serialize(),
        beforeSend: function() {
            //bloquea boton
            $('#kt_login_forgot_submit').attr("disabled", true);
            $("#kt_login_forgot_submit").addClass("spinner spinner-white spinner-right");
         },
        success: function (result) {
            if(result.tipoerror=="noexiste"){
                swal.fire('¡Aviso!', result.message, 'warning');
            }else if(result.tipoerror=="falloenvio"){
                swal.fire('¡Aviso!', result.message, 'danger');
            }else if(result.tipoerror=="400"){
                swal.fire('¡Aviso!', result.message, 'danger');
            }else{
                swal.fire('¡Aviso!', result.message, 'success');
            }
            $('#kt_login_forgot_submit').attr("disabled", false);
            $("#kt_login_forgot_submit").removeClass("spinner spinner-white spinner-right");
        },
        error: function (err) {
            mensajeError(err);
            $('#kt_login_forgot_submit').attr("disabled", false);
            $("#kt_login_forgot_submit").removeClass("spinner spinner-white spinner-right");
        }
    });
});*/

function validaRfc (rfc){
    var re = /^([ A-ZÑ&]?[A-ZÑ&]{3}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/,
    validado = rfc.match(re);
    if(!validado){
        return false;
    }else{
        return true;
    }
}

function inicializarValidacionesConSectPres(){
    $("#guardarUsuario").click(function(){
        var otroPuesto = $("#txtpuesto").val();
        var digitosRfc = $("#txtrfc").val();
        var tel1a = $("#telefonoF").val();
        var tel2a = $("#telefonoconfirmF").val();
        var tel1 = tel1a.replace(/_/gi,"");
        var tel2 = tel2a.replace(/_/gi,"");
        var ente = $("#txtentep").val();
        var cp = $("#txtcp").val();
        var entidad = $("#id_entidad").val();
        var alcaldia = $("#id_alcaldia").val();
        var colonia = $("#id_colonia").val();
        var calle = $("#txtcalle").val();
        var nexterior = $("#txtnexterior").val();
        var area = $("#area").val();
        var puesto = $("#puesto").val();
        var tipoContratacion = $("#tipo_contratacion").val();

        if($("#txtnombre").val()=="" || $("#txtamaterno").val()=="" || $("#txtapaterno").val()==""){
            mensajeError("Debe ingresar un RFC valido para ingresar los datos de nombre!");
            return false;
        }
        if(digitosRfc.length<13 || digitosRfc.length>13){
            mensajeError("Escriba los 10 digitos iniciales de su RFC!");
            return false;
        }
        if(tipoContratacion=="0" || tipoContratacion==""){
            mensajeError("Debe seleccionar un tipo de contratación!");
            return false;
        }
        if(ente==""){
            mensajeError("Debe ingresar el nombre de la entidad!");
            return false;
        }
        if(area=="0" || area==""){
            mensajeError("Debe seleccionar un área!");
            return false;
        }
        if(puesto=="0" || puesto==""){
            mensajeError("Debe seleccionar un puesto!");
            return false;
        }
        if(puesto=="other" && otroPuesto==""){
            mensajeError("Debes ingrear el otro puesto!");
            return false;
        }
        if(cp==""){
            mensajeError("Debe ingresar el código postal!");
            return false;
        }
        if(entidad=="0"){
            mensajeError("Debe seleccionar una entidad federativa!");
            return false;
        }
        if(alcaldia=="0"){
            mensajeError("Debe seleccionar una alcaldía o municipio!");
            return false;
        }
        if(colonia=="0"){
            mensajeError("Debe seleccionar una colonia!");
            return false;
        }
        if(calle==""){
            mensajeError("Debe ingresar la calle!");
            return false;
        }
        if(nexterior==""){
            mensajeError("Debe ingresar el número exterior!");
            return false;
        }
        if($("#email").val()=="" || $("#emailconfirm").val()=="" ){
            mensajeError("Debe ingresar los datos de correo electrónico!");
            return false;
        }
        if(!validar_email($("#email").val()) || !validar_email($("#emailconfirm").val()) ){
            mensajeError("El formato de correo electrónico no es valido!");
            return false;
        }
        if($("#email").val() != $("#emailconfirm").val()){
            mensajeError("Los correos electrónicos deben ser iguales!");
            return false;
        }
        if(tel1.length<11 || tel2.length>11){
            mensajeError("Escriba su número de teléfono a 10 posiciones!");
            return false;
        }
        if($("#telefonoF").val()=="__-________" || $("#telefonoconfirmF").val()=="__-________"){
            mensajeError("Escriba su número de teléfono!");
            return false;
        }
        if($("#telefonoF").val() != $("#telefonoconfirmF").val()){
            mensajeError("Los números de teléfono deben ser iguales!");
            return false;
        }
        guardarUsuario();

});
}

function iniacializarValidacioSinSectPres(){
    $("#guardarUsuario").click(function(){
        var otroPuesto = $("#txtpuesto").val();
        var digitosRfc = $("#txtrfc").val();
        var tel1a = $("#telefonoF").val();
        var tel2a = $("#telefonoconfirmF").val();
        var tel1 = tel1a.replace(/_/gi,"");
        var tel2 = tel2a.replace(/_/gi,"");
        var ente = $("#txtentep_sin").val();
        var cp = $("#txtcp").val();
        var entidad = $("#id_entidad").val();
        var alcaldia = $("#id_alcaldia").val();
        var colonia = $("#id_colonia").val();
        var calle = $("#txtcalle").val();
        var nexterior = $("#txtnexterior").val();
        var area = $("#area_sin").val();
        var puesto = $("#puesto_sin").val();
        var tipoContratacion = $("#tipo_contratacion").val();

        if($("#txtnombre").val()=="" || $("#txtamaterno").val()=="" || $("#txtapaterno").val()==""){
            mensajeError("Debe ingresar un RFC valido para ingresar los datos de nombre!");
            return false;
        }
        if(digitosRfc.length<13 || digitosRfc.length>13){
            mensajeError("Escriba los 10 digitos iniciales de su RFC!");
            return false;
        }
        if(tipoContratacion=="0" || tipoContratacion==""){
            mensajeError("Debe seleccionar un tipo de contratación!");
            return false;
        }
        if(ente == "" || ente=="0"){
            mensajeError("Debe ingresar el nombre de la entidad!");
            return false;
        }
        if(area=="0" || area==""){
            mensajeError("Debe seleccionar un área!");
            return false;
        }
        if(puesto=="0" || puesto==""){
            mensajeError("Debe seleccionar un puesto!");
            return false;
        }
        if(puesto=="other" && otroPuesto==""){
            mensajeError("Debes ingrear el otro puesto!");
            return false;
        }
        if(cp==""){
            mensajeError("Debe ingresar el código postal!");
            return false;
        }
        if(entidad=="0"){
            mensajeError("Debe seleccionar una entidad federativa!");
            return false;
        }
        if(alcaldia=="0"){
            mensajeError("Debe seleccionar una alcaldía o municipio!");
            return false;
        }
        if(colonia=="0"){
            mensajeError("Debe seleccionar una colonia!");
            return false;
        }
        if(calle==""){
            mensajeError("Debe ingresar la calle!");
            return false;
        }
        if(nexterior==""){
            mensajeError("Debe ingresar el número exterior!");
            return false;
        }
        if($("#email").val()=="" || $("#emailconfirm").val()=="" ){
            mensajeError("Debe ingresar los datos de correo electrónico!");
            return false;
        }
        if(!validar_email($("#email").val()) || !validar_email($("#emailconfirm").val()) ){
            mensajeError("El formato de correo electrónico no es valido!");
            return false;
        }
        if($("#email").val() != $("#emailconfirm").val()){
            mensajeError("Los correos electrónicos deben ser iguales!");
            return false;
        }
        if(tel1.length<11 || tel2.length>11){
            mensajeError("Escriba su número de teléfono a 10 posiciones!");
            return false;
        }
        if($("#telefonoF").val()=="__-________" || $("#telefonoconfirmF").val()=="__-________"){
            mensajeError("Escriba su número de teléfono!");
            return false;
        }
        if($("#telefonoF").val() != $("#telefonoconfirmF").val()){
            mensajeError("Los números de teléfono deben ser iguales!");
            return false;
        }
        guardarUsuario();

    });
}
$("#buscarfc").click(function(){
    var areas = $("#area");
    var lrfc = $("#rfc").val().toUpperCase();
    if(lrfc==""){
        swal.fire('¡Aviso!', 'Ingrese su RFC!', 'warning');
        return false;
    }
    if(lrfc.length<13){
        swal.fire('¡Aviso!', 'Ingrese su RFC a 13 posiciones!', 'warning');
        return false;
    }

    if(!validaRfc(lrfc)){
        swal.fire('Atención','El formato del RFC no es válido','warning');
        return $('#rfc').focus();

    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    jQuery.ajax({
        cache: false,
        url: url+"consultaRfc",
        method: "post",
        data: "rfc="+lrfc,
        beforeSend: function() {
            //bloquea boton
            $('#buscarfc').attr("disabled", true);
            $("#buscarfc").addClass("spinner spinner-white spinner-right");
         },
        success: function (result) {
            //console.log(result.data.error);
            if(result.data.error){
                swal.fire('Atención',result.data.mensaje,'warning');
                $('#buscarfc').attr("disabled", false);
                $("#buscarfc").removeClass("spinner spinner-white spinner-right");
            }else{
                swal.fire({
                    title: 'Aviso',
                    text:' ¿Deseas enviar tu información personal para que sea validada y se te proporcione un acceso?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText:'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        $("#registroServidorPublicoManual").modal('show')
                        $('#txtrfcManual').val(lrfc.toUpperCase());

                    }
                })
                $(result.datosUA).each(function(i, d){ // indice, valor
                    areas.append('<option value="' + d.id + '">' + d.unidad_admin + '</option>');
                });
                $('#buscarfc').attr("disabled", false);
                $("#buscarfc").removeClass("spinner spinner-white spinner-right");
            }
        },
        error: function (err) {
            mensajeError("Ha ocurrido un error, favor de recargar la página.");
            $('#buscarfc').attr("disabled", false);
            $("#buscarfc").removeClass("spinner spinner-white spinner-right");
        }
    });
});
$("#registroServidorPublicoManual").on('shown.bs.modal', function (event) {

    //getEntidades();


    $('#entes_llenados').select2();
    $('#areas_llenados').select2();
    $('#puesto_manual').select2();
  })
  $("#registroServidorPublicoManual").on('hidden.bs.modal', function (event) {

    validatorManual.resetForm();
  })
  $("#registro").on('shown.bs.modal', function (event) {





  })
  $("#registro").on('hidden.bs.modal', function (event) {
    $("#sinSectPres").addClass('d-none');
    $("#conSectPres").addClass('d-none');
    document.getElementById("registroUsuario").reset();
  })
function buscar_cp() {
    if ($('#txtcp').val() == "") {
        // limpiar combos
        $('#id_entidad').html('<option value="0">Selecciona</option>');
        $('#id_alcaldia').html('<option value="0">Selecciona</option>');
        $('#id_colonia').html('<option value="0">Selecciona</option>');
    } else {
        // busca cp
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            url: url+"buscar_cp",
            type: 'POST',
            data: 'cp=' + $('#txtcp').val(),
            dataType: "json",
            success: function(respuesta) {
                //console.log(respuesta);
                // limpiar combos
                $('#id_entidad').html('<option value="0">Selecciona</option>');
                $('#id_alcaldia').html('<option value="0">Selecciona</option>');
                $('#id_colonia').html('<option value="0">Selecciona</option>');

                if (respuesta.length > 0) {
                    //agrega Entidad
                    $('#id_entidad').append("<option value='" + respuesta[0].id_entidad + "' selected>" + respuesta[0].entidad + "</option>");
                    $('#id_alcaldia').append("<option value='" + respuesta[0].id_alcaldia + "' selected>" + respuesta[0].alcaldia + "</option>");
                    for (var i = 0; i < respuesta.length; i++) {
                        $('#id_colonia').append("<option value='" + respuesta[i].id + "'>" + respuesta[i].colonia + "</option>");
                    }
                }
            },
            error: function() {
                swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                return false;
            }
        });
    }
}

function buscar_puestos() {
        if($("#tipo_contratacion").val()==""){
            mensajeError("Debes seleccionar el tipo de contratación!");
            $("#area").val($("#area option:first").val());
            return false;
        }
        pageloader_in(1000,"Cargando....");
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $.ajax({
            url: url+"buscar_puestos",
            type: 'POST',
            data: 'area=' + $('#area').val() +'&tipo_contratacion=' + $('#tipo_contratacion').val(),
            dataType: "json",
            success: function(respuesta) {
                //console.log(respuesta);
                // limpiar combos
                $('#puesto').html('<option value="0">Selecciona una opción</option>');

                if (respuesta.length > 0) {
                    for (var i = 0; i < respuesta.length; i++) {
                        $('#puesto').append("<option value='" + respuesta[i].id + "'>" + respuesta[i].puesto_funcional + "</option>");
                    }
                }
                if($("#tipo_contratacion").val()!='E'){
                    $('#puesto').append('<option value="other">OTRO</option>');
                }

            },
            error: function() {
                swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
                return false;
            }
        });
}

function valida_otro(){
    if($("#puesto").val()=='other'){
        $("#textopuesto").show();
    }else{
        $("#textopuesto").hide();
        
    }
}

function valida_otro_sin(){
    if($("#puesto_sin").val()=='other'){
        $("#textopuesto").show();
    }else{
        $("#textopuesto").hide();
        
    }
}

function valida_otro_manual(){
    if($("#puesto_manual").val()=='other'){
        $("#textopuesto_manual").show();
    }else{
        $("#txtpuesto_sin").val('null');
        $("#textopuesto_manual").hide();
    }
}

function getDatosCurp(curp){
    if(curp == '' || curp == null){
        swal.fire('Atención','El CURP no debe ir vacio','warning');
        return false;

    }else{

        
        if(curp.length<18){
            swal.fire('¡Aviso!', 'Ingrese su CURP a 18 posiciones!', 'warning');
            return false;
        }

        

        $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: url+"getDatosCurp",
        type: 'GET',
        data: {curp: curp},
        dataType: "json",
        success: function(response){
            if(response.error == 'EXITOSO'){
                $('#txtnombre_manual').val(response.nombre).attr('readonly',true);
                $('#txtapaterno_manual').val(response.apellido1).attr('readonly',true);
                $('#txtamaterno_manual').val(response.apellido2).attr('readonly',true);
            }else{
                swal.fire('Atención','No se encontraron datos relacionados con el CURP = ' + curp,'warning');
                $('#txtnombre_manual').attr('readonly',false);
                $('#txtapaterno_manual').attr('readonly',false);
                $('#txtamaterno_manual').attr('readonly',false);
            }
            //console.log(response);
        },
        error: function(error){
            swal.fire('Error','Ocurrio un problema','error');
            console.log(error);
        }
    });

    }
    
}





jQuery(document).ready(function() {
    jQuery.validator.addMethod("rfcCurpMatch", function(value, element,required) {
      
      if (required){
        //return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
        var curp =  $('#txtCurpManual').val().toUpperCase();
        var rfc = $('#txtrfcManual').val().toUpperCase();
        if(curp.substr(0,10) != rfc.substr(0,10)){
            
            return false ;
        }else{

            return true;
        }
      }else{
        return true;
      }
    }, 'El CURP y el RFC no coinciden');

    jQuery.validator.addMethod("rfcValidate", function(value, element,required) {
      if (required){
        let validado =  value.toUpperCase().match(/^([ A-ZÑ&]?[A-ZÑ&]{3}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/);
        return (validado);
      }else{
        return true;
      }
    }, 'El formato de RFC es invalido');


    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
       }, "Debe seleccionar otra opcion.");
    initValidationRegistroManual();
    initSubmitManual();
    initValidationRegistroAutomatico();
    initSubmitAutomatico()

    /* inicializarValidacionesConSectPres(); */
    /* iniacializarValidacioSinSectPres(); */
    /* validatorManual.resetForm(); */
});
