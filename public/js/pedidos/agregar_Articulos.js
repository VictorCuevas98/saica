var url = $('#url').val();
"use strict";

$(document).ready(function() {
    $('.js-single-boxes').select2();
});



    
$(document).ready(function() {
    var tablaArticulos=$("#Articulos").DataTable({

 "language": {
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
            "url": url + "/pedidosProgramacion/agregarArticulos/tabaArticulo",
            "type": "GET"

        },
        columns:[
        {data:'clave_artmed',name:'clave_artmed'},
        {data:'cantidad_unidades_solicitada',name:'cantidad_unidades_solicitada'},
        {data:'artmed',name:'artmed'},
        {
                "mRender": function (data, type, row) {
                    var id = "'"+row.id+"'";
                    return '<button style="border: none; width: 34px;" data-toggle="modal"data-target="#editar_articulo_modal"class="btn btn-sm btn-clean btn-icon btn-edit" title="Editar" ><i class="far fa-edit"></i></button><button class="btn btn-sm btn-clean btn-icon" title="Eliminar"><i class="far fa-trash-alt "></i></button>';
                }
            }
        ]

    });
GetData('#Articulos',tablaArticulos);
});
function GetData(tbody,tablaArticulos){
    //editar Articulo
    $(tbody).on('click','.btn-edit',function(){
        var objArticulo = tablaArticulos.row($(this).parents('tr')).data();
        $("#id1").val(objArticulo.id); 
        $("#clave1").val(objArticulo.clave_artmed);
        $("#Cantidad1").val(objArticulo.cantidad_unidades_solicitada);
    });
}

//enviar la información al controller
$("#btneditar").click(function(e){
  e.preventDefault();
  updateDataAjax();
});

function updateDataAjax(){
    alert("hola");  
    var obj = JSON.stringify({ id: $("#id1").val(),clave_artmed: $("#clave1").val(),cantidad_unidades_solicitada: $("#Cantidad1").val() });
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url:url+"/pedidosProgramacion/agregarArticulos/editarArticulo",
        data: objArticulo,
        dataType:"json",
        contentType: "application/json; charset=utf-8",
        error:function(xht,ajaxOptions,throwError){
            console.log(xhr,status +"\n"+xhr.responseText,"\n"+throwError);
        },
        success: function(response){
                if(response.success){
                    swal.fire('Correcto',response.msg,'success')
                    $('#Articulos').DataTable().ajax.reload();
                }else{
                    swal.fire('Atención', response.msg,'warning');
                }
            },
            error: function(error){
                console.log(error);
            }
    });
    
}

function confirm_elimination(id){

  $.ajax({ 

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        "url": url + "pedidosProgramacion/agregarArticulos/eliminar",
        type:"POST",
        dataType:"json",
        data:{
            id:id    
        },
        success: function(resp_success){
            swal.fire('articulo eliminado correctamente',"success");
        },
        error:function(error){
            swal.fire('¡Alerta',error,'warning');
           
        }
  }); 
         }

    





function Formato_pedido(){


    var respuesta=confirm("estas seguro? se enviaran los datos al formulario");
if (respuesta==true){ 
 return  true;

}
else{
    return false;
}
}
