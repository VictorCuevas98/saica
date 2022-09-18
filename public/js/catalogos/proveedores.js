var url = window.location;
//Catálogo Proveedores
var dataTableProveedores = $('#tablaCatalogoProveedores').dataTable({
    searchDelay: 500,
    processing: true,
    serverSide: true,
    pageLength: 5,
    language: {
        "url": url + "/js/dataTable/Spanish.json",
        "decimal": "",
        "emptyTable": "No hay datos disponibles en la tabla",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
        "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
        "infoFiltered": "(filtrado de _MAX_ registros totales)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ registros",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "No se encontraron registros que coinsidan",
        "paginate": {
            "first": "Primer",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": activar para ordenar la columna ascendente",
            "sortDescending": ": activar para ordenar la columna descendente"
        }

    },
    ajax: {
        "url": url + "/catalogoProveedores",
        "type": "GET"
    },
    columns: [
        { data: 'rfc', name: 'rfc' },
        { data: 'tipo_persona', name: 'tipo_persona' },
        { data: 'fisica_nombre', name: 'fisica_nombre' },
        { data: 'fisica_primer_ap', name: 'fisica_primer_ap' },
        { data: 'fisica_segundo_ap', name: 'fisica_segundo_ap' },
        { data: 'razon_social', name: 'razon_social' },
        { data: 'representante_legal', name: 'representante_legal' },
       
        {   
            "mRender": function ( data, type, row ) {
                return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
            }
        },
        {
            "mRender": function (data, type, row) {
                var id_proveedor = "'"+row.id+"'";
                return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_proveedor_modal('+id_proveedor+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
            }
        }
    ]
});

function add_proveedor_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/proveedores/crearProveedor",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_add_proveedor")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_proveedor_create() {
    var form = $("#frm_nuevo_proveedor");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/proveedores/guardarProveedor",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_proveedor').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            $('#tablaCatalogoProveedores').DataTable().ajax.reload();
                        });
                    }else if(respuesta.status == 'no_valido'){
                        swal.fire('¡Alerta!', respuesta.data+' Codigo: '+respuesta.code, 'warning');
                    }else{
                        swal.fire('¡Alerta!', 'Error de conectividad de red USR-02.', 'warning');
                    }
                }else{
                    swal.fire('¡Alerta!', 'Error de conectividad de red USR-02.', 'warning');
                }
            },
            
        });
    }
}

function edit_proveedor_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/proveedores/editarProveedor",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_proveedor")});
                $("[class='make-switch']").bootstrapSwitch('animate', true);
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_proveedor_update() {
    var form = $("#frm_editar_proveedor");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/proveedores/guardarEdicionProveedor",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_proveedor').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            $('#tablaCatalogoProveedores').DataTable().ajax.reload();
                        });
                    }else if(respuesta.status == 'no_valido'){
                        swal.fire('¡Alerta!', respuesta.data+' Codigo: '+respuesta.code, 'warning');
                    }else{
                        swal.fire('¡Alerta!', 'Error de conectividad de red USR-02.', 'warning');
                    }
                }else{
                    swal.fire('¡Alerta!', 'Error de conectividad de red USR-02.', 'warning');
                }
            },
        });
    }
}


function validar(form){
    var form = form;
    var validator = form.validate({
        rules: {
            rfc: {
                required: true,
                maxlength: 14
            },
            tipo_persona: {
                required: true
            },
            fisica_nombre: {
                required: true,
                maxlength: 15
            },
            fisica_primer_ap: {
                required: true,
                maxlength: 15
            },
            fisica_segundo_ap: {
                required: true,
                maxlength: 15
            },
            razon_social: {
                required: true,
                maxlength: 150
            },
            representante_legal: {
                required: true,
                maxlength: 150
            },
        },
        messages: {
            required: "El campo es requerido",
            rfc: {
                maxlength: "El nombre debe tener un máximo de 14 caracteres"
            },
            fisica_nombre: {
                maxlength: "El nombre debe tener un máximo de 15 caracteres"
            },
            fisica_primer_ap: {
                maxlength: "El nombre debe tener un máximo de 15 caracteres"
            },
            fisica_segundo_ap: {
                maxlength: "El nombre debe tener un máximo de 15 caracteres"
            },
            razon_social: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            representante_legal: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            }
        },
        highlight: function(element) {
            $(element).addClass('errorInput');
        },
        unhighlight: function (element) {
            $(element).removeClass('errorInput');
        }
    });

    var result = validator.form();

    return result;
}