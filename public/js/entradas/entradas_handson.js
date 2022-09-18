var url = $('#url').val();
//var contenedor = $('#entradas');

/**********************************************************************/

var dataObject = [
  {
  	id: 1,
    proveedor: 'test',
    folio_prov: 'test',
    origen_recurso: 'test',
    programa: 'test',
    clase_terap: 'test',
    clave: 'test',
    cnis: 'test',
    cantidad_recibida: 'test',
    lote: 'test',
    caducidad: '08/19/2019',
    laboratorio: 'test',
    marca: 'test',
    area_pertenencia: 'test',
    ubicacion: 'test',
    codigo_barras: 'test',
    comentarios: 'test',
    fecha_recepcion: '08/19/2019',
    disponible: 'test'
  }
];

var hotElement = document.querySelector('#entradas');
var hotElementContainer = hotElement.parentNode;
var hotSettings = {
  data: dataObject,
  columns: [
    {
      data: 'id',
      type: 'numeric',
      width: 40,
      readonly: true
    },
    {
      data: 'proveedor',
      type: 'text'
      /*editor: 'select',
      selectOptions: catProveedores*/
    },
    {
      data: 'folio_prov',
      type: 'text'
    },
    {
      data: 'origen_recurso',
      type: 'text'
      /*editor: 'select',
      selectOptions: catalogoOrigenRecurso*/
    },
    {
      data: 'programa',
      type: 'text'
    },
    {
      data: 'clase_terap',
      type: 'text'
    },
    {
      data: 'clave',
      type: 'text'
    },
    {
      data: 'cnis',
      type: 'text'
    },
    {
      data: 'cantidad_recibida',
      type: 'text'
    },
    {
      data: 'lote',
      type: 'text'
    },
    {
      data: 'caducidad',
      type: 'date',
      dateFormat: 'MM/DD/YYYY',
      correctFormat: true,
      datePickerConfig:{
          // First day of the week (0: Sunday, 1: Monday, etc)
          firstDay: 0,
              showWeekNumber: true,
              numberOfMonths: 1,
              disableDayFn: function(date) {
              return date.getDay() === 6 || moment().isAfter(moment(date), 'day');;
          }
      }
    },
    {
      data: 'laboratorio',
      type: 'text'
    },
    {
      data: 'marca',
      type: 'text'
    },
    {
      data: 'area_pertenencia',
      type: 'text'
    },
    {
      data: 'ubicacion',
      type: 'text'
    },
    {
      data: 'codigo_barras',
      type: 'text'
    },
    {
      data: 'comentarios',
      type: 'text'
    },
    {
      data: 'fecha_recepcion',
      type: 'date',
      dateFormat: 'MM/DD/YYYY',
      correctFormat: true,
      datePickerConfig:{
          // First day of the week (0: Sunday, 1: Monday, etc)
          firstDay: 0,
              showWeekNumber: true,
              numberOfMonths: 1,
              disableDayFn: function(date) {
              return date.getDay() === 6 || moment().isAfter(moment(date), 'day');;
          }
      }
    },
    {
      data: 'disponible',
      type: 'text'
    }
  ],
  stretchH: 'all',
  width: 805,
  autoWrapRow: true,
  height: 487,
  maxRows: 22,
  rowHeaders: true,
  colHeaders: [
	'ID',
	'PROVEEDOR',
	'FOLIO PROVEEDOR',
	'ORIGEN RECURSO',
	'PROGRAMA',
	'CLASE TERAPEUTICA',
	'CLAVE SAICA',
	'CLAVE CNIS',
	'CANTIDAD RECIBIDA',
	'LOTE',
	'CADUCIDAD',
	'LABORATORIO',
	'MARCA',
	'ÁREA DE PERTENENCIA',
	'UBICACIÓN',
	'CODIGO DE BARRAS',
	'COMENTARIOS',
	'FECHA RECEPCIÓN',
	'MERCANCÍA DISPONIBLE',
  ],
  rowHeaders: true,
  licenseKey: 'non-commercial-and-evaluation',
  hiddenColumns:{
    columns: [0],
    indicators: true
  },
  fillHandle: {
    direction: 'vertical',
  },
  minSpareRows: 1,
  language: 'en-US',
  beforeChange: (changes, source) => {
  	
  	if(source == 'loadData'){
  		return;
  	}

  	changes.forEach(function (elemento){
  		console.log(elemento);
  		if(elemento[1] == 'cantidad_recibida'){
  			const datosFila = hot.getDataAtRow(elemento[0]);
  			var cantidadValida = parsearCantidad(elemento[3]);
  			elemento[3] = cantidadValida;
  		}
  	});

  },
  afterChange: (change, source) => {  
  	
  	if(source == 'loadData'){
  		return;
  	}

  	change.forEach(function (elemento){
  		console.log(elemento[1]);
  		if(elemento[1] == 'clave'){
  			$.ajax({
  				headers:{
  					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  				},
  				url: url + '/entradas/claveSaica',
  				dataType: 'JSON',
  				type: 'POST',
  				data:{
  					clave: elemento[3]
  				},
  				success: function(response){
  					console.log(response);
  				},
  				error:function(error){
  					console.log(error);
  				}
  			});
  		}else if(elemento[1] == 'cantidad_recibida'){
  			const datosFila= hot.getDataAtRow(elemento[0]);
            var cantidadValida = parsearCantidad(elemento[3]);
            var respuesta = guardar_celda(elemento[1],cantidadValida,datosFila[0]);
            if(respuesta!=0){
              hot.setDataAtCell(elemento[0],0,respuesta);
            }
  		}else{
  			if(elemento[3]!=""){
            	const datosFila = hot.getDataAtRow(elemento[0]);
                var respuesta = guardar_celda(elemento[1],elemento[3],datosFila[0]);
                if(respuesta != 0){
                	hot.setDataAtCell(elemento[0],0,respuesta);
                }
            }
  		}
  	});

  }
};

var hot = new Handsontable(hotElement, hotSettings);

/**********************************************************************/

function parsearCantidad(cantidad){
  const cantidadValida = Number.parseInt(cantidad);
  if (Number.isNaN(cantidadValida)) {
    return 0;
  }
  if(cantidadValida<0){
    return Math.abs(cantidadValida);
  }
  return cantidadValida ;
}

function guardar_celda(col,valor,id){

  var id_entrada="";
  
  $.ajax({
  		headers: {
  			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
    	url: url + '/entradas/guardarCelda',
     	type:"POST",
      	async:false,
      	data:{
       		id: id,
          	col:col,
          	valor:valor
      	},
      	dataType: "json",
      	success: function(response){
      		id_entrada = response;
      	},
      	error: function(error){
      		swal.fire('Mensaje', 'Ocurrio un error', 'error');
      	}
  	});

  return id_entrada;

}