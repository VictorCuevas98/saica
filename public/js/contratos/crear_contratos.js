"use strict";

function throwError(mensaje) {
    swal.fire('Atención', mensaje, 'warning');
}

function throwSuccessTimer(mensaje) {
    var timerInterval;
    swal.fire({
        icon: 'success',
        title: mensaje,
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            swal.showLoading();
            timerInterval = setInterval(() => {
                const content = swal.getHtmlContainer()
                if (content) {
                    const b = content.querySelector('b');
                    if (b) {
                        b.textContent = swal.getTimerLeft();
                    }
                }
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === swal.DismissReason.timer) {
            console.log('.');
        }
    });
}

function throwSuccess(mensaje, path = null) {
    swal.fire({
        icon: 'success',
        title: mensaje,
        timer: 3500,
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (path !== null) {
            $(location).attr('href', url + path);
        }
    });
}

function setAdquisicionFields(contrato) {

    //Campos obligatorios
    $("#crear_num_oficio_adjudicacion2").val(contrato.num_oficio_adjudicacion);


    $("#numero_requisicion").val(contrato.num_requisicion);

    if (contrato.id_origen_recurso !== null) {
        getOrigenRecurso(contrato.id_origen_recurso, $("#crear_orecurso_select"));
    }

    getLicitacion(contrato.id, $("#crear_tipomovimiento_select"), $("#crear_licitacion"));

    $("#rfc_del_proveedor").val(contrato.rfc);
    //$("#crear_numerocontrato").val(contrato.num_contrato);
    //$('input:radio[value=' + contrato.clave_tipo_contrato + ']').prop('checked', true);
    //$("#crear_flegal_select").val(contrato.clave_fundamento_legal);
    //$("#crear_flegal_select").change();

    //$("#crear_almacen_select").val();
    //$("#crear_tipomovimiento_select").val();

    //No es obligatorio
    /*
    //Fecha
    if (contrato.fecha_contrato !== null) {
        $("#crear_fecha").val(contrato.fecha_contrato);
        //DateTime::createFromFormat("d/m/Y", $request->crear_fecha)
    }

    //Numero de requisicion
    if (contrato.num_requisicion !== null) {
        $("#crear_num_requisicion").val(contrato.num_requisicion);
    }

    //Origen de Recurso

    if (contrato.id_origen_recurso !== null) {
        getOrigenRecurso(contrato.id_origen_recurso, $("#crear_orecurso_select"));
    }

    //Numero de Licitacion
    getLicitacion(contrato.id_adquisicion, $("#crear_tipomovimiento_select"), $("#crear_licitacion"));



    if (contrato.num_oficio_adjudicacion !== null) {
        //mostrar el campo | es requerido y el tipo de movimiento es Adjudicacion Directa
        $("#crear_tipomovimiento_select").val('adjudicacion_directa');
        $("#crear_tipomovimiento_select").change();
        $("#crear_adjudicacion").val(contrato.num_oficio_adjudicacion);
    }

    /*
    if (contrato.hasOwnProperty('fecha_contrato')){
        $("#crear_monto").val();
    }
    if (contrato.hasOwnProperty('fecha_contrato')){
        $("input:radio[name=montopieza]:checked").val();
    }
    if (contrato.hasOwnProperty('fecha_contrato')){
        $("#partida_especifica").val();
    }

    if (contrato.hasOwnProperty('fecha_contrato')){
        $("#crear_licitacion").attr('required');
    }
    if (contrato.hasOwnProperty('fecha_contrato')){
        $("#crear_adjudicacion").attr('required');
    }
    */
}

function clearAdquisicionFields() {
    $(".sec-adjudicar").val("");
}

function disabledAdquisicionFields() {
    $("#numero_requisicion").prop('disabled', true);
    $("#crear_orecurso_select").prop('disabled', true);
    $("#crear_almacen_select").prop('disabled', true);
    $("#crear_tipomovimiento_select").prop('disabled', true);
    $("#crear_licitacion").prop('disabled', true);
    $("#rfc_del_proveedor").prop('disabled', true);
}

function enableAduisicionFields() {
    $("#numero_requisicion").prop('disabled', false);
    $("#crear_orecurso_select").prop('disabled', false);
    $("#crear_almacen_select").prop('disabled', false);
    $("#crear_tipomovimiento_select").prop('disabled', false);
    $("#crear_licitacion").prop('disabled', false);
    $("#rfc_del_proveedor").prop('disabled', false);
}

function handlErrors(err) {
    if (err.status === 419) {
        throwError("Ha ocurrido un incoveniente, favor de verificar su informacion. Error 419");
    } else if (err.status === 422) { // cuando el codigo de status es 422 significa error de validacion
        console.log(err.responseJSON);
        console.warn(err.responseJSON.errors);
        if (err.responseJSON.errors){
            // mostrando errores del campo conrrespondiente
            $.each(err.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.removeClass("is-invalid");
                el.addClass("is-invalid");
                if (el.attr('name') === 'crear_fecha_contrato' || el.attr('name') === "rfc_del_proveedor" || el.hasClass('fecha-start') || el.hasClass('fecha-end')){
                    el.parent().after($('<div class="form-control-feedback">' + error[0] + '</div>'));
                }else{
                    el.after($('<div class="form-control-feedback">' + error[0] + '</div>'));
                }
                console.log('parent', String(el.attr('name')));
            });
            var cadena = '';
            $.each(err.responseJSON.errors, function (i, error) {
                cadena = cadena + '\<hr\>' + '-' + error[0];
            });
            throwError(cadena);
        }else if (err.responseJSON.message){
            throwError(err.responseJSON.message);
        }
    } else if (err.status === 500) {
        throwError("Ha ocurrido un incoveniente, favor de verificar su informacion. Error 500");
    }
}

