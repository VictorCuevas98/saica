<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\Contratos;

class ContratosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=ContratosSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/Contrato.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new Contratos();
            $dependencia->id_tipo_contrato= $row[0];
            $dependencia->id_tipo_doc_contrato= $row[1];
            $dependencia->num_contrato= $row[2];
            $dependencia->fecha_contrato= ($row[3])?$row[3]:null;
            $dependencia->id_adquisicion= $row[4];
            $dependencia->validado= $row[5];
            $dependencia->activo= $row[6];
            $dependencia->created_at= '2021-08-16 22:26:24';
            $dependencia->updated_at=  '2021-08-16 22:26:24';
            $dependencia->observaciones=   ($row[9])?$row[9]:null;
			$dependencia->save();
		}
    }
}
