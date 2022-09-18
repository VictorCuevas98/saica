$(function(){

		$("#kt_form_1").validate({

			rules:{
				entes_llenados:{
					required:true,

				},
				fecha_Adscripcion:{
					required:true,
				}

			},
			messages:{
				entes_llenados:{
					required:"Seleccione una unidad administrativa",
				},

				fecha_Adscripcion:{
					required:"Seleccione fecha de adscripción"
				},

			},

			errorClass: "is-invalid",
        	validClass:"is-valid",

			submitHandler:function(form){

				var form = document.getElementById("kt_form_1");
				var formData = new FormData(form);
				var idEnte = formData.get ("entes_llenados");
				var fecha_Adscripcion = formData.get ("fecha_Adscripcion");

				let date = new Date()
				let day = `${(date.getDate())}`.padStart(2,'0');
				let month = `${(date.getMonth()+1)}`.padStart(2,'0');
				let year = date.getFullYear();

				fecha = `${year}-${month}-${day}`;

				
				console.log('obtengo idEnte: ' + idEnte);
				
				if(fecha_Adscripcion > fecha){

					console.log('carita triste :(');
					swal.fire('Atención','La fecha de adscripción debe ser menor a la fecha actual','warning');
        			return false;

				} else{

					console.log('cargo script y la fecha de adscripción es : ' + fecha_Adscripcion);
					
					$.ajaxSetup({
			            headers: {
			                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
			                }
			            });

				    $.ajax({

			                type: "POST",
			        		url: urlcamAdsNoEst,
			        		data: {idEnte:idEnte, fecha_Adscripcion:fecha_Adscripcion},
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

		});

	});