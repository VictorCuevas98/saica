<div class="modal fade" id="exampleModalArticuloNuevo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog   modal-lg">
        <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title">Buscar</h4>
                    <small class="font-bold">&nbsp;</small>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                     @include("entradas.fondoOficina.articulos._articuloNew", ['catLaboratorio'=>$catLaboratorio,'articulo'=>$articulo,'entradaId'=>$entradaId])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                </div>
                
        </div>
    </div>
</div>
{{-- el siguiente es un ejemplo de como se debe de hacer el boton de llamada al modal --}}
{{--
<div class="text-center">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalArticuloNuevo">
        accion
    </button>
</div> --}}