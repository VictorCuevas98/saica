var calendar;
var eventos = [];
var eventosParse = [];
var bandera = true;
var banderaArchivo = true;

//variable contadora temporal
var contador = 1;
var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');



var KTCalendarExternalEvents = function() {

    var initExternalEvents = function() {
        $('#kt_calendar_external_events .fc-draggable-handle').each(function() {
            // store data so the calendar knows to render an event upon drop
            //contador = contador+1;
            //console.log($(this).data('id')+'.'+contador);
            $(this).data('event', {
                id: $(this).data('id')+'.'+contador,
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true, // maintain when user navigates (see docs on the renderEvent method)
                classNames: ["fc-event-solid-"+$(this).data('etiqueta')+" fc-event-"+$(this).data('icono')],
              //  "fc-event-solid-"+response.mensaje.datos.bloque.color_etiqueta+" fc-event-light"+response.mensaje.datos.bloque.color_icono
                description:$(this).data('descripcion')
            });
        });
    }

    var initCalendar = function() {

        var calendarEl = document.getElementById('kt_calendar');
        var containerEl = document.getElementById('kt_calendar_external_events');

        var Draggable = FullCalendarInteraction.Draggable;

        new Draggable(containerEl, {
            itemSelector: '.fc-draggable-handle',
            eventData: function(eventEl) {
                return $(eventEl).data('event');
            }
        });

         calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            locale: 'es',
            buttonText: {
                today: 'hoy',
                month: 'mes',
                week: 'semana',
                day: 'día'
               },
            isRTL: KTUtil.isRTL(),
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
            now: TODAY + 'T09:25:00', // just for demo

            views: {
                dayGridMonth: { buttonText: 'month' },
                timeGridWeek: { buttonText: 'week' },
                timeGridDay: { buttonText: 'day' }
            },

            defaultView: 'dayGridMonth',
            defaultDate: TODAY,

            droppable: true, // this allows things to be dropped onto the calendar
            editable: false,
            eventStartEditable: true,
            eventDurationEditable: true,
            eventResizableFromStart: false,
            eventLimit: 4, // allow "more" link when too many events
            navLinks: true,
            eventConstraint: {
                start: moment().format('YYYY-MM-DD'),
                end: '2021-05-29', // hard coded goodness unfortunately
                daysOfWeek: [ 1, 2, 3, 4,5], // Monday - Thursday

                startTime: '09:00', // a start time (10am in this example)
                endTime: '18:00:00', // an end time (6pm in this example)
            },
             validRange: {
                 start: moment().format('YYYY-MM-DD'),
                 end:  '2021-05-29' // hard coded goodness unfortunately
             },
            businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                end:  moment('2021-05-29').format('YYYY-MM-DD'), // hard coded goodness unfortunately
                daysOfWeek: [ 1, 2, 3, 4,5], // Monday - Thursday

                startTime: '09:00:00', // a start time (10am in this example)
                endTime: '18:00:00', // an end time (6pm in this example)

              },
            displayEventEnd: true,
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                //console.log(info);
                //guardarEventoDrop();
                var nuevaFecha = new Date(info.date);
                //console.log(nuevaFecha);
                var fechaString = nuevaFecha.getFullYear()  + "-" + ("0" + (Number(nuevaFecha.getMonth())+1)) + "-" + ("0" + nuevaFecha.getDate()).slice(-2);
                var hora_inicio = ("0" + nuevaFecha.getHours()).slice(-2) + ":" + ("0" + nuevaFecha.getMinutes()).slice(-2)+ ":" +("0" + nuevaFecha.getSeconds()).slice(-2);
                var hora_fin = (Number(("0" + nuevaFecha.getHours()).slice(-2))+1) + ":" + ("0" + nuevaFecha.getMinutes()).slice(-2)+ ":" +("0" + nuevaFecha.getSeconds()).slice(-2);
                //console.log(fechaString);
                //console.log(hora_inicio);

                guardarEventoDrop(info.draggedEl.dataset.id, fechaString, hora_inicio, hora_fin);

            },
            eventResizeStart: function(info){
               // console.log('empeiza');
            },
            eventResizeStop: function(info){
               // console.log('termina el rezice');
                //console.log(info);
            },
            eventResize: function (event, dayDelta, minuteDelta, revertFunc, jsEvent, ui, view) {
               // console.log(event);
                var nuevaFecha = new Date(event.event.end);
                var horaString = nuevaFecha.getHours() + ":" + nuevaFecha.getMinutes()+ ":" + nuevaFecha.getSeconds();
                guardarEventoHoraFin(event.event.id, horaString);
        },

            eventDrop: function(info){
               // console.log(info);
               // console.log(eventosParse);
               // console.log(info.oldEvent.id);
                var nuevaFecha = new Date(info.event.start);
                var fechaString = nuevaFecha.getFullYear()  + "-" + (nuevaFecha.getMonth()+1) + "-" + nuevaFecha.getDate();
                var horaString = nuevaFecha.getHours() + ":" + nuevaFecha.getMinutes();

                //nueva_hora_inicio.setMilliseconds(hora_inicio_old.getMilliseconds() + (info.delta.milliseconds));
                //console.log(nueva_hora_inicio);
                guardarEventoDiaYHora(info.oldEvent.id, fechaString, horaString);
            },
            eventClick: function(info) {
                //console.log(info);

                if(bandera){

                  ///  console.log(eventosParse);
                    $('#modal_editar_evento').modal('show');
                    var bloque = eventosParse.find(e => e.bloque.id == info.event.id);
                    
                    $('#hora_inicioE').val(bloque.bloque.hora_inicio);
                    $('#hora_finE').val(bloque.bloque.hora_fin);

                    $('#bloque_id').val(bloque.bloque.id);
                    $('#tituloE').val(bloque.bloque.titulo);
                    $('#descripcionE').val(bloque.evento.descripcion);
                    $('#pass_conferenciaE').val(bloque.bloque.pass_conferencia);
                    $('#zoomE').val(bloque.bloque.liga);
                    $('#id_conferenciaE').val(bloque.bloque.id_conferencia);
                    $('#ejeE').val(bloque.evento.cat_eje_id).trigger('change');

                    $('#tipo_eventoE').val(bloque.tipo_evento.codigo_evento).trigger('change');
                    $('#a_quienE').val(bloque.evento.dirigido_a);
                    $('#capacidadE').val(bloque.bloque.capacidad);
                    var urlSiHay = bloque.evento.path_file? bloque.evento.path_file.split('/')[1]+'/'+bloque.evento.path_file.split('/')[2] : '#';
                    $('#a_programa').attr('href', url+'storage/'+urlSiHay);
                    if(bloque.evento.path_file){
                        $('#a_programa').html('<small>*ver programa</small>');
                    } else {
                        $('#a_programa').html('');
                    }

                    //ponentes
                    var selectPonentes = [];
                    bloque.ponentes.forEach(ponente =>{
                        selectPonentes[selectPonentes.length] = ponente.id;
                    });
                    $('#ponentesE').val(selectPonentes).trigger('change');

                    if(bloque.bloque.status.clave_status == 'X' || bloque.bloque.status.clave_status == 'C'){
                        $('#botonSubmitEditar').hide();
                    } else {
                        $('#botonSubmitEditar').show();
                    }
                }
                bandera = true;
            },

            eventRender: function(info) {
               //console.log(info);
                var element = $(info.el);
                //elemento dentro de los eventos array
                var existeEvento = eventosParse.find(e=>e.bloque.id == info.event.id);
                var checked = '';
                var readonly = '';
                var classeContext = '';

                if(existeEvento){
                    checked = existeEvento.bloque.publicado == 'true' || existeEvento.bloque.publicado == true? 'checked': '';
                    if (typeof existeEvento.bloque.status === 'undefined') {
                        // pagetype doesn't exist
                    }else{
                        if(existeEvento.bloque.status.clave_status == 'X' || existeEvento.bloque.status.clave_status == 'C'){
                            readonly = 'hidden';
                        }
                    }
                    
                }

                //console.log(existeEvento.bloque.publicado);
               // console.log(checked);
                var originalClass = element[0].className;
                element[0].className = originalClass + ' hasmenu';
                element.attr('id', info.event.id);
                element.attr('data-id', info.event.id);
                //element.data('data-id', info.event.id);
                element.append('<span style="z-index:9999"><input '+ readonly +' '+ checked +' id='+ info.event.id +' class="" onclick="publicar(this);" style="margin-left:20px;" name="checkEvento" type="checkbox"><lablel style="color:#FFFFFF; margin-bottom:1px;" for="checkEvento"> Publicar</label></span>');
                if (info.event.extendedProps && info.event.extendedProps.description) {
                    if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    } else if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', info.event.extendedProps.description);
                        element.data('placement', 'top');
                        KTApp.initPopover(element);
                    }  else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    }
                }
                element.find('.fc-title').each(function () {
                    $(this).insertBefore($(this).prev('.fc-time'));
                    });
            }
        });

        calendar.render();

        $(document).contextmenu({
            delegate: ".hasmenu",
            preventContextMenuForPopup: true,
            preventSelect: true,
            menu: [
                {title: "Agregar video", cmd: "video", uiIcon: "ui-icon-x"},
                {title: "Cancelar evento", cmd: "cancelar", uiIcon: "ui-icon-x"},
                    {title: "Hacer recurrente", cmd: "recurrente", uiIcon: "fa fa-pen"},
                    {title: "Eliminar", cmd: "Eliminar", uiIcon: "ui-icon-copy"}
                ],
            select: function(event, ui) {
                    // Logic for handing the selected option
                    if(ui.target[0].parentElement.parentElement.id != ''){
                        var bloqueId = ui.target[0].parentElement.parentElement.id;
                    } else if(ui.target[0].parentElement.id != ''){
                        var bloqueId = ui.target[0].parentElement.id;
                    } else{
                        var bloqueId = ui.target[0].id;
                    }

                    if(ui.cmd == 'recurrente'){
                        //console.log(event);
                        //console.log(ui);
                        //var bloqueId = ui.target[0].parentElement.parentElement.id;
                        //var bloqueId = ui.target[0].parentElement.parentElement.id != ''? ui.target[0].parentElement.parentElement.id : ui.target[0].parentElement.id;

                        var existe = eventosParse.find(e => e.bloque.id == bloqueId);
                        if(existe){
                            if(existe.evento.recurrente){
                                swal.fire({
                                    title: '',
                                    text: "El evento ya es recurrente, puedes encontrarlo en la lista de la izquierda  =)",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: '¡ok!',
                                });

                                return;
                            }

                            if(existe.bloque.status.clave_status == 'X' || existe.bloque.status.clave_status == 'C'){
                                swal.fire({
                                    title: '',
                                    text: "El evento que intentas hacer recurrente se encuentra cancelado o concluido =)",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: '¡ok!',
                                });

                                return;
                            }

                        }

                        //console.log(bloqueId);
                        swal.fire({
                            title: 'Hacer recurrente el evento',
                            text: "Los eventos pueden ser recurrentes y se agregan a la lista de la izquierda. De allí se pueden insertar en la fecha deseada y usar la vista de semana o día para editar el horario.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '¡Hacer recurrente!',
                            cancelButtonText: 'Cancelar'
                          }).then((result) => {
                              //console.log(result);
                            if (result.value) {
                                //console.log(bloqueId);
                                convertir_recurrente(bloqueId);
                            }
                          })
                    }
                    if(ui.cmd == 'Eliminar'){
                        //console.log(ui);
                        var existe = eventosParse.find(e => e.bloque.id == bloqueId);
                        if(existe) {
                            if (existe.bloque.publicado || existe.bloque.status.clave_status == 'X' || existe.bloque.status.clave_status == 'C') {
                                swal.fire({
                                    title: '',
                                    text: "No puedes eliminar un evento concluido o publicado =)",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: '¡ok!',
                                });

                                return;
                            }
                            //console.log(bloqueId);
                            swal.fire({
                                title: '¿Estas seguro de eliminar el evento?',
                                text: "Aun puedes editar las fechas y horas en el calendario",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: '¡Si, eliminar!',
                                cancelButtonText: 'Cancelar'
                            }).then((result) => {
                                //console.log(result);
                                if (result.value) {
                                    //console.log('entro en si');
                                    //console.log(bloqueId);
                                    eliminarEvento(bloqueId);
                                }
                            })
                        }
                    }
                    if(ui.cmd == 'cancelar'){
                        //console.log('cancelar');
                        //console.log(bloqueId);
                        var existe = eventosParse.find(e => e.bloque.id == bloqueId);
                        if(existe) {
                            if (existe.bloque.status.clave_status == 'X' || existe.bloque.status.clave_status == 'C') {
                                swal.fire({
                                    title: '',
                                    text: "El evento ya se encuentra cancelado o concluido  =)",
                                    icon: 'warning',
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: '¡ok!',
                                });

                                return;
                            }
                            swal.fire({
                                title: '¿Estas seguro de cancelar el evento?',
                                text: "Se dara aviso que se ha cancelado el evento",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: '¡Si, cancelar!',
                                cancelButtonText: 'No'
                            }).then((result) => {
                                //console.log(result);
                                if (result.value) {
                                    //console.log('entro en si');
                                    //console.log(bloqueId);
                                    cancelarEvento(bloqueId);
                                }
                            });
                        }
                    }
                if(ui.cmd == 'video'){
                    //console.log(ui);
                    var existe = eventosParse.find(e => e.bloque.id == bloqueId);
                    console.log(existe);
                    if(existe) {
                        if (existe.bloque.status.clave_status == 'C') {
                            swal.fire({
                                title: '¡Sube el link del video del evento!',
                                text: 'Copia y pega el link o url del video que subiste al repositorio.',
                                input: 'text',
                                inputAttributes: {
                                    autocapitalize: 'off'
                                },
                                showCancelButton: true,
                                cancelButtonText: "cancelar",
                                confirmButtonText: 'Subir',
                                showLoaderOnConfirm: true,
                                preConfirm: (input) => {
                                    return fetch(url + 'admin/eventos/video?video=' + input + '&bloqueId=' + bloqueId)
                                        .then(response => {
                                            return response.json()
                                                .then((json) => {
                                                    //console.log(json);
                                                    if (json.codigo != 200) {
                                                        throw new Error(json.aviso)
                                                    }
                                                    return Promise.resolve(json)
                                                })
                                        }).catch(error => {
                                            console.log(error);
                                            swal.showValidationMessage(
                                                `Fallo el guardado, intenta de nuevo o contacta a la DGTC. Detalles: ${error}`
                                            )
                                        })
                                },
                                allowOutsideClick: () => !swal.isLoading()
                            }).then((result) => {
                                console.log(result);
                                if (result.value.codigo == 200) {
                                    console.log(result.value.mensaje.aviso)
                                    swal.fire({
                                        title: result.value.mensaje.aviso,
                                        html:
                                            '<video width="300" height="190" autoplay  controls>' +
                                            '  <source src="' + result.value.mensaje.datos.bloque.url + '" type="video/mp4">' +
                                            'Tu navegador no soporta video' +
                                            '</video>',
                                    })
                                }
                            })
                        } else {
                            console.log("entro");
                            swal.fire({
                                title: '',
                                text: "Para subir el video es necesario que el evento se encuentre concluido  =)",
                                icon: 'warning',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: '¡ok!',
                            });

                            return;
                        }
                    }
                }
            },
            beforeOpen: function (event, ui) {
                ui.menu.css('z-index', 1000);
            }
        });
    }

    return {
        //main function to initiate the module
        init: function() {
            initExternalEvents();
            initCalendar();
        }
    };
}();

