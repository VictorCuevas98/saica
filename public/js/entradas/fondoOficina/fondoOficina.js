
"use strict";


var KTDatatablesSearchOptionsAdvancedSearch = function() {

    

    var initTable1 = function() {
        // begin first table
        var table = $('#kt_datatable').DataTable({
            responsive: true,
            // Pagination settings
            dom: `<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
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
                url: url + '/fondoOficinas/advanceSearch',
                //url: 'https://preview.keenthemes.com/metronic/theme/html/tools/preview/api//datatables/demos/server.php',
                type: 'POST',
                data: {
                    // parameters for custom backend script demo
                    columnsDef: [
                        'id',
                        'folio_adquisicion', 
                        'proveedor',
                        'estatus', 
                        'num_contrato', 
                        'num_oficio_adjudicacion', 
                        'num_requisicion', 
                        'creado_por', 
                        'creado_el',
                        'acciones'
                        ],
                },
            },
            columns: [
                {data: 'id', visible:false},
                {data: 'folio_adquisicion'},
                {data: 'proveedor',orderable: false,},
                {data: 'estatus',orderable: false,},
                {data: 'num_contrato',orderable: false,},
                {data: 'num_oficio_adjudicacion',orderable: false,},
                {data: 'num_requisicion',orderable: false,},
                {data: 'creado_por',orderable: false,},
                {data: 'creado_el',orderable: false,},
                {data: 'acciones', responsivePriority: -1},
            ],

            initComplete: function() {
                this.api().columns().every(function() {
                    var column = this;
                    switch (column.header().textContent) {
                        /*
                        case 'Country':
                            column.data().unique().sort().each(function(d, j) {
                                $('.datatable-input[data-col-index="2"]').append('<option value="' + d + '">' + d + '</option>');
                            });
                            break;

                        case 'Estatus':
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

                        case 'Tipo':
                            var status = {
                                1: {'title': 'Factura', 'state': 'info'},
                                2: {'title': 'Remisión', 'state': 'primary'},
                            };
                            column.data().unique().sort().each(function(d, j) {
                                $('.datatable-input[data-col-index="7"]').append('<option value="' + d + '">' + status[d].title + '</option>');
                            });
                            break;
                            */
                    }
                });
            },

            columnDefs: [
                {
                    targets: -1,
                    title: 'acciones',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        /*
                        <a href="'+url+ '/fondoOficinas/'+full.id+'" class="btn btn-sm btn-clean btn-icon" title="Detalles">\
                                <i class="fas fa-arrow-right"></i>\
                            </a>\
                        */

                        return '\
                            <a href="'+url+ '/fondoOficinas/'+full.id+'/edit" class="btn btn-sm btn-clean btn-icon" title="seguimiento">\
                                <i class="fas fa-folder-open"></i>\
                            </a>\
                        ';
                    },
                },
                {
                    targets: 0,
                    title: 'id',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 1,
                    title: 'Carpeta',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return data;
                    },
                },
                {
                    targets: 3,
                    title: 'Estatus',
                    render: function(data, type, full, meta) {
                        var status = {
                            1: {'title': 'ACTIVA', 'class': ' label-light-success'},
                            2: {'title': 'CANCELADA', 'class': ' label-light-danger'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                    },
                },
                /*{
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
                */
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

    };

    return {

        //main function to initiate the module
        init: function() {
            initTable1();
        },

    };

}();

jQuery(document).ready(function() {
    KTDatatablesSearchOptionsAdvancedSearch.init();
});





console.log("fondoOficina.js Loaded");

