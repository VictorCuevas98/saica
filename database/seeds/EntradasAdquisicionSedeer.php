<?php
use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\EntradaAdquisicion;

class EntradasAdquisicionSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=EntradasAdquisicionSedeer
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/EntradasAdquisicion.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new EntradaAdquisicion();
            $dependencia->id= $row[0];
            $dependencia->monto_subtotal= $row[1];
            $dependencia->monto_impuesto= $row[2];
            $dependencia->monto_total= $row[3];
            $dependencia->id_adquisicion_doc_pago= $row[4];
            $dependencia->id_pedido_contrato_abierto= ($row[5])?$row[5]:null;
            $dependencia->activo= $row[6];
            $dependencia->created_at= '2021-08-18 01:23:51';
            $dependencia->updated_at=  '2021-08-18 01:23:51';
			$dependencia->save();
            //campos de control
			// created_by // id
		}
        # end::dependencias paraestatales
    }
}
