"use strict";

function getSearchModal(callbackArtmedClick) {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: url+"/catArtmed/getSearchModal",
        type: 'POST',
        data: 'area=',
        dataType: "html",
        success: function(respuesta) {

            var modal = respuesta;
            $(modal).modal().on('shown.bs.modal', function() {
                //INICIALIZAR EL SEARCH Y TABLA
                KTDatatablesSearchOptionsAdvancedSearch.init(callbackArtmedClick);

            }).on('hidden.bs.modal', function (e) {
              // do something...>
              //table.destroy();
                $(this).data('bs.modal', null);
                $(this).remove();
            });

        },
        error: function() {
            swal.fire("Mensaje!", "Ocurrio un error, verificalo con el administrador!", "error");
            return false;
        }
    });
}//END::getSearchModal

function closeModal(){

    $('#exampleModalArtmedSearch').modal('hide');
}


var KTDatatablesSearchOptionsAdvancedSearch = function() {

    var initTable1 = function(callbackArtmedClick, partida) {

        if ( $.fn.DataTable.isDataTable('#kt_datatable_search_artmed') ) {
            $('#kt_datatable_search_artmed').DataTable().destroy();
        }
        // begin first table
        var table = $('#kt_datatable_search_artmed').DataTable({
            //destroy: true,
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>>
            <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            // read more: https://datatables.net/examples/basic_init/dom.html
            lengthMenu: [5, 10, 25, 50],
            pageLength: 5,
            language: {
                "url": url + "/js/dataTable/Spanish.json",
                'lengthMenu': 'Display _MENU_',
            },
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url + '/catArtmed/advanceSearch',
                //url: 'https://preview.keenthemes.com/metronic/theme/html/tools/preview/api//datatables/demos/server.php',
                type: 'POST',
                data: {
                    // parameters for custom backend script demo
                    columnsDef: [
                        'id', 'clave', 'descripcion', 'cabms', 'unidad_medida',
                        'revision', 'estatus','partida'],
                    partida: partida,
                },
            },
            columns: [
                {data: 'id',visible:false},
                {data: 'clave',name:'clave_artmed'},
                {data: 'descripcion',name:'artmed'},
                {data: 'cabms',name:'id_cabms',visible:false},
                {data: 'unidad_medida',name:'unidad_medida'},
                {data: 'revision',name:'revision',visible:false},
                {data: 'estatus',name:'activo'},
                {data: 'partida'},
                //{data: 'Acciones', responsivePriority: -1},
            ],

            initComplete: function() {
                console.log("initComplete");

                this.api().columns().every(function() {
                    var column = this;
                    /*
                    switch (column.header().textContent) {
                        case 'Country':
                            column.data().unique().sort().each(function(d, j) {
                                $('.datatable-input[data-col-index="2"]').append('<option value="' + d + '">' + d + '</option>');
                            });
                            break;

                        case 'estatus':
                            var status = {
                                1: {'title': 'Guardado', 'class': 'label-light-primary'},
                                2: {'title': 'Cancelado', 'class': ' label-light-danger'},
                                3: {'title': 'Completado', 'class': ' label-light-success'},
                                4: {'title': 'Pendiente', 'class': ' label-light-info'},
                            };
                            column.data().unique().sort().each(function(d, j) {
                                $('.datatable-input[data-col-index="6"]').append('<option value="' + d + '">' + status[d].title + '</option>');
                            });
                            break;

                        case 'Type':
                            var status = {
                                1: {'title': 'Factura', 'state': 'info'},
                                2: {'title': 'Remisión', 'state': 'primary'},
                            };
                            column.data().unique().sort().each(function(d, j) {
                                $('.datatable-input[data-col-index="7"]').append('<option value="' + d + '">' + status[d].title + '</option>');
                            });
                            break;
                    }*/
                });
            },

            columnDefs: [
                {
                    targets: -1,
                    title: 'Acciones',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return '\
                            <button data-artmed-obj=\'{\"id\":\"'+full.id+'\",\"clave\":\"'+full.clave+'\",\"artmed\":\"'+full.descripcion+'\",\"unidad_medida\":\"'+full.unidad_medida+'\"}\'  class="btn btn-sm btn-clean btn-icon btn-artmed-search-form-action" title="Usar">\
                                <i class="fas fa-arrow-right"></i>\
                            </button>\
                        ';
                    },
                },
                {
                    targets: 0,
                    title: 'Id',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 1,
                    title: 'Clave',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 2,
                    title: 'Articulo',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        //return data;
                        return '<p class="font-size-xs">' + data + '</p> ';
                    },
                },
                {
                    targets: 4,
                    title: 'Unidad Medida',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 5,
                    title: 'Revisión',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 6,
                    title: 'Estatus',
                    render: function(data, type, full, meta) {
                        var status = {

                            false: {'title': 'Cancelado', 'class': ' label-danger'},
                            true: {'title': 'Activo', 'class': ' label-success'},

                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    },
                },
                {
                    targets: 7,
                    title: 'Tipo',
                    render: function(data, type, full, meta) {
                        var status = {

                            1: {'title': 'Factura', 'state': 'primary'},
                            2: {'title': 'Remisión', 'state': 'success'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
                            '<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
                    },
                },
            ],
        });

        var filter = function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
        };

        var asdasd = function(value, index) {
            var val = $.fn.dataTable.util.escapeRegex(value);
            table.column(index).search(val ? val : '', false, true);
        };

        $('#kt_search').on('click', function(e) {
            console.log("buscando");
            e.preventDefault();
            var params = {};
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
                // apply search params to datatable
                table.column(i).search(val ? val : '', false, false);
            });
            table.table().draw();


        });

        $('#kt_reset').on('click', function(e) {
            e.preventDefault();
            $('.datatable-input').each(function() {
                $(this).val('');
                table.column($(this).data('col-index')).search('', false, false);
            });
            table.table().draw();
        });

        $('#kt_datepicker').datepicker({
            todayHighlight: true,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>',
            },
        });

        //AFTER DRAW TABLE., AFTER INIT TO.
        $('#kt_datatable_search_artmed').on( 'draw.dt', function () {
            console.log("draw table");

            $(".btn-artmed-search-form-action").on('click', function(e) {
                //console.log($(this).data('artmedId'));
                var obj = $(this).data('artmedObj');
                //var obj = jQuery.parseJSON($(this).data(obj));
                callbackArtmedClick(obj);
                closeModal();//CLOSE MODAL
                //console.log("seleccionado el articvulo especificado");
                //console.log("el id -> "+$(this).attr('data-artmed-id'));
            });

        });


    };

    return {

        //main function to initiate the module
        init: function(callbackArtmedClick, partida) {
            initTable1(callbackArtmedClick, partida);
        },

    };

}();






console.log("cat_artmed.js Loaded");
