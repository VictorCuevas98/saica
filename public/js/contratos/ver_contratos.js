"use strict";
// Class definition

var KTSelect2 = function () {
    // Private functions
    var demos = function () {
        $('.proveedor_select').select2({
            placeholder: "seleccione proveedor"
        });

        $('.sitio_select').select2({
            placeholder: "seleccione sitio"
        });

        $('.tipomovimiento_select').select2({
            placeholder: "seleccione tipo de movimiento",
        });

        $('.flegal_select').select2({
            placeholder: "seleccione fundamento legal",
        });

        $('.orecursos_select').select2({
            placeholder: "seleccione origen del recurso"
        });
    }

    // Public functions
    return {
        init: function () {
            demos();
        }
    };
}();

var KTDatatableOptionsAdvancedSearch = function () {
    var initTable1 = function () {
        var table = $('#tablaContratos').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html
            lengthMenu: [5, 10, 25, 50],
            pageLength: 5,
            language: {
                "decimal":        "",
                "emptyTable":     "No hay datos disponibles en la tabla",
                "info":           "Monstranto registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty":      "Mostrando registros del 0 al 0 de 0 registros",
                "infoFiltered":   "(Filtrado por _MAX_ registros totales)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar\&nbsp; _MENU_ \&nbsp;registros",
                "loadingRecords": "Cargando...",
                "processing":     "Cargando...",
                "search":         "Buscar:",
                "zeroRecords":    "No se encontraron registros que coinsidan",
                "paginate": {
                    "first":      "<<",
                    "last":       ">>",
                    "next":       ">",
                    "previous":   "<"
                },
                "aria": {
                    "sortAscending":  ": activa para ordenar la columna ascendentemente",
                    "sortDescending": ": activa para ordenar la columna descendentemente"
                }
            },
            searchDelay: 500,
        });

        $('#kt_search_contratos').on('click', function(e) {
            console.log("buscando");
            e.preventDefault();
            var params = {};
            var show=0;
            $('.datatable-input').each(function() {
                var i = $(this).data('col-index');
                if (params[i]) {
                    params[i] += '|' + $(this).val();
                }
                else {
                    params[i] = $(this).val();
                }
            });
            $.each(params, function(i, val) {
                if (val === '' || val === null){
                    show++;
                }
                // apply search params to datatable
                table.column(i).search(val ? val : '', false, false);
                console.log('i, val' + i +' '+ val);
            });
            console.log('params', params);
            if (show<6){
                $("#tablaContratos_wrapper").show();
                $("#tablaContratos").show();
                table.table().draw();
            }else {
                $("#tablaContratos_wrapper").hide();
                $("#tablaContratos").hide();
            }
        });

        $('#kt_reset_contratos').on('click', function(e) {
            e.preventDefault();
            $('.datatable-input').each(function() {
                $(this).val('');
                table.column($(this).data('col-index')).search('', false, false);
            });
            //table.table().draw();
        });
    };

    return {
        init: function () {
            initTable1();
            $("#tablaContratos_wrapper").hide();
        },
    };
}();

var KTBootstrapDatepicker2 = function () {

    // Private functions
    var demos2 = function () {
        $('#buscar-fecha-contrato').datepicker({
            language: 'es',
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            templates: {
                leftArrow: '<i class="ki ki-arrow-back"></i>',
                rightArrow: '<i class="ki ki-arrow-next"></i>'
            }
        });
        // range picker
        $('#editar_fecha_contrato').datepicker({
            language: 'es',
            rtl: KTUtil.isRTL(),
            orientation: "bottom left",
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="ki ki-arrow-back"></i>',
                rightArrow: '<i class="ki ki-arrow-next"></i>'
            }
        });
    }

    return {
        // public functions
        init: function () {
            demos2();
        }
    };
}();

// Inicializacion

jQuery(document).ready(function () {
    KTSelect2.init();
    KTDatatableOptionsAdvancedSearch.init();
    KTBootstrapDatepicker2.init();
});

//Boton para eliminar contrato
$('.btn-eliminar-contrato').on('click',function (e) {
    e.preventDefault();
    var content = $(this).attr('data-content-del');
    swal.fire({
        title: '¿Estas seguro?',
        text: "No serás capaz de revertir los cambios!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#235B4E',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar!',
        reverseButtons: true,
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                cache: false,
                url: url + "/contratos/destroy",
                method: "POST",
                data:{id:content},
                beforeSend: function () {
                },
                success: function (result) {
                    throwSuccess(result.mensaje,'/contratos');
                },
                error: function (err) {
                    handlErrors(err);
                }
            });

        }
    });
});


//Boton para ver detalles
$(".btn-editar-contrato").on('click', function () {
    var id = $(this).attr('data-content-edit');
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: url+"/contratos/getModalEdit",
        method: 'post',
        data: {id:id},
        success: function(result) {
            $("#editarContratoModal").modal('show');
        },
        error: function(err) {
            handlErrors(err);
        }
    });
});

//Boton para ver dar seguimiento
$(".btn-seguimiento-contrato").on('click', function () {
    var id = $(this).data('seguimiento');
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: url + '/contratos/showContratoArticulos/'+id,
        method: 'get',
        cache: false,
        success: function(result) {
            $(location).attr('href',url + '/contratos/showContratoArticulos/'+id);
        },
        error: function(err) {
            handlErrors(err);
        }
    });
});
console.log('ver_contratos.js loaded');
