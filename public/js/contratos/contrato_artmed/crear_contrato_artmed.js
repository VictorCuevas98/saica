function closeModalArticuloEdit() {
    $('#exampleModalArticuloEdit').modal('hide');
}

function drawPeriodoParcialDeEntrega(form) {
    var count = $('.table-FOC-periodo').find('tr').length;
    $(form).find('tbody').append(` 
    <tr class="periodo`+count+`">
        <td class="fecha-periodo">
            <div class="input-daterange input-group my-auto kt_datepicker_5">
                <input type="text" class="form-control fecha-start" placeholder="Desde" id="fecha_start`+count+`" name="fecha_start`+count+`"/>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="ki ki-more-hor"></i></span>
                </div>
                <input type="text" class="form-control fecha-end" placeholder="Hasta" id="fecha_end`+count+`" name="fecha_end`+count+`"/>
            </div>
        </td>
        <td>
            <div class="my-auto">
                <input type="number" class="form-control cantidad-de-articulos-a-entregar" id="cantidad_de_articulos_a_entregar`+count+`" name="cantidad_de_articulos_a_entregar`+count+`">
            </div>
        </td>
        <td>
            <a href="javascript:;" class="btn btn-sm font-weight-bolder data-repeater-delete">
                <i class="far fa-trash-alt"></i>
            </a>
        </td>
    </tr>`);
}

/*
//SE AGREGA HTML A LA TABLA DE ARTICULOS
function drawArtmed(element, obj) {
    $("#table-FOC-articulos2").find('tbody').append(` <tr>\
        <td class="clave-articulo">` + element.clave + `</td>
        <td class="cantidad-articulo">` + obj.cantidad + `</td>
        <td class="precio-articulo">` + obj.precio + `</td>
        <td class="unidad-medida-articulo">` + element.unidad_medida + `</td>
        <td class="descripcion-articulo">` + element.artmed + `</td>
        <td style="width: 140px;">
            <button
                title="ver detalles"
                class="btn btn-sm btn-clean btn-icon btn-show-contrato" data-show=` + obj.hashid + `><i
                    class="fas fa-arrow-right"></i></button>
            <button
                title="editar"
                class="btn btn-sm btn-clean btn-icon btn-edit-contrato" data-edit=` + obj.hashid + `><i
                    class="far fa-edit"></i></button>
            <button title="eliminar"
                    class="btn btn-sm font-weight-bolder art-delete" data-delete=` + obj.hashid + `>
                <i class="far fa-trash-alt"></i>
            </button>
        </td>
    </tr>`);
}
*/
var setDatepicker = function () {
    // Private functions
    var demos = function () {
        // range picker
        $('.kt_datepicker_5').datepicker({
            container: '#exampleModalArticuloEdit',
            language: 'es',
            rtl: KTUtil.isRTL(),
            orientation: "bottom left",
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="ki ki-arrow-back"></i>',
                rightArrow: '<i class="ki ki-arrow-next"></i>'
            },
        });
    };

    // Public functions
    return {
        init: function () {
            demos();
        }
    };
}();

