<?php
use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\ContratoAbierto;

class ContratosAbiertosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=ContratosAbiertosSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/ContratosAbiertos.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new ContratoAbierto();
            $dependencia->id= $row[0];
            $dependencia->monto_subtotal_minimo= ($row[1])?$row[1]:null;
            $dependencia->monto_impuesto_minimo= ($row[2])?$row[2]:null;
            $dependencia->monto_total_minimo= ($row[3])?$row[3]:null;
            $dependencia->monto_subtotal_maximo= ($row[4])?$row[4]:null;
            $dependencia->monto_impuesto_maximo= ($row[5])?$row[5]:null;
            $dependencia->monto_total_maximo= ($row[6])?$row[6]:null;
            $dependencia->created_at= '2021-08-18 01:23:51';
            $dependencia->updated_at=  '2021-08-18 01:23:51';
            $dependencia->id_tipo_rango= ($row[9])?$row[9]:null;
            $dependencia->recursos_disponibles= 't';
            
			$dependencia->save();
            //campos de control
			// created_by // id
		}


    }
}
