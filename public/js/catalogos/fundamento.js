var url = $('#url').val();
function tablaFundamento(){
    var dataTableFundamento = $('#tablaCatalogofundamentos').dataTable({
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
            "url": url + "/catalogofundamento",
            "type": "GET"
        },
        columns: [
            { data: 'clave_fundamento_legal', name: 'clave_fundamento_legal' },
            { data: 'fundamento_legal', name: 'fundamento_legal' },
                   
            {   
                "mRender": function ( data, type, row ) {
                    return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
                }
            },
            {
                "mRender": function (data, type, row) {
                    var id_fundamento = "'"+row.id+"'";
                    return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_fundamento_modal('+id_fundamento+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
                }
            }
        ]
    });
}

function add_fundamento_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/crearFundamentoLegal",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_fundamento_create() {
    var form = $("#frm_nuevo_fundamento");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarFundamentoLegal",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_fundamento').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            $('#tablaCatalogofundamentos').DataTable().ajax.reload();
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

function edit_fundamento_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/editarFundamentoLegal",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_fundamento")});
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

function save_fundamento_update(){
    var form = $("#frm_editar_fundamento");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarEdicionFundamentoLegal",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_fundamento').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            $('#tablaCatalogofundamentos').DataTable().ajax.reload();
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
            clave_fundamento_legal: {
                required: true,
                maxlength: 150
            },
            fundamento_legal: {
                required: true,
                maxlength: 150
            },
        },
        messages: {
            required: "El campo es requerido",
           clave_fundamento_legal: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            fundamento_legal: {
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
