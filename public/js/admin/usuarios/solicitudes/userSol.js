var url = $('#url').val();

function tablaSol(){
    var dataTableubicacion = $('#datatableSolicitudes').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 5,
        language: {
            "url": url + "/js/dataTable/Spanish.json"
        },
        ajax: {
            "url": url + "/admin/usuarios/usuarioSolicitudes",
            "type": "GET"
        },
        
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    
                    
                    return '<a href="'+ url +'/admin/usuarios/solicitudes/'+ row.id +'" class="btn btn-sm btn-clean btn-icon" title="visualizar">'+
                                    '<i class="far fa-eye"></i>'+
                                '</a>';
                },
                "targets": 3
            },
            {
                "render": function ( data, type, row ) {
                    var status;
                        if(row.status_persona_id == 'P'){
                            status = 'PENDIENTE';
                        }else if(row.status_persona_id == 'A'){
                            status = 'ACTIVO';
                        }else if(row.status_persona_id == 'C'){
                            status = 'CANCELADO';
                        }else if(row.status_persona_id == 'R'){
                            status = 'EN REVISIÓN'
                        }

                        return status;
                },
                "targets": 2
            },
            {
                "render": function ( data, type, row ) {
                    return row.nombre;
                },
                "targets": 1
            },
            {
                "render": function ( data, type, row ) {
                    return row.created_at;
                },
                "targets": 0,
                "name": "created_at"
            },

        ],
    });
}