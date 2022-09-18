//consulta areas administrativas

$(function(){


$('#entes_llenados').on('change',function(){

			$.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

			let idEnte = $(this).val();
			console.log('tengo id ' + idEnte)

			if($.trim(idEnte) == 0 || $.trim(idEnte) == '' || $.trim(idEnte) == null){

				swal.fire('Atención','Seleccione una Unidad Administrativa','warning');

				$('#areas_llenados').empty();
				$('#areas_llenados').append('<option value="0">Seleccione una opción</option>');
				$('#puestos_llenados').empty();
				$('#puestos_llenados').append('<option value="0">Seleccione una opción</option>');


			} else{
					console.log("Busqueda de áreas...");
					$.ajax({
						type:'POST',
						url: urlconsultaUnidades,
        				data:{idEnte:idEnte},
                		dataType: "JSON",
						success: function(response,data){
						console.log(response);
						$('#areas_llenados').empty();
						$('#areas_llenados').append("<option value='0'>Seleccione una opción</option>");
						for(i=0; i<response.length; i++){
							$('#areas_llenados').append("<option value='"+response[i].id+"'>"+response[i].unidad_admin+"</option>");
							}

						}
					});
			}

		});


		$('#areas_llenados').on('change',function(){

			$.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

			let area = $(this).val();
			tipo_contratacion = 'E';
			//tipo_contratacion = document.getElementById("tipo_contratacion").value;
			console.log('obtengo id de unidad ' + area);
			console.log('Tipo de Contratación ' + tipo_contratacion);

			if($.trim(tipo_contratacion) == 0 || $.trim(tipo_contratacion) == '' || $.trim(tipo_contratacion) == null){

				swal.fire('Atención','Seleccione un Tipo de contratación','warning');
				
			}else{

				if($.trim(area) == 0 || $.trim(area) == '' || $.trim(area) == null){

				swal.fire('Atención','Seleccione una Área','warning');

				$('#areas_llenados').empty();
				$('#areas_llenados').append('<option value="0">Seleccione una opción</option>');
				$('#puestos_llenados').empty();
				$('#puestos_llenados').append('<option value="0">Seleccione una opción</option>');


			} else{
					console.log("Busqueda de puestos...");
					$.ajax({
						type:'POST',
						url:urlconsultaPuestos,
        				data:{area:area, tipo_contratacion:tipo_contratacion},
                		dataType: "JSON",
						success: function(response,data){
						console.log(response);


						swal.fire({
        					title: "Buscando Puestos!",
        					text: "La busqueda terminará en segundos.",
        					timer: 5000,
        					timerProgressBar: true,
        					showCloseButton: false,
        					showCancelButton: false,
        					showConfirmButton: false,
        					allowOutsideClick: false,
        					onOpen: function() {
            					//swal.showLoading()
        					}
    					}).then(function(result) {
        					if (result.dismiss === "timer") {
            						console.log("")
        					}
   						 });


						$('#puestos_llenados').empty();
						$('#puestos_llenados').append("<option value='0'>Seleccione una opción</option>");
						for(i=0; i<response.length; i++){
							$('#puestos_llenados').append("<option value='"+response[i].id+"'>"+response[i].puesto_funcional+"</option>");
							}

						}
					});
				}
			}

		});

		$("#telOficina").keyup(function (){
 			this.value = (this.value + '').replace(/[^0-9]/g, '');
		});

		$("#extOficina").keyup(function (){
 			this.value = (this.value + '').replace(/[^0-9]/g, '');
		});

		$("#kt_form_1").validate({

			rules:{
				dateAdscripcion:{
					required:true,
				},

				telOficina:{
					required:true,
				},

				extOficina:{
					required:true,
				},

				entes_llenados:{
					required:true,
				},

				areas_llenados:{
					required:true,
				},

				puestos_llenados:{
					required:true,
				},

			},
			messages:{
				dateAdscripcion:{
					required:"Seleccione fecha de adscripción.",
				},

				telOficina:{
					required:"Teléfono invalido.",
				},

				extOficina:{
					required:"Extensión de teléfono invalido.",
				},

				entes_llenados:{
					required:"Seleccione una unidad administrativa.",
				},

				areas_llenados:{
					required:"Seleccione una área.",
				},

				puestos_llenados:{
					required:"Seleccione un puesto.",
				},

			},

			errorClass: "is-invalid",
        	validClass:"is-valid",

			submitHandler:function(form){

				var form = document.getElementById("kt_form_1");
				var formData = new FormData(form);

				var fecha_Adscripcion = formData.get("dateAdscripcion");
				var telOficina = formData.get("telOficina");
				var extOficina = formData.get("extOficina");
				var idPuesto = formData.get("puestos_llenados");


				let date = new Date()
				let day = `${(date.getDate())}`.padStart(2,'0');
				let month = `${(date.getMonth()+1)}`.padStart(2,'0');
				let year = date.getFullYear();

				fecha = `${year}-${month}-${day}`;

				
				console.log('obtengo fecha_Adscripcion: ' + fecha_Adscripcion);
				console.log('obtengo telOficina: ' + telOficina);
				console.log('obtengo extOficina: ' + extOficina);
				console.log('obtengo idPuesto: ' + idPuesto);

				//BEGIN::inicia if de fecha de adscripcion
				if(fecha_Adscripcion > fecha){

					console.log('carita triste :(');
					swal.fire('Atención','La fecha de adscripción debe ser menor a la fecha actual','warning');
        			return false;

				} else{

					if(telOficina.length != 10){
						console.log('carita triste este numero de telefono no funciona :(');
						swal.fire('Atención','El número de teléfono debe contener 10 digitos','warning');
					} else{

						if(extOficina.length != 4){
							console.log('carita triste extension invalida:(');
							swal.fire('Atención','El número de extensión debe contener 4 digitos','warning');
						} else{

							console.log('Ejecutando ajax para actualizar datos...');
					
							$.ajaxSetup({
					            headers: {
					                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
					                }
					            });

						    $.ajax({

					                type: "POST",
					        		url: urlcamAdsEst,
					        		data: {fecha_Adscripcion:fecha_Adscripcion, telOficina:telOficina, extOficina:extOficina, idPuesto:idPuesto},
					                dataType: "JSON",
					                success: function(respuesta) {

					                swal.fire("Proceso finalizado",respuesta.message, "success").then(function(){
					                	location.reload();
					                });
					                    
					                },
					                error: function(respuesta_error) {
					                    swal.fire("Error",respuesta_error.error, "error").then(function(){
					                	location.reload();
					                });

					                    return false;
					                }
					            });//END::ajax
							}

						}

					
				    
				    
				}//END::inicia if de fecha de adscripcion

			}

		});

	});