function getLicitacion(id, element, element2) {
    $.ajax({
        url: url + '/licitaciones/checkExistId/idHaveAny/' + id,
        success: function (result) {
            if (!result) {
                //throwError('No se encontro algun número de licitacion asociado');
            } else {
                element.val('licitacion1');
                element.change();
                element2.val(result.licitacion.num_licitacion);
            }
        },
        error: function (err) {
            handlErrors(err);
        }
    });
}

function getOrigenRecurso(id, element) {
    $.ajax({
        url: url + '/origenRecurso/checkExistId/idHaveAny/' + id,
        success: function (result) {
            if (!result) {
                //throwError('No se encontro el Origen de Recurso');
            } else {
                element.val(result.origen.clave_origen_recurso);
                element.change();
            }
        },
        error: function (err) {
            handlErrors(err);
        }
    });
}

function createOrUpdateAdquisicion(adquisicion) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: url + '/contratos/store/adquisicion',
        method: 'post',
        data: {
            crear_num_oficio_adjudicacion: adquisicion[0],
            numero_requisicion: adquisicion[1],
            origen_de_recurso: adquisicion[2],
            licitacion: adquisicion[3],
            tipo_de_movimiento: adquisicion[4],
            rfc: adquisicion[5],
            f1: adquisicion[6],
        },
        success: function (result) {
            //id_adjudicacion = result.id;
            console.log('Resultado del metodo store Adquisicion', result);
        },
        error: function (err) {
            handlErrors(err);
            console.log('no se registro una adquisicion');
        }
    });
}

// Class definition
var DropzonePDF = function () {

    var demos = function () {

    }
    return {
        init: function () {
            demos();
        }
    };
}();

var KTSelect2 = function () {
    // Private functions
    var demos = function () {

        $('.tipomovimiento_select').select2({
            placeholder: "seleccione tipo de movimiento",
        });

        $('.flegal_select').select2({
            placeholder: "seleccione fundamento legal",
        });

        $('.orecursos_select').select2({
            placeholder: "seleccione origen del recurso"
        });

        $('.unidad_consolidadora_select').select2({
            placeholder: "seleccione unidad consolidadora"
        });
    }

    // Public functions
    return {
        init: function () {
            demos();
        }
    };
}();