function publicar(checkbox){
    bandera = false;
    //console.log('dio click en el checkbox');
    if(checkbox.checked){
        //console.log('true');
        swal.fire({
            title: '¿Publicar Evento?',
            text: "El evento no se mostrará para los servidores públicos hasta que esté publicado.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, publicar',
            cancelButtonText: 'cancelar'
          }).then((result) => {
            if (result.value) {
                publicarEvento(true, checkbox.id)
            } else{
                checkbox.checked = false;
            }
          })
    } else {
        //console.log('false');
        swal.fire({
            title: '¿Ocultar publicación?',
            text: "Los movimientos que hagas al evento no seran visibles hasta que se publique de nuevo.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, ocultar',
            cancelButtonText: 'cancelar'
          }).then((result) => {
            if (result.value) {
                publicarEvento(false, checkbox.id)
            } else{
                checkbox.checked = true;
            }
          });
    }

}

function publicarEvento(publicar, idBloque){
    //console.log(idBloque);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/eventos/publicar",
        type: 'POST',
        dataType: 'JSON',
        data: {
            publicar: publicar, //es un boleando
            bloqueId: idBloque
        }
    }).done((response)=>{
        //console.log(response);
        if(response.codigo == 200){
            swal.fire('Actualizado', response.mensaje.aviso, 'success');
            var actualizarEvento = eventosParse.find(e=>e.bloque.id == idBloque);
            if(actualizarEvento){
                actualizarEvento.bloque.publicado = response.mensaje.datos.bloque.publicado;
                var eventoCalendar = calendar.getEventById(idBloque);
                eventoCalendar.remove();
                //console.log(response.mensaje.datos.bloque.publicado);
                var isTrueSet = response.mensaje.datos.bloque.publicado == 'true'? true: false;
            //eventoCalendario.remove();

    calendar.addEvent({
        id: response.mensaje.datos.bloque.id,
        title: response.mensaje.datos.bloque.titulo,
        //url: formElE.find('#url').val(),
        start: response.mensaje.datos.bloque.fecha_inicio+'T'+response.mensaje.datos.bloque.hora_inicio,
        end: response.mensaje.datos.bloque.fecha_fin+'T'+response.mensaje.datos.bloque.hora_fin,
        //className: "fc-event-solid-"+response.mensaje.datos.bloque.color_etiqueta+" fc-event-"+response.mensaje.datos.tipo_evento.color,
        className: " fc-event-"+response.mensaje.datos.tipo_evento.codigo_evento,
        description: response.mensaje.datos.bloque.titulo,
        editable: !isTrueSet,
        stick: true
    });

            }
        }


    }).fail((response)=>{
        console.log(response);
    });
}


