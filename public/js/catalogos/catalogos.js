var url = $('#url').val();
//var url = window.location;
//Catálogo Artmed
/*function tablaArticulo(){
    var dataTableArticulo = $('#tablaCatalogoArticulos').dataTable({
        searchDelay: 500,
        processing: true,
        serverSide: true,
        pageLength: 5,  
        language: {
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
            "url": url + '/catalogoArticulos',
            "type": "GET"
        },
        columns: [
            { data: 'clave_artmed', name: 'clave_artmed' },
            { data: 'artmed', name: 'artmed' },
            { data: 'clave_cabms', name: 'clave_cabms' },
            { data: 'clave_partida', name: 'clave_partida' },
            { data: 'partida', name: 'partida' },
            { data: 'unidad_medida', name: 'unidad_medida' },
            
            {   
                "mRender": function ( data, type, row ) {
                    return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
                }
            },
            {
                "mRender": function (data, type, row) {
                    var id_clave = "'"+row.id+"'";
                    return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_articulo_modal('+id_clave+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
                }
            }
        ]
    });
}*/


function add_articulo_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/crearArticulo",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_add_articulo")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}


function save_articulo_create() {
    var form = $("#frm_nuevo_articulo");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarArticulo",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_articulo').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            location.reload();
                            //$('#tablaCatalogoArticulos').DataTable().ajax.reload();
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

function edit_articulo_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/editarArticulo",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_articulo")});
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

function save_articulo_update() {
    var form = $("#frm_editar_articulo");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarEdicionArticulo",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_articulo').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            location.reload();
                            //$('#tablaCatalogoArticulos').DataTable().ajax.reload();
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
            clave_artmed: {
                required: true,
                maxlength: 150
            },
            artmed: {
                required: true,
                maxlength: 150
            },
            unidad_medida: {
                required: true,
                maxlength: 150
            },
            cabms: "required",
        },
        messages: {
            required: "El campo es requerido",
            clave_artmed: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            artmed: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            unidad_medida: {
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



//Catálogo CABMS
function tablaCabms(){
    var dataTableCabms = $('#tablaCatalogoCabms').dataTable({
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
            "url": url + "/catalogoCabms",
            "type": "GET"
        },
        columns: [
            { data: 'clave_cabms', name: 'clave_cabms' },
            { data: 'cabms', name: 'cabms' },
            { data: 'clave_partida', name: 'clave_partida' },
            { data: 'partida', name: 'partida' },
            { data: 'unidad_medida', name: 'unidad_medida' },
            {   
                "mRender": function ( data, type, row ) {
                    return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
                }
            },
            {
                "mRender": function (data, type, row) {
                    var id_cabms = "'"+row.id+"'";
                    return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_cabms_modal('+id_cabms+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
                }
            }
        ]
    });
}

function add_cabms_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/crearCabms",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_add_cabms")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_cabms_create() {
    var form = $("#frm_nuevo_cabms");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarCabms",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_cabms').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            $('#tablaCatalogoCabms').DataTable().ajax.reload();
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

function edit_cabms_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/editarCabms",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_cabms")});
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

function save_cabms_update() {
    var form = $("#frm_editar_cabms");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarEdicionCabms",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_cabms').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            $('#tablaCatalogoCabms').DataTable().ajax.reload();
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
            clave_cabms: {
                required: true,
                maxlength: 150
            },
            cabms: {
                required: true,
                maxlength: 150
            },
            unidad_medida: {
                required: true,
                maxlength: 150
            },
            //partida: "required",
        },
        messages: {
            required: "El campo es requerido",
            clave_cabms: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            cabms: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            unidad_medida: {
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


//Catálogo partidas
function tablaPartidas(){
    var dataTablePartidas = $('#tablaCatalogoPartidasCabms').dataTable({
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
            "url": url + "/catalogoPartidas",
            "type": "GET"
        },
        columns: [
            { data: 'clave_partida', name: 'clave_partida' },
            { data: 'partida', name: 'partida' },
            { data: 'clave_elemento_cog', name: 'clave_elemento_cog' },
            { data: 'elemento_cog', name: 'elemento_cog' },
            {   
                "mRender": function ( data, type, row ) {
                    return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
                }
            },
            {
                "mRender": function (data, type, row) {
                    var id_partida = "'"+row.id+"'";
                    return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_partida_modal('+id_partida+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
                }
            }
        ]
    });
}   


function add_partidas_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/crearPartida",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_add_partidas")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_partidas_create() {
    var form = $("#frm_nuevo_partidas");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarPartida",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_partidas').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            $('#tablaCatalogoPartidasCabms').DataTable().ajax.reload();
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

function edit_partida_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/editarPartida",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_partida")});
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