var KTBootstrapDatepickerContratos = function () {
    // Private functions
    var demos2 = function () {
        $('#crear_fecha_contrato').datepicker({
            language: 'es',
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="ki ki-arrow-back"></i>',
                rightArrow: '<i class="ki ki-arrow-next"></i>'
            }
        });
    };

    return {
        // public functions
        init: function () {
            demos2();
        }
    };
}();


// Inicializacion
Dropzone.autoDiscover = false;

jQuery(document).ready(function () {
    KTSelect2.init();
    KTBootstrapDatepickerContratos.init();
    //VALIDAR EXISTENCIA DE CONTRATO
    $("#crear_contrato").blur(function () {
        var element = $(this);
        if (element.val() !== '') {
            $.ajax({
                url: url + '/contratos/checkContrato',
                post: 'post',
                data: {
                    id: element.val(),
                },
                beforeSend: function () {
                    element.removeClass('is-valid is-invalid');
                    element.next("div.valid-feedback").remove();
                    element.next("div.invalid-feedback").remove();
                },
                success: function (result) {
                    if (!result) {
                        //no hay, permitir el registro normalmente
                        element.after($('<div class="valid-feedback">Número de contrato único</div>'));
                    } else {
                        //si hay
                        throwError('Este número de contrato es invalido, ya existe.');
                        element.addClass('is-invalid');
                        element.after($('<div class="invalid-feedback">Ya existe un contrato con este número de contrato</div>'));
                    }
                },
                error: function (err) {
                    handlErrors(err);
                }
            });
        }
    });

    //VALIDAR EXISTENCIA DE OFICIO DE ADJUDICACION
    $("#crear_num_oficio_adjudicacion").blur(function () {
        var element = $(this);
        if (element.val() !== '') {

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                url: url + '/adquisiciones/checkExistAdquisicion/adjudicacionHaveAny',
                method: 'POST',
                data: {
                    oficio_de_adjudicacion: element.val(),
                },
                beforeSend: function () {
                    element.removeClass('is-valid is-invalid');
                    element.next("div.invalid-feedback").remove();
                    element.next("div.valid-feedback").remove();
                },
                success: function (result) {
                    if (!result) {
                        //no hay adquisicion, permitir el registro normalmente
                        element.addClass('is-valid');
                        element.after($('<div class="valid-feedback">No existe una adquisición con este oficio de adjudicacíon</div>'));
                        //Registrar nueva adquisicion
                        $(".crear_adjudicacion-selected").show();
                        $(".adquisicion-title").html('Crear Adquisición');
                        clearAdquisicionFields();
                        enableAduisicionFields();
                    } else if (result) {
                        //Adquisicion seleccionada
                        $(".crear_adjudicacion-selected").show();
                        $(".adquisicion-title").html('Adquisición seleccionada');
                        console.log(result.adquisicion);
                        setAdquisicionFields(result.adquisicion);
                        //disabledAdquisicionFields();
                        element.addClass('is-valid');
                        element.after($('<div class="valid-feedback">Ya existe una adquisición con este oficio de adjudicación</div>'));
                    }
                },
                error: function (err) {
                    handlErrors(err);
                }
            });
        }
    });

    var navListItems = $('div.wizard-panel ul li a'), // tab nav items class -> active
        allNextBtn = $('.nextBtnW'), // next button
        allBackBtn = $('.backBtnW'); // back button

    //validate seccion 1 of the wizard
    var crear_fecha_contrato,
        crear_contrato,
        crear_tipocontrato,
        crear_flegal_select,
        crear_num_oficio_adjudicacion,
        observaciones;


    //validate seccion 1 of the wizard if require a new adquisicion
    var numero_requisicion,
        rfc_del_proveedor,
        crear_tipomovimiento_select,
        crear_orecurso_select,
        crear_licitacion,
        unidad_consolidadora,
        objecto_adq,
        tipo_de_persona,
        razon_social_del_proveedor,
        representante_legal;

    //validate if exist the inputs
    var licitacion,
        array_names,
        unidad_consolidadora_required;

    //validate section 2 of the wizard

    var monto2,
        monto3,
        monto_minimo,
        monto_maximo;


    //validate section 3 of the wizard

    var id;
    //value of result ajax
    var resultado;

    // back button
    allBackBtn.click(function (e) {
        e.preventDefault();
        var curStep = $(this).closest(".content-wizard"),
            curStepBtn = curStep.attr("id");

        if (curStepBtn === 'tk_tab_wiz_3') {
            id = $("#id_contrato_previzualizacion").val();
            $(location).attr('href', url + '/contratos/showContratoArticulos/' + id);
        } else if (curStepBtn === 'tk_tab_wiz_4') {
            id = $("#id_contrato_archivo").val();
            $(location).attr('href', url + '/contratos/showPrevisualizacion/' + id);
        }
    });
    // next button
    allNextBtn.click(function (e) {
        e.preventDefault();
        swal.fire({
            title: '¿Estas seguro?',
            text: "Verifica que la información sea la correcta",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#235B4E',
            confirmButtonText: 'Si, continuar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
        }).then((result) => {
            if (result.value) {
                var curStep = $(this).closest(".content-wizard"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.wizard-panel ul li a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    idButton = $(this).attr("id");

                switch (idButton) {
                    //PRIMER SECCION DEL WIZARD
                    case 'btn-wiz-1':
                        crear_fecha_contrato = $("#crear_fecha_contrato").val(),
                            crear_contrato = $("#crear_contrato").val(),
                            crear_tipocontrato = $('input:radio[name=crear_tipocontrato]:checked').val(),
                            crear_flegal_select = $("#crear_flegal_select").val(),
                            crear_num_oficio_adjudicacion = $("#crear_num_oficio_adjudicacion").val(),
                            observaciones = $("#crear_observaciones").val(),
                            array_names = [
                                'crear_fecha_contrato',
                                'crear_contrato',
                                'crear_tipocontrato',
                                'crear_flegal_select',
                                'crear_num_oficio_adjudicacion',

                                'numero_requisicion',
                                'crear_orecurso_select',
                                'crear_licitacion',
                                'crear_tipomovimiento_select',
                                'rfc_del_proveedor',
                                'tipo_de_persona',
                                'razon_social_del_proveedor',
                                'unidad_consolidadora',
                            ],

                            //Campos para el registro de minimos y maximos
                            monto_minimo = $("#monto_minimo").val(),
                            monto_maximo = $("#monto_maximo").val(),

                            monto2 = $("#monto_minimo").attr('required'),
                            monto3 = $("#monto_maximo").attr('required'),

                            // Campos para el registro de adquisicion
                            numero_requisicion = $("#numero_requisicion").val(),
                            crear_orecurso_select = $("#crear_orecurso_select").val(),
                            crear_licitacion = $("#crear_licitacion").val(),
                            licitacion = $("#crear_licitacion").attr('required'),

                            unidad_consolidadora =$("#unidad_consolidadora").val(),
                            unidad_consolidadora_required = $("#unidad_consolidadora").attr('required'),

                            crear_tipomovimiento_select = $("#crear_tipomovimiento_select").val(),
                            rfc_del_proveedor = $("#rfc_del_proveedor").val(),
                            tipo_de_persona = $("#tipo_de_persona").val(),
                            razon_social_del_proveedor = $("#razon_social_del_proveedor").val(),
                            representante_legal = $("#representante_legal").val(),
                            objecto_adq = [
                                crear_num_oficio_adjudicacion,
                                numero_requisicion,
                                crear_orecurso_select,
                                crear_licitacion,
                                crear_tipomovimiento_select,
                                rfc_del_proveedor,
                                tipo_de_persona,
                                razon_social_del_proveedor,
                                licitacion];

                        var el = $("#tk_tab_wiz_1").find('input[class="is-invalid"]');
                        console.log(el);
                        console.log('cambios8');
                        if (typeof el !== 'undefined'){
                            el.removeClass("is-invalid");
                        }
                        $("input.is-invalid").removeClass('is-invalid');
                        $(".invalid-feedback").remove();
                        $(".form-control-feedback").remove();
                        $(".valid-feedback").remove();

                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            }
                        });

                        $.ajax({
                            cache: false,
                            url: url + "/contratos/store",
                            method: "post",
                            data: {
                                crear_fecha_contrato: crear_fecha_contrato,
                                crear_contrato: crear_contrato,
                                crear_tipocontrato: crear_tipocontrato,
                                crear_flegal_select: crear_flegal_select,
                                crear_num_oficio_adjudicacion: crear_num_oficio_adjudicacion,
                                observaciones: observaciones,

                                //contrato abierto
                                monto_minimo: monto_minimo,
                                monto_maximo: monto_maximo,
                                c2: monto2,
                                c3: monto3,

                                //adquisicion
                                numero_requisicion: numero_requisicion,
                                crear_orecurso_select: crear_orecurso_select,
                                crear_licitacion: crear_licitacion,
                                crear_tipomovimiento_select: crear_tipomovimiento_select,
                                rfc_del_proveedor: rfc_del_proveedor,
                                licitacion: licitacion,
                                unidad_consolidadora: unidad_consolidadora,
                                unidad_consolidadora_required: unidad_consolidadora_required,
                                tipo_de_persona: tipo_de_persona,
                                razon_social_del_proveedor: razon_social_del_proveedor,
                                representante_legal: representante_legal,

                            },
                            beforeSend: function () {
                                //createOrUpdateAdquisicion(objecto_adq);

                            },
                            success: function (result) {
                                //CREAR REGISTRO EN contratos_abiertos
                                if (crear_tipocontrato === 'A') {
                                    $.ajax({
                                        url: url + '/contratos/storeArticuloContratoAbierto',
                                        method: 'post',
                                        data: {
                                            numero_contrato: crear_contrato,
                                        },
                                        success: function (result) {
                                            //id_adjudicacion = result.id;
                                            console.log('se registro un contrato abierto');
                                        },
                                        error: function (err) {
                                            handlErrors(err);
                                            console.log('no se registro el contrato abierto');
                                        }
                                    });
                                }
                                if (crear_tipocontrato === 'C') {
                                    console.log('aqui andamos ejecutando registro al contrato cerrado');
                                    $.ajax({
                                        url: url + '/contratos/storeArticuloContratoCerrado',
                                        method: 'post',
                                        data: {
                                            numero_contrato: crear_contrato,
                                        },
                                        success: function (result) {
                                            //id_adjudicacion = result.id;
                                            console.log('se registro un contrato abierto');
                                        },
                                        error: function (err) {
                                            handlErrors(err);
                                            console.log('no se registro el contrato abierto');
                                        }
                                    });
                                }
                                createOrUpdateAdquisicion(objecto_adq);
                                resultado = result.id;
                                console.log('resultado de store contratos', result.puesto_persona);
                                throwSuccess(result.mensaje, '/contratos/showContratoArticulos/' + resultado);
                            },
                            error: function (err) {
                                handlErrors(err);
                                //var el = $(document).find('[name="' + array_names + '"]');

                            }
                        });
                        break;

                    //SEGUNDA SECCION DEL WIZARD
                    case 'btn-wiz-2':
                        resultado = $("#hashid-contrato").val();
                        throwSuccess('Se guardo correctamente', '/contratos/showPrevisualizacion/' + resultado);
                        break;

                    case 'btn-wiz-3':

                        resultado = $("#id_contrato_previzualizacion").val();
                        throwSuccess('Se guardo correctamente', '/contratos/showContratoArchivos/' + resultado);
                        break;

                    case 'btn-wiz-4':
                        id = $("#id_contrato_archivo").val();
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                            }
                        });

                        var oth2 = $.ajax({
                            cache: false,
                            url: url + "/contratos/storePrevisualizacion",
                            method: "post",
                            data: {
                                id: id
                            },
                            beforeSend: function () {
                            },
                            success: function (result) {
                                throwSuccess(result.mensaje, '/contratos');
                            },
                            error: function (err) {
                                handlErrors(err);
                            }
                        });
                        break;
                }
            }
        });
    });

    $('div.wizard-panel ul li a.active').attr('style', 'color:blue');

    //Dropzone

    function showPDF(mockFile, path) {
        mockFile.previewElement.addEventListener("click", function () {
            //mostrar el modal con pdf
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                cache: false,
                url: url + '/contratos/showModalPDF',
                method: "post",
                data: {
                    path: path,
                },
                success: function (result) {
                    var modal = result;
                    $(modal).modal('show');
                },
                error: function (err) {
                    handlErrors(err);
                }
            });
        });
    }
    var idtemp = $("#id_contrato_archivo").val();
    var documento = $("#documento_seccion_contrato");
    var maxFiles = (documento.data('filename') !== '')?0:1;
    var myDropzone = new Dropzone("form#dropzone-contratos-firma", {
        url: url + '/contratos/storeFiles/' + idtemp,
        maxFilesize: 3, //MB
        maxFiles: maxFiles,
        acceptedFiles: ".pdf",
        addRemoveLinks: true,
        dictMaxFilesExceeded: "Solo puedes subir un archivo",
        dictRemoveFile: "Eliminar",
        dictCancelUploadConfirmation: "¿Estas seguro de cancelar la carga del archivo?",
        dictInvalidFileType: 'No puedes adjuntar archivos de este tipo',
        accept: function (file, done) {
            var thumbnail = $('#dropzone-contratos-firma .dz-preview.dz-file-preview .dz-image:last');
            var path = url + '/images/pdf.png';
            //var def = url + '/images/telefono.png';
            switch (file.type) {
                case 'application/pdf':
                    thumbnail.css('background', 'url(' + path + ')');
                    done();
                    break;
                default:
                    //thumbnail.css('background', 'url(' + def + ')');
                    done("Archivo Invalido");
            }
        },
    });

    var response;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
    var mockFile = {name: documento.data('filename'), size: 12345, dataURL: url + '/images/pdf.png'};

    myDropzone.on("sending", function (file, xhr, formData) {
        console.log('file: ', file);
        formData.append("_token", CSRF_TOKEN);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                response = (JSON.parse(xhr.response));
                showPDF(file, response.documento.filename);
                console.log(response);
            }
            else {
                console.log(response);
            }
        };
    });

    if (documento.data('filename') !== '') {
        myDropzone.options.addedfile.call(myDropzone, mockFile);
        //myDropzone.addFile(mockFile);
        myDropzone.options.thumbnail.call(myDropzone, mockFile, documento.data('realPath') + documento.data('filename'));
        mockFile.previewElement.classList.add('dz-success');
        mockFile.previewElement.classList.add('dz-complete');

        myDropzone.emit("complete", mockFile);
        var ext = mockFile.name.split(".");
        var count = ext.length;
        switch (ext[count-1]) {
            case "pdf":
                myDropzone.createThumbnailFromUrl(mockFile,
                    myDropzone.options.thumbnailWidth,
                    myDropzone.options.thumbnailHeight,
                    myDropzone.options.thumbnailMethod, true, function (thumbnail) {
                        myDropzone.emit('thumbnail', mockFile, thumbnail);
                    });
                break;
            default:
        }
        showPDF(mockFile, documento.data('filename'));
    }

    myDropzone.on("removedfile", function (file) {
        if (file.status !== 'error'){
            $.ajax({
                type: 'GET',
                url: url + '/contratos/destroyFile/' + idtemp,
                succes: function (result) {
                    console.log(result);
                }
            });
        }
        console.log(file.status);
    });
});

