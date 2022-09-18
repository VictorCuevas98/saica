<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\PuestosEstructura;

class PuestosEstructuraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=PuestosEstructuraSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/PuestosEstructura.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new PuestosEstructura();
            $dependencia->id= $row[0];
            $dependencia->puesto_estructura= $row[1];
            $dependencia->id_puesto_superior= ($row[2])?$row[2]:null;
            $dependencia->nivel= $row[3];
            $dependencia->id_unidad_admin= $row[4];
            $dependencia->created_at= '2019-08-06 17:43:52';
            $dependencia->updated_at=  '2019-08-06 17:43:52';
			$dependencia->save();
		}
    }
}