function save_partida_update() {
    var form = $("#frm_editar_partida");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarEdicionPartida",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_partida').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            $('#tablaCatalogoPartidasCabms').DataTable().ajax.reload();
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
            clave_partida: {
                required: true,
                maxlength: 150
            },
            partida: {
                required: true,
                maxlength: 150
            },
            elemento: "required",
        },
        messages: {
            required: "El campo es requerido",
            clave_partida: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            partida: {
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

//Catálogo Laboratorios
function tablaLaboratorio(){
    var dataTableLaboratorio = $('#tablaCatalogoLaboratorios').dataTable({
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
            "url": url + "/catalogoLaboratorios",
            "type": "GET"
        },
        columns: [
            { data: 'clave_laboratorio', name: 'clave_laboratorio' },
            { data: 'laboratorio', name: 'laboratorio' },
                   
            {   
                "mRender": function ( data, type, row ) {
                    return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
                }
            },
            {
                "mRender": function (data, type, row) {
                    var id_laboratorio = "'"+row.id+"'";
                    return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_laboratorio_modal('+id_laboratorio+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
                }
            }
        ]
    });
}

function add_laboratorio_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/crearLaboratorio",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_add_laboratorio")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_laboratorio_create() {
    var form = $("#frm_nuevo_laboratorio");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarLaboratorio",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_laboratorio').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            $('#tablaCatalogoLaboratorios').DataTable().ajax.reload();
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

function edit_laboratorio_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/editarLaboratorio",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_laboratorio")});
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

function save_laboratorio_update() {
    var form = $("#frm_editar_laboratorio");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarEdicionLaboratorio",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_laboratorio').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            $('#tablaCatalogoLaboratorios').DataTable().ajax.reload();
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
            clave_laboratorio: {
                required: true,
                maxlength: 150
            },
            laboratorio: {
                required: true,
                maxlength: 150
            },
        },
        messages: {
            required: "El campo es requerido",
            clave_laboratorio: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            laboratorio: {
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

//Catálogo Almacenes
function tablaAlmacen(){
    var dataTableAlmacen = $('#tablaCatalogoAlmacenes').dataTable({
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
            "url": url + "/catalogoAlmacenes",
            "type": "GET"
        },
        columns: [
            { data: 'clave_almacen', name: 'clave_almacen' },
            { data: 'almacen', name: 'almacen' },
            { data: 'domi_calle', name: 'domi_calle' },
            { data: 'domi_num_ext', name: 'domi_num_ext' },
            { data: 'domi_num_int', name: 'domi_num_int' },
            { data: 'asentamiento', name: 'asentamiento' },
                   
            {   
                "mRender": function ( data, type, row ) {
                    return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
                }
            },
            {
                "mRender": function (data, type, row) {
                    var id_almacen = "'"+row.id+"'";
                    return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_almacen_modal('+id_almacen+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
                }
            }
        ]
    });
}

function add_almacen_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/crearAlmacen",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_add_almacen")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_almacen_create() {
    var form = $("#frm_nuevo_almacen");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarAlmacen",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_almacen').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            $('#tablaCatalogoAlmacenes').DataTable().ajax.reload();
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

function edit_almacen_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/editarAlmacen",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_almacen")});
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

function save_almacen_update() {
    var form = $("#frm_editar_almacen");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarEdicionAlmacen",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_almacen').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            $('#tablaCatalogoAlmacenes').DataTable().ajax.reload();
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

function buscarColoniaEditar(){
  if($('#cp').val()!=""){
    $('#alerta').hide();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/buscarColoniaEditar",
        dataType: 'json',
        data: $('#frm_editar_almacen').serialize(),     
        success: function(respuesta){
          if(respuesta.codigo != 200){
            $('#mensaje').html(respuesta.msg);
            $('#alerta').show();
            
          }else{
            
            var asentamientos = respuesta.msg[0].asentamientos;

            $('#asentamiento').empty();
                        
            asentamientos.forEach(element => $('#asentamiento').append('<option value='+element.id+'>'+
                    element.asentamiento + 
                '</option>'));

             }
        },
        error: function(respuesta){
            swal.fire('¡Mensaje!','Ocurrio un error','error');     
        }
    });
  }else{
    $('#mensaje').html('Olvido ingresar un C.P.');
    $('#alerta').show();
    
  }
}

