<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\PuestosFuncionalesTemp;


class PuestosFuncionalesTempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *  php artisan db:seed --class=PuestosFuncionalesTempSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/PuestosFuncionalesTemp.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new PuestosFuncionalesTemp();
            $dependencia->id_tipo_contratacion= $row[0];
            $dependencia->puesto_funcional= $row[1];
            $dependencia->id_puesto_superior= ($row[2])?$row[2]:null;
            $dependencia->nivel= ($row[3])?$row[3]:null;
            $dependencia->id_unidad_admin= $row[4];
            $dependencia->activo= ($row[5])?$row[5]:null;
            $dependencia->created_at= '2019-08-06 17:19:58';
            $dependencia->updated_at=  null;
			$dependencia->save();




		}
    }
}
