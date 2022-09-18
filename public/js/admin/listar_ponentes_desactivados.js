$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});

var usuariosPonentesTables = $('#kt_datatable_actas_oci').DataTable({
    "language": {
        "url": "assets/vendors/general/datatables/Spanish.json"
    },
    "serverSide": true,
    responsive: true,
    "lengthMenu": [
        [5, 10, 50, -1],
        [5, 10, 50, "TODOS"]
    ],
    "info": false,
    "ajax": {
        "type": 'POST',
        "url": urlListarPonentes,
        "async": false,
        "data": { "tipo_rechazo": "rechazadas" }
    },
    destroy: true,
    "columns": [

        {
            "title": "Nombre",
            "data": "nombre"
        }, {
            "title": "Apellidos",
            "data": "primer_ap"
        },
        {
            "title": "RFC",
            "data": "rfc"
        },
        {
            "title": "Correo electronico",
            "data": "email"
        },
        {
            "title": "Acciones"

                ,
            "width": "15%"
        }
        /* ,
                {
                    "title": "Avance validación",
                    "width": "15%"
                },
                {
                    "title": "Acciones",
                    "width": "15%"
                } */
    ],
    "columnDefs": [
        /* {
            "render": function(data, type, row) {
                var botones = '';
                
                if (row.etapa == 'EN REVISIÓN') {
                    
                    
                    botones += `<h6><span class="badge badge-info">${row.etapa}</span></h6>`
                } else if (row.etapa == 'RECHAZADA')
                {
                   
                    botones += `<h6><span class="badge badge-danger">${row.etapa}</span></h6>`
                    
                }else if (row.etapa == 'CONCLUIDA') {
                    botones += `<h6><span class="badge badge-success">${row.etapa}</span></h6>`
                }
    
    
                return botones;
    
            },
            "targets": 2
        },{
            "render": function(data, type, row) {
                var botones = '';
                
                if (row.asignados == 'ASIGNADO') {
                    
                    
                    botones += `<h6><span class="badge badge-success">${row.nombre_asignados}</span></h6>`
                } else if (row.asignados == 'SIN ASIGNAR') {
                    botones += `<h6><span class="badge badge-warning">Sin asignar</span></h6>`    
                
                }
    
    
                return botones;
    
            },
            "targets": 3
        },{
            "render": function(data, type, row) {
                var botones = '';
                    if (row.num_comentarios > 0) {
                        botones += `<a href="#" class="btn btn-outline-danger btn-sm mr-3">
                                    <i class="flaticon2-chat-1"></i>${row.num_comentarios} Mensajes
                                    </a>`;    
                    }else{
                        botones += `<a href="#" class="btn btn-outline-warning btn-sm mr-3">
                                    <i class="flaticon2-chat-1"></i>Sin Mensajes
                                    </a>`;
                    }
                    
                 
                return botones;
    
            },
            "targets": 4
        },{
            "render": function(data, type, row) {
                
                var subTotales = row.total_rechazadas * 100;
                var porcentajeTotal = subTotales/row.total_secciones;
                var botones = '';

                botones += `<h6><span class="badge badge-success">${Math.round(porcentajeTotal)}%</span></h6>`
                    
                 
                return botones;
    
            },
            "targets": 5
        }, */
        {
            "render": function(data, type, row) {
                var botones = '';




                /* if (row.asignados == 'SIN ASIGNAR') { */

                botones += `<button type="button" class="btn btn-light-success font-weight-bold mr-2" data-toggle="tooltip" title="Activar como ponente" onclick="activarPonentes(${row.id_us})">
                    <i class="flaticon2-check-mark"></i>
                    </button>`;
                /*       }else if (row.asignados == 'ASIGNADO') {
                          botones += `<a href="${urlValidarSecciones+'/'+row.id_acta}" class="btn btn-sm btn-default btn-text-primary btn-hover-primary btn-icon mr-2" title="Editar"> <span class="svg-icon svg-icon-md"> <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24"></rect>
                          <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) "></path>
                          <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                          </g>
                          </svg> </span>
                      </a>`;    
                      } */
                return botones;

            },
            "targets": 4
        },
    ],
    "drawCallback": function(settings, json) {
        $('[data-toggle="tooltip"]').tooltip()
    }
});


function activarPonentes(idUser) {
    swal.fire({
        title: 'Aviso',
        text: 'Estás a punto de activar un ponente. ¿Estás seguro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            ajaxActivarPonentes(idUser).done(function(data) {

                if (data.status == 'valido') {
                    swal.fire({
                        title: data.mensaje.mensaje,
                        text: '',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar'
                    })
                } else {
                    swal.fire({
                        title: data.mensaje.mensaje,
                        text: '',
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Aceptar!',
                        cancelButtonText: 'Cancelar'
                    })
                }
                usuariosPonentesTables.ajax.reload()
            })
        }
    })

}


function ajaxActivarPonentes(idUser) {
    return $.ajax({
        url: urlActivar,
        type: 'POST',
        data: { 'idUs': idUser },
        async: false
    });
}
