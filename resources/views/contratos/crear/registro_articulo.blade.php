@extends('contratos.crear.registro_layout')
@section('contrato')
    <div class="content-wizard" id="tk_tab_wiz_2">
        <form>
            <input type="text" value="{{$contrato->id ?? ''}}" hidden id="hashid-contrato">
            <div class="row d-flex">
                <div class="p-2 flex-grow-1">
                    <div class="d-flex justify-content-around">
                        <div class="p-2 flex-fill"><strong>Fecha: </strong> <br>{{$contrato->fecha_contrato ?? '#'}}
                        </div>
                        <div class="p-2 flex-fill"><strong>Número de contrato: </strong>
                            <div id="numero_contrato_articulo">{{$contrato->num_contrato ?? '#'}}</div>
                        </div>
                        <div class="p-2 flex-fill"><strong>Tipo de
                                contrato: </strong><br>{{$contrato->tipo_contrato ?? '#'}}</div>
                    </div>
                </div>
            </div>

            <div class="my-6"><p style="font-size: 1rem" class="form-text text-muted h3">Artículos</p>
            </div>
            <table class="table table-bordered" id="table-FOC-articulos2">
                <tr>
                    <th class="">Clave</th>
                    <th class="">Cantidad</th>
                    <th class="">Monto</th>
                    <th class="">Unidad de medida</th>
                    <th class="">Descripción</th>
                    <th class="">Acciones</th>
                </tr>

                @if(isset($contratoArtmeds))
                @foreach($contratoArtmeds as $contratoArtmet)
                        <tr>
                            <td class="clave-articulo">{{$contratoArtmet->object->clave_artmed}}</td>
                            <td class="cantidad-articulo">{{$contratoArtmet->cantidad_unidades ?? 'no definida'}}</td><!--cantidad_unidades_minima-->
                            <td class="precio-articulo">{{$contratoArtmet->monto_unitario_fijo ?? $contratoArtmet->monto_unitario}}</td>
                            <td class="unidad-medida-articulo">{{$contratoArtmet->object->unidad_medida}}</td>
                            <td class="descripcion-articulo">{{$contratoArtmet->object->artmed}}</td>
                            <td style="width: 140px;">
                                <button
                                    title="ver detalles"
                                    class="btn btn-sm btn-icon btn-show-contrato" data-show={{$contratoArtmet->hashid}}><i
                                        class="fas fa-arrow-right"></i></button>
                                <button
                                    title="editar"
                                    class="btn btn-sm btn-icon btn-edit-contrato" data-edit={{$contratoArtmet->hashid}}><i
                                        class="far fa-edit"></i></button>
                                <button title="eliminar"
                                        class="btn btn-sm font-weight-bolder art-delete" data-delete={{$contratoArtmet->hashid}}>
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>

            <input type="text" value="{{$contrato->clave_tipo_contrato}}" id="tipo_contrato_art" hidden>

            <div class="modal-footer">
                <input type="button" id="btn-wiz-2" class="btn btn-success nextBtnW"
                       value="Guardar">
            </div>
        </form>
    </div>
@endsection

{{--
<script>
    $(document).ready(function() {
      $("#ok").click(function() {
        var valores = "";

				$(".numero").parent("tr").find("td").each(function() {
        		if($(this).html() != "coger valores de la fila"){
            	 valores += $(this).html() + " ";
            }
        });

        valores = valores + "\n";
        alert(valores);
      });


      $(".boton").click(function() {

        var valores = "";

        // Obtenemos todos los valores contenidos en los <td> de la fila
        // seleccionada
        $(this).parents("tr").find(".numero").each(function() {
          valores += $(this).html() + "\n";
        });
        console.log(valores);
        alert(valores);
      });
    });
  </script>

  <table border="1" cellspacing="0" cellpadding="5" id="tbl">
    <thead>
      <tr>
        <td>Nombre 1</td>
        <td>Nombre 2</td>
        <td>Apellido 1</td>
        <td>Mantenimiento</td>
      </tr>
    </thead>
    <tr>
      <td class="numero">Kevin</td>
      <td>Joseph</td>
      <td>Ramos</td>
      <td class="boton">coger valores de la fila</td>
    </tr>
    <tr>
      <td class="numero">Viviana</td>
      <td>Belen</td>
      <td>Rojas</td>
      <td class="boton">coger valores de la fila</td>
    </tr>
    <tr>
      <td class="numero">Junior</td>
      <td>Gerardo</td>
      <td>Nosé</td>
      <td class="boton">coger valores de la fila</td>
    </tr>
  </table>
  <br>
  <form action="">
    <label for="">Nombre</label>
    <input type="button" value="ok" id="ok" class="boton2">
  </form>
--}}
