var _almacenQuery;
var _contratoQuery;
var _fecha_solicitudQuery;
var _fecha_entregaQuery;
var _folioQuery;

const resetFilters = () => {
    if (_almacenQuery != null || _contratoQuery != null || _fecha_solicitudQuery != null || _fecha_entregaQuery != null || _folioQuery != null) {
        var onlyUrl = window.location.href.replace(window.location.search, "");
        window.location.replace(onlyUrl);
    }
};

document.addEventListener("DOMContentLoaded", function(event) {
    // Dom is loaded & ready
    const params = new URLSearchParams(window.location.search);
    _almacenQuery = params.get("almacen");
    _contratoQuery = params.get("contrato");
    _fecha_solicitudQuery = params.get("fecha_solicitud");
    _fecha_entregaQuery = params.get('fecha_entrega');
    _folioQuery = params.get('folio_pedido');
    document.getElementById("almacen").value =
        _almacenQuery == null ? "" : _almacenQuery;
    document.getElementById("contrato").value =
        _contratoQuery == null ? "" : _contratoQuery;
    document.getElementById("fecha_solicitud").value =
        _fecha_solicitudQuery == null ? "" : _fecha_solicitudQuery;
    document.getElementById("fecha_entrega").value =
    _fecha_solicitudQuery == null ? "" : _fecha_entregaQuery;
    document.getElementById("folio_pedido").value =
    _fecha_solicitudQuery == null ? "" : _folioQuery;
});
/*
"use strict";

var Table = function() {
    var pedidos_table = function() {
        var datatable = $('#pedidos_table').KTDatatable({
            //language definition
            translate: {
                records: {
                    processing: 'Cargando...',
                    noRecords: 'No se encontraron registros',
                },
                toolbar: {
                    pagination: {
                        items: {
                            default: {
                                first: 'Primero',
                                prev: 'Anterior',
                                next: 'Siguiente',
                                last: 'Último',
                                more: 'Más páginas',
                                input: 'Número de página',
                                select: 'Seleccionar tamaño de página',
                            },
                            info: 'Mostrando {{start}} - {{end}} de {{total}} registros',
                        },
                    },
                },
            },
            //datasource definition
            data: {
                type: 'local',
                source: pedidos
                //pageSize: 10,
            },
            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },
            // column sorting
            sortable: true,
            pagination: true,
            search: {
                input: $('#kt_datatable_search_query'),
                key: 'generalSearch'
            },
            // columns definition
            columns: [ {
                field: 'num_contrato',
                title: 'Contrato',
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
                    return row.contrato.num_contrato
                },
            },{
                field: 'folio_pedido',
                title: 'Folio',
                autoHide: false,
                template: function(row) {
                    return row.pedido.folio_pedido
                },
            }, {
                field: 'fecha_pedido',
                title: 'Fecha Pedido',
                autoHide: false,
                overflow: 'visible',
                template: function(row) {
                    return row.pedido.fecha_pedido
                }
            },{
                field: 'almacen',
                title: 'Almacen',
                overflow: 'visible',
                autoHide: false,
                template: function(row) {
                    console.log(row);
                    return row.almacen.almacen;
                }
            },{
                field: 'razon_social',
                title: 'Proveedor',
                overflow: 'visible',
                autoHide: false,
                template: function(row) {
                    console.log(row);
                    return row.proveedor.razon_social;
                }
            },  {
                field: '',
                title: 'Acciones',
                sortable: false,
                textAlign: 'center',
                autoHide: false,
                overflow: 'visible',
                //width: 10,
                template: function(row) {
                    return '<a href="'+url+'/pedidos-proveedor/'+ row.pedido.id+'/articles-edit" class="btn btn-icon btn-primary" title="Detalle">\
                    <i class="far fa-eye"></i></a>';
                    return '\
                        <div class="dropdown dropdown-inline">\
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2" data-toggle="dropdown">\
                                <span class="svg-icon svg-icon-md">\
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                                            <rect x="0" y="0" width="24" height="24"/>\
                                            <path d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z" fill="#000000"/>\
                                        </g>\
                                    </svg>\
                                </span>\
                            </a>\
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
                                <ul class="navi flex-column navi-hover py-2">\
                                    <li class="navi-header font-weight-bolder text-uppercase font-size-xs text-primary pb-2">\
                                        Escoge una accion:\
                                    </li>\
                                    <li class="navi-item">\
                                        <a onclick="onViewDetailsClick(\''+row.contrato.num_contrato+'\')" href="javascript:void(0);" class="navi-link">\
                                            <span class="navi-icon"><i class="la la-print"></i></span>\
                                            <span class="navi-text">Validar</span>\
                                        </a>\
                                    </li>\
                                </ul>\
                            </div>\
                        </div>\
                    ';
                },
            }],

        });

       
    };

    return {
        init: function() {
            pedidos_table();
        }
    };
}();

jQuery(document).ready(function() {
    Table.init();
});
*/
