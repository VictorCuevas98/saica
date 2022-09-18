<?php
use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\AdquisicionDocPago;

class AdquisicioneDocPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=AdquisicioneDocPagoSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/AdquisicionDocPago.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new AdquisicionDocPago();
            $dependencia->id_tipo_doc_pago= $row[0];
            $dependencia->num_doc_pago= $row[1];
            $dependencia->monto_subtotal= ($row[2])?$row[2]:null;
            $dependencia->monto_impuesto= ($row[3])?$row[3]:null;
            $dependencia->monto_total= ($row[4])?$row[4]:null;
            $dependencia->id_adquisicion= $row[5];
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
