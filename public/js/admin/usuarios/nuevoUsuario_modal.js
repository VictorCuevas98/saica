//nuevoUsuario.js


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

        $("#puesto_manual_container").hide();
    })
}

function validar_email(email)
{
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
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
            jQuery('#txtnombre_manual').valid();
            jQuery('#txtapaterno_manual').valid();
            jQuery('#txtamaterno_manual').valid();
        },
        error: function(error){
            swal.fire('Error','Ocurrio un problema','error');
            console.log(error);
            
        }
    });

    }
    jQuery('#txtrfcManual').valid();
    
}

let tipoDeContratacionChange = ()  => {    
    $("#puesto_manual_container").hide();
    $("#puesto_manual").empty();
    $("#txtpuestomanual").val("");
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

async function buscar_puestos_manual() {
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
            //$('#puesto_manual').html('<option value="">Selecciona una opción</option>');
            $("#puesto_manual").empty();
            $('#puesto_manual').append('<option value="" >Selecciona un puesto</option>');
            if (respuesta.length > 0) {
                for (var i = 0; i < respuesta.length; i++) {
                    $('#puesto_manual').append('<option value="'+ respuesta[i].id + '">' + respuesta[i].puesto_funcional + '</option>');
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

function mensajeError(mensaje){
      swal.fire('Mensaje!', mensaje, 'warning');
}

let limpiarCampos = () => {
    
    $("#entes_llenados").val("").change();
    //.val("the_new_value").change();
    //$('.selDiv option:eq(1)').attr('selected', 'selected') //older versions
    //limpiar_puestosManual();
    $("#txtCurpManual").val('');
    $("#txtrfcManual").val('');
    $("#txtnombre_manual").val('');
    $("#txtapaterno_manual").val('');
    $("#txtamaterno_manual").val('');
    $("#num_empleado").val('');
    $("#txtpuestomanual").val('');
    $("#emailManual").val('');
    $("#emailconfirmManual").val('');
    $("#telefono").val('');
    $("#telefono_confirmation").val('');
    $("#tipo_contratacion_manual").val("").change();
    //$("#areas_llenados").empty();
    //$("#puesto_manual").empty();
};
function limpiar_puestosManual(){
    var puesto = $("#puesto_manual");
    puesto.find('option').remove();
    //console.log('reiniciarr')
    $("#areas_llenados").val("").change();
    /*if ($("#areas_llenados").val() != null) {
        $("#areas_llenados").val('').trigger('change');
    }*/

    $("#txtpuesto").val("");
    $("#textopuesto_manual").hide();
}

function validaRfc (rfc){
    var re = /^([ A-ZÑ&]?[A-ZÑ&]{3}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/,
    validado = rfc.match(re);
    if(!validado){
        return false;
    }else{
        return true;
    }
}
function valida_otro_manual(){
    if($("#puesto_manual").val()=='other'){
        $("#textopuesto_manual").show();
    }else{
        $("#txtpuesto_sin").val('');
        $("#textopuesto_manual").hide();
    }
}

$("#txtrfcManual").change(function(){
    var areas = $("#area");
    var lrfc = $("#txtrfcManual").val().toUpperCase();
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
        return $('#txtrfcManual').focus();

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
    jQuery('#txtCurpManual').valid();
});






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });



jQuery.validator.addMethod("rfCurp", function(value, element, param) {
    if(value === $('#curp').val().slice(0, 10)){
        return true;
    } else {
        return false;
    }
});



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


var formRegistroServidorPublicos = $("#registroUsuarioManualAdmin")
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
            puesto_manual:{
                required: true,
            },
            txtpuestomanual:{
                required: true
            },
            telefono: {
                required: false,
            },
            telefono_confirmation:{
                required: false,
                equalTo: '#telefono'
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
            txtCurpManual: {
                minlength: jQuery.validator.format("El CURP no debe tener menos de  {0} catacteres!"),
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
            telefono_confirmation:{
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
                required: 'Es encesario seleccionar un puesto'
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
            console.log("hacemos submit **");
            console.log("form",form);

            var curp = $('#txtCurpManual').val().toUpperCase();
            var rfc = $('#txtrfcManual').val().toUpperCase();
            //console.log('CURP = ',curp.substr(0,10), 'RFC = ',rfc.substr(0,10));
            if(curp.substr(0,10) != rfc.substr(0,10)){
                swal.fire('Atención','El CURP y el RFC no coinciden','warning');
                $('#txtCurpManual').focus();
                return false;
            }

        }
    });
};



//Fin validaciones
var initSubmitManual = function() {
    //console.log('in')
    var btn = $('#btn-guardarUsuarioManualAdmin');
    //var url = window.location.href;
    btn.on('click', function(e) {
        //console.log('entro en boton');
        e.preventDefault();
        if (validatorManual.form()) {

            var curp = $('#txtCurpManual').val().toUpperCase();
            var rfc = $('#txtrfcManual').val().toUpperCase();
            //console.log('CURP = ',curp.substr(0,10), 'RFC = ',rfc.substr(0,10));
            if(curp.substr(0,10) != rfc.substr(0,10)){
                swal.fire('Atención','El CURP y el RFC no coinciden','warning');
                return $('#txtCurpManual').focus();
            }
            
            swal.fire({
                title: "Guardando",
                text: "Guardando nuevo usuario.",
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
            jQuery.ajax({
                cache: false,
                url: url + 'users',
                method: "post",
                data: formRegistroServidorPublicos.serialize(),
                dataType: 'json',
                beforeSend: function() {
                    //bloquea boton
                    btn.attr("disabled", true);
                    btn.addClass("spinner spinner-white spinner-right");
                 },
                success: function (result) {
                    console.log(result);
                    if(result.success){
                        swal.fire('getInitial', result.msg, 'success');
                        $('#registroServidorPublicoManual').modal('hide');
                    }
                    btn.attr("disabled", false);
                    btn.removeClass("spinner spinner-white spinner-right");

                },
                error: function (err) {
                    let mensajeError  = "";
                    $.each( err.responseJSON.errors, (index, value ) => {
                        mensajeError += value+"<br>";
                    });
                    swal.fire('Lo siento!', mensajeError, 'warning');
                    btn.attr("disabled", false);
                    btn.removeClass('spinner spinner-white spinner-right');
                }
            });
        }
    });
};

$('#registroServidorPublicoManual').on('hidden.bs.modal', function (e) {
    limpiarCampos();
    console.log("hay que limpiar los campos ");
});

$("#registroServidorPublicoManual").on('shown.bs.modal', function (event) {
    validatorManual.resetForm();
});

jQuery(document).ready(function() {
    initValidationRegistroManual();
    initSubmitManual();
    
    $('.select2').select2({
        width: '100%'
    });

});