function validar(form){
    var form = form;
    var validator = form.validate({
        rules: {
            clave_almacen: {
                required: true,
                maxlength: 150
            },
            almacen: {
                required: true,
                maxlength: 150
            },
            domi_calle: {
                required: true,
                maxlength: 150
            },
            asentamiento: {
                required: true,
                maxlength: 150
            },
        },
        messages: {
            required: "El campo es requerido",
            clave_almacen: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            almacen: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            domi_calle: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            asentamiento: {
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

//Catálogo Preguntas revision entradas
function tablaPreguntasRevision(){
    var dataTablePreguntasRevision = $('#tablaCatalogoPreguntasRevision').dataTable({
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
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/catalogoPreguntasRevision",
            "type": "GET",
        },
        columns: [
            { data: 'clave_pregunta', name: 'clave_pregunta' },
            { data: 'pregunta', name: 'pregunta' },
            //{ data: 'orden', name: 'orden' },
            { data: 'tipo_revision', name: 'tipo_revision' },
                   
            {   
                "mRender": function ( data, type, row ) {
                    return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
                }
            },
            {
                "mRender": function (data, type, row) {
                    var id_pregunta = "'"+row.id+"'";
                    return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_pregunta_modal('+id_pregunta+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
                }
            }
        ]
    });
}

function add_pregunta_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/crearPreguntasRevision",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_add_pregunta")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_pregunta_create() {
    var form = $("#frm_nuevo_pregunta");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarPreguntasRevision",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_pregunta').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            $('#tablaCatalogoPreguntasRevision').DataTable().ajax.reload();
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

function edit_pregunta_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/editarPreguntasRevision",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_pregunta")});
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

function save_pregunta_update() {
    var form = $("#frm_editar_pregunta");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarEdicionPreguntasRevision",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_pregunta').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            $('#tablaCatalogoPreguntasRevision').DataTable().ajax.reload();
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
            clave_pregunta: {
                required: true,
                maxlength: 150
            },
            pregunta: {
                required: true,
                maxlength: 150
            },
            tipo_revision: {
                required: true,
                maxlength: 150
            },
        },
        messages: {
            required: "El campo es requerido",
            clave_pregunta: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            pregunta: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            tipo_revision: {
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

//Catálogo Unidad consolidadora
function tablaUnidadConsolidadora(){
    var dataTableUnidadConsolidadora = $('#tablaCatalogoUnidadConsolidadora').dataTable({
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
            "url": url + "/catalogoUnidadConsolidadora",
            "type": "GET"
        },
        columns: [
            { data: 'clave_unidad_consolidadora', name: 'clave_unidad_consolidadora' },
            { data: 'unidad_consolidadora', name: 'unidad_consolidadora' },
            { data: 'orden_gobierno', name: 'orden_gobierno' },
            
            {   
                "mRender": function ( data, type, row ) {
                    return '<span class="badge badge-'+ (row.activo != 0 ? 'success' : 'danger') +' badge-inline">'+ (row.activo != 0 ? 'Activo' : 'Inactivo') +'</span>';
                }
            },
            {
                "mRender": function (data, type, row) {
                    var id_unidad = "'"+row.id+"'";
                    return '<a class="btn btn-clean btn-icon" title="Editar" onClick="edit_unidad_modal('+id_unidad+');" href="javascript:void(0)"><i class="far fa-edit"></i></a>';
                }
            }
        ]
    });
}

function add_unidad_modal() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/crearUnidadConsolidadora",
        dataType: 'html',
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_add_unidad")});
            }).on('hidden.bs.modal', function() {
                $(this).remove();
            });
        },
        error: function(respuesta) {
            swal.fire('¡Alerta!','Error de conectividad de red USR-01','warning');
        }
    });
}

function save_unidad_create() {
    var form = $("#frm_nuevo_unidad");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarUnidadConsolidadora",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_add_unidad').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "Se creo correctamente","success");
                            $('#tablaCatalogoUnidadConsolidadora').DataTable().ajax.reload();
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

function edit_unidad_modal(id) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/editarUnidadConsolidadora",
        dataType: 'html',
        data:{
            id:id
        },
        success: function(resp_success) {
            var modal = resp_success;
            $(modal).modal().on('shown.bs.modal', function() {
                $('.select2').select2({dropdownParent: $("#mod_edit_unidad")});
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

function save_unidad_update() {
    var form = $("#frm_editar_unidad");
    //Validamos formulario
    var result = validar(form);

    if(result){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            "url": url + "/guardarEdicionUnidadConsolidadora",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(respuesta) {
                if(respuesta.status){
                    if(respuesta.status == 'valido'){
                        $('#mod_edit_unidad').modal('hide').on('hidden.bs.modal', function() {
                            swal.fire("Proceso  correcto!", "El registro se editó correctamente","success");
                            $('#tablaCatalogoUnidadConsolidadora').DataTable().ajax.reload();
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
            clave_unidad_consolidadora: {
                required: true,
                maxlength: 150
            },
            unidad_consolidadora: {
                required: true,
                maxlength: 150
            },
            orden_gobierno: {
                required: true
            },
        },
        messages: {
            required: "El campo es requerido",
            clave_unidad_consolidadora: {
                maxlength: "El nombre debe tener un máximo de 150 caracteres"
            },
            unidad_consolidadora: {
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