function guardarEventoHoraFin(id, hora){
    //console.log('guardar evento hora');
    //console.log(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/eventos/actualizar/fin",
        type: 'POST',
        dataType: 'JSON',
        data: {
            bloqueId: id,
            hora: hora
        }
    }).done((response)=>{
        //console.log(response);

    }).fail((response)=>{
        console.log(response);
    });
}
function guardarEventoDiaYHora(id, fecha, hora){
    //console.log('guardar evento dua y hora');
    //console.log(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/eventos/actualizar/inicio",
        type: 'POST',
        dataType: 'JSON',
        data: {
            bloqueId: id,
            fecha: fecha,
            hora: hora
        }
    }).done((response)=>{
        //console.log(response);

    }).fail((response)=>{
        console.log(response);
    });
}

function guardarEventoDrop(idEvento, fecha, hora_inicio, hora_fin){

    //console.log(idEvento+'.'+contador);
    var idCalendario = idEvento+'.'+contador;
    //console.log(idCalendario);
var calendario = calendar;
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/eventos/recurrente/nuevo",
        type: 'POST',
        dataType: 'JSON',
        data: {
            eventoId: idEvento,
            fecha: fecha,
            hora_inicio: hora_inicio,
            hora_fin: hora_fin
        }
    }).done((response)=>{
        //console.log(response);
        var eventoCalendario = calendar.getEventById(idCalendario);
       // console.log(eventoCalendario);
        //eventoCalendario.remove();
        eventoCalendario.id = response.mensaje.datos.bloque.id;
        eventoCalendario._def.publicId = response.mensaje.datos.bloque.id;
        eventoCalendario.remove();

        eventosParse.push({
            bloque: response.mensaje.datos.bloque,
            evento: response.mensaje.datos.evento,
            ponentes: response.mensaje.datos.ponentes,
            tipo_evento:response.mensaje.datos.tipo_evento
            });
            //eventoCalendario.remove();
            //console.log(response.mensaje.datos.bloque.id);
            //console.log(response.mensaje.datos.evento.titulo);
            //console.log(response.mensaje.datos.bloque.fecha_inicio+'T'+response.mensaje.datos.bloque.hora_inicio);
            //console.log(response.mensaje.datos.bloque.fecha_fin+'T'+response.mensaje.datos.bloque.hora_fin);
            //console.log("fc-event-solid-"+response.mensaje.datos.bloque.color_etiqueta+" fc-event-"+response.mensaje.datos.bloque.color_icono);
            //console.log(response.mensaje.datos.evento.descripcion);


            calendar.addEvent({
                id: response.mensaje.datos.bloque.id,
                title: response.mensaje.datos.bloque.titulo,
                start: response.mensaje.datos.bloque.fecha_inicio+'T'+response.mensaje.datos.bloque.hora_inicio,
                end: response.mensaje.datos.bloque.fecha_fin+'T'+response.mensaje.datos.bloque.hora_fin,
                className: "fc-event-solid-"+response.mensaje.datos.bloque.color_etiqueta+" fc-event-"+response.mensaje.datos.tipo_evento.codigo_evento,
                description: response.mensaje.datos.bloque.titulo,
                editable: false,
                stick: true
            });



            //calendar.refetchEvents();


    }).fail((response)=>{
        console.log(response);
    });
}

