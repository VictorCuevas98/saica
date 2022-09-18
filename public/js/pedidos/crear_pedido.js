var url = $('#url').val();


$('#tipo_contrato').select2();
$('#periodo').select2();
$('#solicita').select2();
$('#partida').select2();
$('#UnidadAdministrativa').select2();
$('#Cargo').select2();
function crearPedido(){

	if($('#fec_env_sol').val() == null || $('#fec_env_sol').val() == ''){
		swal.fire('Atención','Debe colocar la fecha de envio de solicitud','warning');
		return $('#fec_env_sol').focus();
	}

	if($('#tipo_contrato').val() == 0){
		swal.fire('Atención','Debe seleccionar un tipo de pedido','warning');
		return $('#tipo_contrato').focus();
		
	}
	if($('#periodo').val() == 0){
		swal.fire('Atención','Debe seleccionar un tipo de pedido','warning');
		return $('#periodo').focus();
		
	}
	if($('#partida').val() == 0){
		swal.fire('Atención','Debe seleccionar una partida presupuestal','warning');
		return $('#tipo_contrato').focus();
	}
	if($('#solicita').val() == 0){
		swal.fire('Atención','Debe seleccionar un sitio','warning');
		return $('#solicita').focus();
	}
	if($('#UnidadAdministrativa').val() == 0){
		swal.fire('Atención','Debe ingresar una unidad administrativa','warning');
		return $('#UnidadAdministrativa').focus();
	}
	if($('#responsable').val() == 0){
		swal.fire('Atención','Debe ingresar un responsable ','warning');
		return $('#responsable').focus();
	}
	if($('#Cargo').val() == 0){
		swal.fire('Atención','Debe ingresar un cargo ','warning');
		return $('#Cargo').focus();
	}

	var formData = $('#form_pedido').serialize();
	guardarPedido(formData);	
} 
//action="{{url('pedidosProgramacion/guardar')}} 
/*function guardarPedido(formData){
	$.ajax({
		success: function(response){
 swal.fire("Proceso  correcto!", "Se creo correctamente","success");
 window.location ="pedidosProgramacion/agregarArticulos"
		},
		error: function(error){
			
		}
	});
}*/

function guardarPedido(formData){
	
	$.ajax({
			headers:{
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url:url + '/pedidosProgramacion/guardar',
      dataType: 'json',
      type:'POST',
      data:formData,
			success: function(response){
				if(response.success){
					swal.fire('Correcto',response.msg,'success').then((result) =>{
						if(result.value){
							window.location = url+"/pedidosProgramacion/agregarArticulos";
						}
					});
				}else{
					swal.fire('Atención', response.msg,'warning');
				}
			},
			error: function(error){
				
			}
	});
	//'pedidosProgramacion/guardar'
}

$("#inlineRadio2").change(function() {
      if($("#inlineRadio2").val() !== "0"){
     
        $('#periodo').prop('disabled', true);
      }else{
       
        $('#periodo').prop('disabled', false);
        
      }
    });

$("#inlineRadio1").change(function() {
      if($("#inlineRadio1").val() !== "0"){
     
        $('#periodo').prop('disabled', false);
      }else{
       
        $('#periodo').prop('disabled', true);
        
      }
    });

$(function(){
	$('#UnidadAdministrativa').on('change',onSelectCargo);
});
function onSelectCargo(){
	var id_unidad_admin = $(this).val();
	
	$.get(url + '/pedidosProgramacion/'+id_unidad_admin+'/cargo',function(data){
		var cargo_select ='<option value="">Seleccione una opción</option>';
for( var i=0; i<data.length; ++i)
cargo_select +='<option value="'+data[i].id+'">'+data[i].puesto_funcional+'</option>'

$('#Cargo').html(cargo_select);

	});
}

