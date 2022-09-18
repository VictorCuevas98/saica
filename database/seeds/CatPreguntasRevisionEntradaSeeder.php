<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\CatPreguntaRevisionEntrada;

class CatPreguntasRevisionEntradaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatPreguntasRevisionEntradaSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/CatPreguntasRevisionEntradas.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new CatPreguntaRevisionEntrada();
            $dependencia->clave_pregunta= $row[0];
            $dependencia->pregunta=  $row[1];
            $dependencia->orden= ($row[2])?$row[2]:null;
            $dependencia->id_tipo_revision= $row[3];
            $dependencia->activo= $row[4];
            $dependencia->created_at= '2021-07-21 01:23:51';
            $dependencia->updated_at=  null;
            

			$dependencia->save();
            //campos de control
			// created_by // id
		}
        # end::dependencias paraestatales
    }
}