var getFormsArtmed = function () {
    // Private functions
    var demos = function (callbackContratosClick) {
        $(".guardar-artmed-contratos").on('click', function () {
            //Guardar articulo y periodo parcial

            var id_artmed = $(".id_artmed").val(),
                id_contrato = $(".id_contrato").val(),
                cantidad_de_articulos = $("#cantidad_de_articulos").val(),
                precio_del_articulo = $("#precio_del_articulo").val(),
                monto_del_articulo = $("#monto_del_articulo").val(),
                cantidad_minima = $("#cantidad_minima").val(),
                cantidad_maxima = $("#cantidad_maxima").val(),
                //monto_minimo = $(".monto-minimo").val(),
                //monto_maximo = $(".monto-maximo").val(),

                s1 = $("#cantidad_de_articulos").attr('required'),
                s2 = $("#precio_del_articulo").attr('required'),
                s3 = $("#cantidad_minima").attr('required'),
                s4 = $("#cantidad_maxima").attr('required'),

                fecha_start1 = $("#fecha_start1").val(),
                fecha_end1 = $("#fecha_start1").val(),
                cantidad_de_articulos_a_entregar1 = $("#cantidad_de_articulos_a_entregar1").val(),
                fecha_start2 = $("#fecha_start2").val(),
                fecha_end2 = $("#fecha_start2").val(),
                cantidad_de_articulos_a_entregar2 = $("#cantidad_de_articulos_a_entregar2").val(),
                fecha_start3 = $("#fecha_start3").val(),
                fecha_end3 = $("#fecha_start3").val(),
                cantidad_de_articulos_a_entregar3 = $("#cantidad_de_articulos_a_entregar3").val(),
                fecha_start4 = $("#fecha_start4").val(),
                fecha_end4 = $("#fecha_start4").val(),
                cantidad_de_articulos_a_entregar4 = $("#cantidad_de_articulos_a_entregar4").val(),
                fecha_start5 = $("#fecha_start5").val(),
                fecha_end5 = $("#fecha_start5").val(),
                cantidad_de_articulos_a_entregar5 = $("#cantidad_de_articulos_a_entregar5").val(),
                fecha_start6 = $("#fecha_start6").val(),
                fecha_end6 = $("#fecha_start6").val(),
                cantidad_de_articulos_a_entregar6 = $("#cantidad_de_articulos_a_entregar6").val(),
                fecha_start7 = $("#fecha_start7").val(),
                fecha_end7 = $("#fecha_start7").val(),
                cantidad_de_articulos_a_entregar7 = $("#cantidad_de_articulos_a_entregar7").val(),
                fecha_start8 = $("#fecha_start8").val(),
                fecha_end8 = $("#fecha_start8").val(),
                cantidad_de_articulos_a_entregar8 = $("#cantidad_de_articulos_a_entregar8").val(),
                fecha_start9 = $("#fecha_start9").val(),
                fecha_end9 = $("#fecha_start9").val(),
                cantidad_de_articulos_a_entregar9 = $("#cantidad_de_articulos_a_entregar9").val(),
                fecha_start10 = $("#fecha_start10").val(),
                fecha_end10 = $("#fecha_start10").val(),
                cantidad_de_articulos_a_entregar10 = $("#cantidad_de_articulos_a_entregar10").val(),
                periodos = [];

            $("#pariodo_parcial_entregas").find(".fecha-periodo").parent("tr").each(function () {
                var arr = [$(this).find('.fecha-start').val(), $(this).find('.fecha-end').val(), $(this).find('.cantidad-de-articulos-a-entregar').val()];
                periodos.push(arr);
            });

            console.log('periodos: ', periodos);
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
                url: url + '/contratos/storeArticulosContratos',
                method: 'post',
                data: {
                    id_artmed: id_artmed,
                    id_contrato: id_contrato,
                    cantidad_de_articulos: cantidad_de_articulos,
                    precio_del_articulo: precio_del_articulo,
                    monto_del_articulo: monto_del_articulo,
                    cantidad_minima: cantidad_minima,
                    cantidad_maxima: cantidad_maxima,
                    //monto_minimo: monto_minimo,
                    //monto_maximo: monto_maximo,
                    s1: s1,
                    s2: s2,
                    s3: s3,
                    s4: s4,
                    fecha_start1: fecha_start1,
                    fecha_end1: fecha_end1,
                    cantidad_de_articulos_a_entregar1: cantidad_de_articulos_a_entregar1,
                    fecha_start2: fecha_start2,
                    fecha_end2: fecha_end2,
                    cantidad_de_articulos_a_entregar2: cantidad_de_articulos_a_entregar2,
                    fecha_start3: fecha_start3,
                    fecha_end3: fecha_end3,
                    cantidad_de_articulos_a_entregar3: cantidad_de_articulos_a_entregar3,
                    fecha_start4: fecha_start4,
                    fecha_end4: fecha_end4,
                    cantidad_de_articulos_a_entregar4: cantidad_de_articulos_a_entregar4,
                    fecha_start5: fecha_start5,
                    fecha_end5: fecha_end5,
                    cantidad_de_articulos_a_entregar5: cantidad_de_articulos_a_entregar5,
                    fecha_start6: fecha_start6,
                    fecha_end6: fecha_end6,
                    cantidad_de_articulos_a_entregar6: cantidad_de_articulos_a_entregar6,
                    fecha_start7: fecha_start7,
                    fecha_end7: fecha_end7,
                    cantidad_de_articulos_a_entregar7: cantidad_de_articulos_a_entregar7,
                    fecha_start8: fecha_start8,
                    fecha_end8: fecha_end8,
                    cantidad_de_articulos_a_entregar8: cantidad_de_articulos_a_entregar8,
                    fecha_start9: fecha_start9,
                    fecha_end9: fecha_end9,
                    cantidad_de_articulos_a_entregar9: cantidad_de_articulos_a_entregar9,
                    fecha_start10: fecha_start10,
                    fecha_end10: fecha_end10,
                    cantidad_de_articulos_a_entregar10: cantidad_de_articulos_a_entregar10,
                    periodos: periodos,
                },
                success: function (result) {
                    callbackContratosClick(result);
                    closeModalArticuloEdit();
                },
                error: function (err) {
                    handlErrors(err);
                }
            });

            //var obj = $(this).data('artmedObj');
            //var obj = jQuery.parseJSON($(this).data(obj));
            //callbackContratosClick(obj);
            //closeModalArticuloEdit();
        });
    };

    // Public functions
    return {
        init: function (callbackContratosClick) {
            demos(callbackContratosClick);
        }
    };
}();

var PeriodoParcialDeEntregasDelete = function () {
    var demo1 = function () {
        $(".data-repeater-delete").on('click', function () {
            if ($(this).parent().parent().parent().find('.cantidad-de-articulos-a-entregar').length > 1) {
                $(this).parent().parent().remove();
            }
        });
    };
    return {
        // public functions
        init: function () {
            demo1();
        }
    };
}();