function convertir_recurrente(id){
    //console.log('recurrente');
    //console.log(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/eventos/recurrente",
        type: 'POST',
        dataType: 'JSON',
        data: {
            bloqueId: id
        }
    }).done((response)=>{
        //console.log(response);
        swal.fire(
            'Evento agregado a recurrentes',
            'El evento ha pasado a ser recurrente y estara dispobible en la lista de la izquierda',
            'success'
          );
          $('#kt_calendar_external_events').append(
             '<div class="fc-draggable-handle label font-weight-bolder label-lg label-'+ response.mensaje.datos.tipo_evento.color+' label-inline mb-5 cursor-move" data-etiqueta="fc-event-solid-'+ response.mensaje.datos.bloque.color_etiqueta+' fc-event-'+response.mensaje.datos.bloque.color_icono+'" data-descripcion="'+ response.mensaje.datos.evento.descripcion+'" data-id="'+ response.mensaje.datos.evento.id+'" title="'+ response.mensaje.datos.evento.titulo +'">'+ response.mensaje.datos.evento.titulo.substring(0,33)+'...</div><br/>'
          );
          $('#kt_calendar_external_events .fc-draggable-handle').each(function() {
            // store data so the calendar knows to render an event upon drop

            //console.log($(this).data('id')+'.'+contador);
            $(this).data('event', {
                id: $(this).data('id')+'.'+contador,
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true, // maintain when user navigates (see docs on the renderEvent method)
                classNames: ["fc-event-solid-"+$(this).data('etiqueta')+" fc-event-"+$(this).data('icono')],
              //  "fc-event-solid-"+response.mensaje.datos.bloque.color_etiqueta+" fc-event-light"+response.mensaje.datos.bloque.color_icono
                description:$(this).data('descripcion')
            });
        });
    }).fail((response)=>{
        //console.log(response);
    });

}

