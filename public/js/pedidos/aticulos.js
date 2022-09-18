
var url = $('#url').val();

function validar(){

    if($('#clave').val() == 0){
        swal.fire('Atención','Debe introducir una clave','warning');
        return $('#clave').focus();
    }
    if($('#cantidad').val() == 0){
        swal.fire('Atención','Debe introducir una cantidad ','warning');
        return $('#cantidad').focus();
    }


    var formData = $('#articulo').serialize();
    save_agregar_articulo(formData);
}
 //action="{{url('pedidosProgramacion/agregarArticulos/guardarArticulos')}}"

function save_agregar_articulo(formData){    

   //console.log(form.serialize());
   //se inicia con el ajax para la funcion guardar 
   $.ajax({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url + '/pedidosProgramacion/agregarArticulos/guardarArticulos',
        dataType: 'json',
        type:'POST',
        data:formData,
        success: function(respuesta){
                if(respuesta.success){
                    swal.fire('Correcto',respuesta.msg,'success');
                    $('#Articulos').DataTable().ajax.reload();
                    articulo.reset();

                }else{
                    swal.fire('Atención',respuesta.msg,'warning');
                }
        },
        error:function(respuesta){
                if(respuesta.success){
                    swal.fire('Error',respuesta.msg,'success');
                }else{
                    swal.fire('Atención',' El articulo ya existe ','warning');
                }
        
        }
   });
}
//no aceptar numeros negativos 
var numero = document.getElementById('numero');

function comprueba(valor){
  if(valor.value < 0){
    valor.value = 1;
  }
}
//tabla Articulos 