//Condiciones dinamicas Jquery (registro de contratos)
$('input[name=crear_tipocontrato]').on('change', function () {

    var tipo_contrato = $('input[name=crear_tipocontrato]:checked').val(),
        radiobtn = $('#elemento_opcional_radiobtn');


    if (tipo_contrato === 'C') {
        radiobtn.hide();
        radiobtn.find('input[name=element1]').removeAttr('required');
    } else if (tipo_contrato === 'A') {
        radiobtn.show();
        radiobtn.find('input[name=element1]').prop('required', true);
    }
});

//TIPO MONTO O CANTIDAD
$('input[name=element1]').on('change', function () {
    var tipo = $('input[name=element1]:checked').val(),
        monto = $('#sec_monto');

    if (tipo === 'monto') {
        monto.show();
        monto.find('input[id=monto_minimo]').prop('required', true);
        monto.find('input[id=monto_maximo]').prop('required', true);
    } else if (tipo === 'cantidad') {
        monto.hide();
        monto.find('input[id=monto_minimo]').removeAttr('required');
        monto.find('input[id=monto_maximo]').removeAttr('required');
        monto.find('input[id=monto_minimo]').val('');
        monto.find('input[id=monto_maximo]').val('');
    }
});

$('select#crear_tipomovimiento_select').on('change', function () {
    var select_main = $(this).val();
    var unidades_consolidadoras = $('#unidades_consolidadoras');
    var numero_licitacion = $('#elemento_opcional_contratos2');
    if (select_main === 'adjudicacion_directa') {
        numero_licitacion.hide();
        numero_licitacion.find('input[id=crear_licitacion]').removeAttr('required');
        unidades_consolidadoras.hide();
        unidades_consolidadoras.find('select[id=unidad_consolidadora]').removeAttr('required');
    } else if (select_main === 'licitacion1' || select_main === 'licitacion2' || select_main === 'licitacion3') {
        numero_licitacion.show();
        numero_licitacion.find('input[id=crear_licitacion]').prop('required', true);
        unidades_consolidadoras.hide();
        unidades_consolidadoras.find('select[id=unidad_consolidadora]').removeAttr('required');
    } else if (select_main === 'licitacion5_consolidada' || select_main === 'licitacion4_consolidada' ){
        numero_licitacion.show();
        numero_licitacion.find('input[id=crear_licitacion]').prop('required', true);
        unidades_consolidadoras.show();
        unidades_consolidadoras.find('select[id=unidad_consolidadora]').prop('required', true);
    }
});

