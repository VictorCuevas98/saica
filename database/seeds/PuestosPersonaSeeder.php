<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\PuestosPersona;


class PuestosPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PuestosPersonaSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/PuestosPersona.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new PuestosPersona();
            $dependencia->created_at= '2021-06-14 17:43:52';
            $dependencia->updated_at=  '2021-06-14 17:43:52';
            $dependencia->id_persona= $row[2];
            $dependencia->id_puesto_funcional= $row[3];
            $dependencia->fecha_inicial= '2021-06-14 17:43:52';
            $dependencia->fecha_termino=  null;
            $dependencia->id_tipo_desempeno= 'T';
			$dependencia->save();
            //campos de control
			// created_by // id
		}
    }
}