//Agregar otro periodo parcial de entregas

var PeriodoParcialDeEntregas = function () {
    var demo1 = function () {
        $(".data-repeater-create").on('click', function () {
            var form = $("#form-artmed-periodo"),
                //clave_del_articulo = $(form).find('.clave-artmed-periodo').val(),
                cantidad_de_articulos = parseInt($(form).find('#cantidad_de_articulos').val()),
                cantidad_de_articulos_a_entregar = 0,
                cantidad_invalida = false;


            $(form).find('.cantidad-de-articulos-a-entregar').each(function () {
                var valor = parseInt($(this).val());
                if (valor > 0) {
                    cantidad_de_articulos_a_entregar += valor;
                } else {
                    cantidad_invalida = true;
                }
            });

            if (!cantidad_invalida && cantidad_de_articulos_a_entregar < cantidad_de_articulos) {
                //Se agrega un nuevo periodo parcial de entrega
                drawPeriodoParcialDeEntrega(form);
                PeriodoParcialDeEntregasDelete.init();
                setDatepicker.init();
            } else if (cantidad_de_articulos_a_entregar === cantidad_de_articulos) {
                //MOSTRAR QUE ES EL LIMITE
                throwError('Alcanzo el limite de cantidad a entregar');
            } else if (cantidad_de_articulos_a_entregar > cantidad_de_articulos || cantidad_de_articulos_a_entregar <= 0) {
                //MOSTRAR QUE LA CANTIDAD ES INVALIDA Y VACIAR LA CAJA
                throwError('Cantidad Invalida, la cantidad no puede ser menor a 0 y no debe exceder de ' + cantidad_de_articulos);
            }
        });
    };
    return {
        // public functions
        init: function () {
            demo1();
        }
    };
}();

function getFormModal(element_id, contrato_id,callbackContratosClick) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.ajax({
        url: url + '/contratos/showCreateContratoArtmed/' + element_id + '/' + contrato_id,
        success: function (result) {
            var modal = result;
            $(modal).modal().on('shown.bs.modal', function () {
                PeriodoParcialDeEntregasDelete.init();
                PeriodoParcialDeEntregas.init();
                setDatepicker.init();
                getFormsArtmed.init(callbackContratosClick);
            });
        },
        error: function (err) {
            handlErrors(err);
        }
    });
}

function agregarClave(){
    //Devuelve el elemento Artmed
    getSearchModal(function (element) {
        var contrato_id = $("#hashid-contrato").val();
        //Devolver campos
        getFormModal(element.id, contrato_id,function (obj) {
            throwSuccess(obj.mensaje,'/contratos/showContratoArticulos/' + contrato_id);
            console.log('ver', obj.ver);
        });
    });//end::getSearchModal
}


//BOTON ELIMINAR ARTICULO
$(".art-delete").on('click', function (e) {
    e.preventDefault();
    var element_id = $(this).data('delete'),
    contrato_id = $("#hashid-contrato").val();
    swal.fire({
        title: '¿Estas seguro?',
        text: "Se eliminará el artículo de esta contrato",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#235B4E',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar',
        reverseButtons: true,
        allowOutsideClick: () => !swal.isLoading()
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

            $.ajax({
                cache: false,
                url: url + '/contratos/destroyContratoArticulo',
                method: "post",
                data: {
                    element_id: element_id,
                    contrato_id: contrato_id,
                },
                beforeSend: function () {
                },
                success: function (result) {
                    throwSuccess(result.mensaje, '/contratos/showContratoArticulos/' + contrato_id);
                },
                error: function (err) {
                    handlErrors(err);
                }
            });
            /* Borra el html de un registro de articulo
            var clave = $(this).parent().parent().find('td.clave-articulo');
            $("#pariodo_parcial_entregas").find('td.clave-articulo-periodo').each(function () {
                if ($(this).html() === clave.html()) {
                    $(this).parent().parent().parent().parent().remove();
                }
            });
            $(this).parent().parent().remove();
             */
        }
    });
});
//BOTON AGREGAR ARTICULO
$("#btn-modal-search-artmed2").on('click', function (e) {
    e.preventDefault();
    agregarClave();
});

//BOTON VER DETALLES DEL ARTICULO
$(".btn-show-contrato").on('click', function (e) {
    e.preventDefault();
    var element_id = $(this).data('show'),
        contrato_id = $("#hashid-contrato").val();
    var id = $(this).data('show');
    $.ajax({
        url: url + "/contratos/showContratoArtmed/" + element_id + '/' + contrato_id,
        success: function (result) {
            var modal = result;
            $(modal).modal('show');
        },
        error: function (err) {
            handlErrors(err);
        }
    });
});

//BOTON EDITAR ARTICULO
$(".btn-edit-contrato").on('click', function (e) {
    e.preventDefault();
    var element_id = $(this).data('edit'),
        contrato_id = $("#hashid-contrato").val();

    getFormModal(element_id, contrato_id, function (obj) {
        throwSuccess(obj.mensaje,'/contratos/showContratoArticulos/' + contrato_id);
    });
});