function eliminarEvento(id){
    //console.log('emiinar');
    //console.log(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/eventos/eliminar",
        type: 'POST',
        dataType: 'JSON',
        data: {
            bloqueId: id
        }
    }).done((response)=>{
        //console.log(response);
        swal.fire(
            'Evento Eliminado',
            'El evento se elimino correctamente y no será visible para ningun usuario',
            'success'
          )
        var eventoCalendario = calendar.getEventById(id);
        eventoCalendario.remove();
    }).fail((response)=>{
        console.log(response);
    });

}

function cancelarEvento(id){
    //console.log('emcancelar');
    //console.log(id);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url : url+"admin/eventos/cancelar",
        type: 'POST',
        dataType: 'JSON',
        data: {
            bloqueId: id
        }
    }).done((response)=>{
        //console.log(response);
        swal.fire(
            'Evento Cancelado',
            'El evento se ha cancelado, los servidores publicos podran visualizarlo, pero no podran hacer registros ni constancias. Se envio un correo sobre la cancelación',
            'success'
          )
        var eventoCalendario = calendar.getEventById(id);
        eventoCalendario.remove();

        var existe = eventosParse.find(e=>e.bloque.id === response.mensaje.datos.bloque.id);
        //console.log('existe evento en la ', existe);
        if(existe){
            existe.bloque = response.mensaje.datos.bloque;
            existe.evento = response.mensaje.datos.evento;
        }


        calendar.addEvent({
            id: response.mensaje.datos.bloque.id,
            title: response.mensaje.datos.bloque.titulo,
            //url: formElE.find('#url').val(),
            start: response.mensaje.datos.bloque.fecha_inicio+'T'+response.mensaje.datos.bloque.hora_inicio,
            end: response.mensaje.datos.bloque.fecha_fin+'T'+response.mensaje.datos.bloque.hora_fin,
            //className: "fc-event-solid-"+response.mensaje.datos.bloque.color_etiqueta+" fc-event-"+response.mensaje.datos.tipo_evento.color,
            className: " fc-event-"+response.mensaje.datos.tipo_evento.codigo_evento,
            description: response.mensaje.datos.bloque.titulo,
            stick: true,
            editable: false
        });

    }).fail((response)=>{
        console.log(response);
    });

}

