var url = $('#url').val();

function buscarColonia(){
  if($('#cp').val()!=""){
    $('#alerta').hide();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "/buscarColonia",
        dataType: 'json',
        data: $('#frm_nuevo_almacen').serialize(),       
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