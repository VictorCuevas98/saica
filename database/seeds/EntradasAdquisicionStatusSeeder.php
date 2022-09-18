<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\EntradaAdquisicionStatus;

class EntradasAdquisicionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=EntradasAdquisicionStatusSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/EntradasAdquisicionStatus.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new EntradaAdquisicionStatus();
            $dependencia->id_entrada= $row[0];
            $dependencia->id_status_entrada= $row[1];
            $dependencia->id_puesto_persona= ($row[2])?$row[2]:null;
            $dependencia->activo= $row[3];
            $dependencia->created_at= '2021-08-27 17:19:58';
            $dependencia->updated_at=  '2021-08-27 17:19:58';
			$dependencia->save();
		}
        
    }
}