function agregarEvento(){
    //console.log('agrego evento');
    $('#modal_agregar_evento').modal('show');
    /*calendar.addEvent({
        id: 'esteEsUnId',
        title: 'bnvnvbnvbn',
        url: 'ghfghfghfgh',
        start: TODAY,
        className: "fc-event-solid-primary",
        description: 'asdasdasd'
    });
    */
}

function cambioColorE(objHtml){
    var calse = '';
    switch(objHtml){
       case 'TALL':
        clase = '#BF8F00';
        break;
        case 'PRES':
        clase = '#00B0F0';
        break;
        case 'CURS':
        clase = '#C00000';
        break;
        case 'PLAT':
        clase = '#BF8F00';
        break;
       case 'CONF':
           clase = '#FFC000';
           break;
    }
    // $('#tipo_eventoE').removeClass();
    // $('#tipo_eventoE').addClass('form-control noEditRecu text-white bg-'+clase);
    $('#tipo_eventoE').css({'background-color':clase});
}
function cambioColorIconoE(colorClase){
    $('#color_iconoE').removeClass();
    $('#color_iconoE').addClass('form-control noEditRecu text-white bg-'+colorClase);
}

function cambioColor(objHtml){
    //console.log(objHtml);
    //var bloque = eventosParse.find(e=>e.tipo_evento.codigo_evento === objHtml);
   // console.log(bloque);
   var calse = '';
   switch(objHtml){
       case 'TALL':
        clase = '#BF8F00';
        break;
        case 'PRES':
        clase = '#00B0F0';
        break;
        case 'CURS':
        clase = '#C00000';
        break;
        case 'PLAT':
        clase = '#BF8F00';
        break;
       case 'CONF':
           clase = '#FFC000';
           break;
   }
   $('#tipo_evento').css({'background-color':clase});
}
function cambioColorIcono(colorClase){
    $('#color_icono').removeClass();
    $('#color_icono').addClass('form-control noEditRecu bg-'+colorClase);
}

var formElE;
var validatorE;
formElE = $('#guardar_evento');
editar_evento
var initValidationE = function() {
    jQuery.validator.addMethod('weekend', function (value, element, param) {

        var date = new Date(value).getDay();
        //console.log(date);
        if(date == 5 || date == 6){
            return false;
        } else {
            return true;
        }

    }, 'Los eventos no pueden ser en fines de semana');

    jQuery.validator.addMethod("sizeMax", function(value, element, param) {

        if($('#'+element['id'])[0].files.length > 0) {
            if ($('#' + element['id'])[0].files[0].size / 1024 / 1024 > param) {
                return false;
            } else {
                return true;
            }
        } else {
            return  true;
        }
    }, "El peso del archivo excede el maximo permitido (8MB)");
    jQuery.validator.addMethod("minHour", function(value, element, param) {
        //console.log(value);
       // console.log($('#hora_inicio').val());
        //console.log(param);
        if($('#hora_inicio').val()){
            var time1 = $('#hora_inicio').val();
            var time2 = $('#hora_fin').val();


            var hour=0;
            var minute=0;
            var second=0;

            var splitTime1= time1.split(':');
            var splitTime2= time2.split(':');

            hour = parseInt(splitTime1[0])-parseInt(splitTime2[0]);
            minute = parseInt(splitTime1[1])-parseInt(splitTime2[1]);
            hour = hour + minute/60;
            //console.log(hour*-1);
            if((hour*-1)<1){
                return false;
            }
            return true;
        } else {
          return false;
        }

    }, "El evento deber durar minimo una hora");

    validatorE = formElE.validate({
        // Validate only visible fields
        ignore: ":hidden",

        // Validation rules
        rules: {
            titulo: {
                required: true
            },
                descripcion: {
                    required: true
                },
            fecha_inicio: {
                    required: true,
                    weekend: [1,2,3,4,5]

                },
                hora_inicio: {
                    required: true
                },
                hora_fin: {
                    required: true,
                    minHour: 1
                },
                programa: {
                    sizeMax: 8
                },

                a_quien: {
                    required: true
                },
                capacidad: {
                    required: true
                },
                eje: {
                    required: true
                },
                /*url: {
                    required: true
                },
                ponente: {
                    required: true
                },*/
        },
        messages:{
            titulo: {
                required: 'El titulo es requerido'
            },
            descripcion: {
                required: 'La descripcion es requerida'
            },
            fecha_inicio: {
                required: 'La fecha es requerida ',
                min: 'Selecciona una fecha'
            },
            //fecha_fin: {
            //    required: 'La fecha es requerida '
            //},
            hora_inicio: {
                required: 'La hora de inicio es requerida ',
                min: 'La hora de inicio debe ser entre las 09:00 y las 16:00 horas',
                max: 'La hora de inicio debe ser entre las 09:00 y las 16:00 horas'
            },
            hora_fin: {
                required: 'La hora de termino es requerida',
                min: 'La hora de termino debe ser entre las 10:00 y las 18:00 horas',
                max: 'La hora de termino debe ser entre las 10:00 y las 18:00 horas'
            },
            eje: {
                required: 'Selecciona un Eje'
            },
            a_quien: {
                required: 'A quien va dirigido es obligatorio'
            },
            capacidad: {
                required: 'La capacidad del evento es obligatoria'
            },
            /*url: {
                required: 'EL '
            },
            ponente: {
                required: 'EL '
            },*/
        },
        errorClass: "error-class",
        validClass:"valid_class",
        errorElement:"em",
        success: function(label) {
            label.addClass("valid_class").append('&#10004;')
        },

        // Display error
        invalidHandler: function(event, validator) {
            //console.log(validator);
            swal.fire({
                "title": "",
                "text": 'El campo "'+ validator.errorList[0].element.labels[0].innerText+'" es obligatorio',
                "type": "error",
                "buttonStyling": false,
                "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
            });
        },

        // Submit valid form
        submitHandler: function (form) {

        }
    });
};

