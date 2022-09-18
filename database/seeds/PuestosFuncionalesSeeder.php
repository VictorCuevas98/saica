<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\PuestosFuncionales;

class PuestosFuncionalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PuestosFuncionalesSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/PuestosFuncionales.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new PuestosFuncionales();
            $dependencia->id_tipo_contratacion= $row[0];
            $dependencia->activo=  $row[1];
            $dependencia->created_at= '2019-08-06 17:43:52';
            $dependencia->updated_at= null;
			$dependencia->save();
            //campos de control
			// created_by // id
		}
        # end::dependencias paraestatales
    }
}