//Firma Autograma
$('#btn-firma-autografa').on('click', function () {
    $('#firma-autografa').show();
    $('#opcion-firma').hide();
});

//Dropzone
/*
$("div#dropzone-contratos").dropzone({url: "/contratos/store"});
var filezone = $("div#dropzone-contratos");
filezone.options = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    accept: function (file, done) {
        if (file.name === "justinbieber.jpg") {
            done("Naha, you don't.");
        } else {
            done();
        }
    }
};
*/

/*
$('#page_contrato').on('load', function () {
    var sec = $(this).attr('data-seccion');

    if (sec !== '') {
        switch (sec) {
            case 1:
                console.log('sec: ' + sec + 'primer registro ');
                var stepWizard = $('div.wizard-panel ul li a[href="#tk_tab_wiz_1"]');
                stepWizard.trigger('click');
                break;

            case 2:
                stepWizard = $('div.wizard-panel ul li a[href="#tk_tab_wiz_2"]');
                stepWizard.trigger('click');
                break;

            case 3:
                stepWizard = $('div.wizard-panel ul li a[href="#tk_tab_wiz_3"]');
                stepWizard.trigger('click');
                break;

            case 4:
                stepWizard = $('div.wizard-panel ul li a[href="#tk_tab_wiz_4"]');
                stepWizard.trigger('click');
                break;

            case 5:
                stepWizard = $('div.wizard-panel ul li a[href="#tk_tab_wiz_5"]');
                stepWizard.trigger('click');
                break;


        }
    }
});
 */
/*

Propuesta de wizard


$(document).ready(function () {
            var navListItems = $('div.setup-panel div a'), // tab nav items
                allWells = $('.setup-content'), // content div
                allNextBtn = $('.nextBtn'); // next button

            allWells.hide(); // hide all contents by defauld

            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('href')),
                    $item = $(this);

                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-primary').addClass('btn-default');
                    $item.addClass('btn-primary');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });
            // next button
            allNextBtn.click(function(){
                var curStep = $(this).closest(".setup-content"),
                    curStepBtn = curStep.attr("id"),
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url']"),
                    isValid = true;
                // Validation
                $(".form-group").removeClass("has-error");
                for(var i=0; i<curInputs.length; i++){
                    if (!curInputs[i].validity.valid){
                        isValid = false;
                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                    }
                }
                // move to next step if valid
                if (isValid)
                    nextStepWizard.removeAttr('disabled').trigger('click');
            });

            $('div.setup-panel div a.btn-primary').trigger('click');
        });

        */