/*

	$(document).ready(function(){

		$('#entes_llenados').on('change',function(){

			$.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

			let idEnte = $(this).val();
			console.log('tengo id ' + idEnte)

			if($.trim(idEnte) == 0 || $.trim(idEnte) == '' || $.trim(idEnte) == null){

				swal.fire('Atención','Seleccione una Unidad Administrativa','warning');

				$('#areas_llenados').empty();
				$('#areas_llenados').append('<option value="0">Seleccione una opción</option>');
				$('#puestos_llenados').empty();
				$('#puestos_llenados').append('<option value="0">Seleccione una opción</option>');


			} else{
					console.log("Busqueda de áreas...");
					$.ajax({
						type:'POST',
						url: urlconsultaUnidades,
        				data:{idEnte:idEnte},
                		dataType: "JSON",
						success: function(response,data){
						console.log(response);
						$('#areas_llenados').empty();
						$('#areas_llenados').append("<option value='0'>Seleccione una opción</option>");
						for(i=0; i<response.length; i++){
							$('#areas_llenados').append("<option value='"+response[i].id+"'>"+response[i].unidad_admin+"</option>");
							}

						}
					});
			}

		});
});

	//consulta puestos
	$(document).ready(function(){

		$('#areas_llenados').on('change',function(){

			$.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });

			let area = $(this).val();
			tipo_contratacion = 'E';
			//tipo_contratacion = document.getElementById("tipo_contratacion").value;
			console.log('obtengo id de unidad ' + area);
			console.log('Tipo de Contratación ' + tipo_contratacion);

			if($.trim(tipo_contratacion) == 0 || $.trim(tipo_contratacion) == '' || $.trim(tipo_contratacion) == null){

				swal.fire('Atención','Seleccione un Tipo de contratación','warning');
				
			}else{

				if($.trim(area) == 0 || $.trim(area) == '' || $.trim(area) == null){

				swal.fire('Atención','Seleccione una Área','warning');

				$('#areas_llenados').empty();
				$('#areas_llenados').append('<option value="0">Seleccione una opción</option>');
				$('#puestos_llenados').empty();
				$('#puestos_llenados').append('<option value="0">Seleccione una opción</option>');


			} else{
					console.log("Busqueda de puestos...");
					$.ajax({
						type:'POST',
						url:urlconsultaPuestos,
        				data:{area:area, tipo_contratacion:tipo_contratacion},
                		dataType: "JSON",
						success: function(response,data){
						console.log(response);


						swal.fire({
        					title: "Buscando Puestos!",
        					text: "La busqueda terminará en segundos.",
        					timer: 5000,
        					timerProgressBar: true,
        					showCloseButton: false,
        					showCancelButton: false,
        					showConfirmButton: false,
        					allowOutsideClick: false,
        					onOpen: function() {
            					//swal.showLoading()
        					}
    					}).then(function(result) {
        					if (result.dismiss === "timer") {
            						console.log("")
        					}
   						 });


						$('#puestos_llenados').empty();
						$('#puestos_llenados').append("<option value='0'>Seleccione una opción</option>");
						for(i=0; i<response.length; i++){
							$('#puestos_llenados').append("<option value='"+response[i].id+"'>"+response[i].puesto_funcional+"</option>");
							}

						}
					});
				}
			}

			

		});
});
*/