var initSubmitE = function() {
    var btn = formElE.find('#botonSubmit');
    //var url = window.location.href;
    btn.on('click', function(e) {
        e.preventDefault();

        if (validatorE.form()) {
            // See: src\js\framework\base\app.js
            //KTApp.progress(btn);
            //KTApp.block(formEl);

            // See: http://malsup.com/jquery/form/#ajaxSubmit
            formElE.ajaxSubmit({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url+"admin/eventos/nuevo",
                type: 'POST',
                dataType: 'JSON',
                data: formElE.serialize(),
                beforeSend: function () {
                    $('#botonSubmit').attr('disabled', true);
                    $('#botonSubmit').addClass('spinner spinner-light');
                },
                success: function(response) {
                    //KTApp.unprogress(btn);
                    console.log(response);
                    $('#botonSubmit').removeClass('spinner spinner-light');
                    $('#botonSubmit').attr('disabled', false);
                    if(response.codigo == 200) {

                        //console.log(eventosParse);
                        eventosParse.push({
                            bloque: response.mensaje.datos.bloque,
                            evento: response.mensaje.datos.evento,
                            ponentes: response.mensaje.datos.ponentes,
                            tipo_evento:response.mensaje.datos.tipo_evento
                            });

                        swal.fire({
                            "title": "",
                            "text": response.mensaje.aviso,
                            "icon": "success",
                            "confirmButtonClass": "btn btn-success"
                        });

                        calendar.addEvent({
                            id: response.mensaje.datos.bloque.id,
                            title: response.mensaje.datos.bloque.titulo,
                            //url: formElE.find('#url').val(),
                            start: response.mensaje.datos.bloque.fecha_inicio+'T'+response.mensaje.datos.bloque.hora_inicio,
                            end: response.mensaje.datos.bloque.fecha_fin+'T'+response.mensaje.datos.bloque.hora_fin,
                            //className: "fc-event-solid-"+response.mensaje.datos.bloque.color_etiqueta+" fc-event-"+response.mensaje.datos.tipo_evento.color,
                            className: " fc-event-"+response.mensaje.datos.tipo_evento.codigo_evento,
                            description: response.mensaje.datos.bloque.titulo,
                            stick: true
                        });
                        validatorE.resetForm();
                        $('#modal_agregar_evento').modal('hide');
                    } else {
                        swal.fire({
                            "title": "",
                            "text": response.mensaje,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                },
                error: function (error) {
                    // $('#botonSubmit').removeClass('spinner spinner-light');
                    $('#botonSubmit').removeClass('spinner spinner-light');
                    $('#botonSubmit').attr('disabled', false);
                    //console.log(error);
                    swal.fire({
                        "title": "",
                        "text": "Hay un error con la solicitud al servidor",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            });

        }
    });
};


var formEditar;
formEditar = $('#editar_evento');
//====================================================================================
var validatorEditar;

var initValidationEditar = function() {
    
    
    jQuery.validator.addMethod("minHourEditar", function(value, element, param) {
        
        if($('#hora_inicioE').val()){
            var time1 = $('#hora_inicioE').val();
            var time2 = $('#hora_finE').val();


            var hour=0;
            var minute=0;
            var second=0;

            var splitTime1= time1.split(':');
            var splitTime2= time2.split(':');

            hour = parseInt(splitTime1[0])-parseInt(splitTime2[0]);
            minute = parseInt(splitTime1[1])-parseInt(splitTime2[1]);
            hour = hour + minute/60;
            //console.log(hour*-1);
            if((hour*-1)<1){
                return false;
            }
            return true;
        } else {
          return false;
        }

    }, "El evento deber durar minimo una hora");
    
    validatorEditar = formEditar.validate({
        // Validate only visible fields
        ignore: ":hidden",

        // Validation rules
        rules: {
            
                hora_inicioE: {
                    required: true
                },
                hora_finE: {
                    required: true,
                    minHourEditar: 1
                },
            
        },
        messages:{
            
            hora_inicioE: {
                required: 'La hora de inicio es requerida ',
                min: 'La hora de inicio debe ser entre las 09:00 y las 16:00 horas',
                max: 'La hora de inicio debe ser entre las 09:00 y las 16:00 horas'
            },
            hora_finE: {
                required: 'La hora de termino es requerida',
                min: 'La hora de termino debe ser entre las 10:00 y las 18:00 horas',
                max: 'La hora de termino debe ser entre las 10:00 y las 18:00 horas'
            },
            
        },
        errorClass: "error-class",
        validClass:"valid_class",
        errorElement:"em",
        success: function(label) {
            label.addClass("valid_class").append('&#10004;')
        },

        // Display error
        invalidHandler: function(event, validator) {
            //console.log(validator);
            swal.fire({
                "title": "",
                "text": 'El campo "'+ validator.errorList[0].element.labels[0].innerText+'" es obligatorio',
                "type": "error",
                "buttonStyling": false,
                "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
            });
        },

        // Submit valid form
        submitHandler: function (form) {

        }
    });
};
//====================================================================================


var initSubmitEditar = function() {
    var btn = formEditar.find('#botonSubmitEditar');
    //var url = window.location.href;
    btn.on('click', function(e) {
        e.preventDefault();

        if (validatorEditar.form()) {
            // See: src\js\framework\base\app.js
            //KTApp.progress(btn);
            //KTApp.block(formEl);
            if(!banderaArchivo){
               return;
            }

            // See: http://malsup.com/jquery/form/#ajaxSubmit
            formEditar.ajaxSubmit({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : url+"admin/eventos/editar",
                type: 'POST',
                dataType: 'JSON',
                data: formEditar.serialize(),
                beforeSend: function () {
                    $('#botonSubmitEditar').attr('disabled', true);
                    $('#botonSubmitEditar').addClass('spinner spinner-light');
                },
                success: function(response) {
                    //KTApp.unprogress(btn);
                    console.log(response);
                    $('#botonSubmitEditar').removeClass('spinner spinner-light');
                    $('#botonSubmitEditar').attr('disabled', false);
                    if(response.codigo == 200) {
                        var eventoCalendario = calendar.getEventById(response.mensaje.datos.bloque.id);
                        eventoCalendario.remove();

                        swal.fire({
                            "title": "",
                            "text": response.mensaje.aviso,
                            "icon": "success",

                        });


                        var existe = eventosParse.find(e=>e.bloque.id === response.mensaje.datos.bloque.id);
                        //console.log('existe evento en la ', existe);
                        if(existe){
                                existe.bloque = response.mensaje.datos.bloque;
                                existe.evento = response.mensaje.datos.evento;
                                existe.ponentes = response.mensaje.datos.ponentes;
                                existe.tipo_evento = response.mensaje.datos.tipo_evento;
                            if(existe.evento.recurrente){
                                var demasEventos = eventosParse.filter(e=>e.evento.id == existe.evento.id && e.bloque.id != existe.bloque.id);
                                if(demasEventos){
                                    demasEventos.forEach(elemento =>{
                                       elemento.ponentes = response.mensaje.datos.ponentes;
                                    });
                                }
                            }
                        }
                        var isTrueSet = response.mensaje.datos.bloque.publicado == 'true' || response.mensaje.datos.bloque.publicado == true? true: false;

                        calendar.addEvent({
                            id: response.mensaje.datos.bloque.id,
                            title: response.mensaje.datos.bloque.titulo,
                            //url: formElE.find('#url').val(),
                            start: response.mensaje.datos.bloque.fecha_inicio+'T'+response.mensaje.datos.bloque.hora_inicio,
                            end: response.mensaje.datos.bloque.fecha_fin+'T'+response.mensaje.datos.bloque.hora_fin,
                            //className: "fc-event-solid-"+response.mensaje.datos.bloque.color_etiqueta+" fc-event-"+response.mensaje.datos.tipo_evento.color,
                            className: " fc-event-"+response.mensaje.datos.tipo_evento.codigo_evento,
                            description: response.mensaje.datos.bloque.titulo,
                            editable: !isTrueSet,
                            stick: true
                        });
                            calendar.refetchEvents()
                        $('#modal_editar_evento').modal('hide');

                    } else {
                        swal.fire({
                            "title": "",
                            "text": response.mensaje,
                            "type": "error",
                            "confirmButtonClass": "btn btn-secondary"
                        });
                    }
                },
                error: function (error) {
                    // $('#botonSubmit').removeClass('spinner spinner-light');
                    $('#botonSubmitEditar').removeClass('spinner spinner-light');
                    $('#botonSubmitEditar').attr('disabled', false);
                    console.log(error);
                    swal.fire({
                        "title": "",
                        "text": "Hay un error con la solicitud al servidor",
                        "type": "error",
                        "confirmButtonClass": "btn btn-secondary"
                    });
                }
            });

        }
    });
};

function pesoInput(elemento){
    if($('#programaE')[0].files[0].size/1024/1024 > 8){
        $('#addError').append('<em id="programa-error_e" class="error-class">El peso del archivo excede el maximo permitido (8MB)</em>');
        banderaArchivo = false;
    }else{
        console.log('entro en false')
        $('#programa-error_e').remove();
        banderaArchivo = true;
    }
}


jQuery(document).ready(function() {
    KTCalendarExternalEvents.init();
    initValidationE();
    initSubmitE();
    initValidationEditar(); //validacion del formulario editar
    initSubmitEditar();
    $('.select2').select2({
        width: '100%'
    });
});
