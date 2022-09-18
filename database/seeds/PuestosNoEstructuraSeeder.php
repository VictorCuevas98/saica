<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\PuestosNoEstructura;


class PuestosNoEstructuraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=PuestosNoEstructuraSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/PuestosNoEstructura.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new PuestosNoEstructura();
            $dependencia->puesto_funcional= $row[0];
            $dependencia->id_puesto_superior=  ($row[1])?$row[1]:null;
            $dependencia->nivel= ($row[2])?$row[2]:null;
            $dependencia->created_at=  '2021-06-14 17:43:52';
            $dependencia->updated_at=  '2021-06-14 17:43:52';
			$dependencia->save();
            //campos de control
			// created_by // id
		}
    }
}
