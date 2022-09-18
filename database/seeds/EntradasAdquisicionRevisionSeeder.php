<?php
use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\EntradaAdquisicionRevision;

class EntradasAdquisicionRevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=EntradasAdquisicionRevisionSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/EntradasAdquisicionRevision.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new EntradaAdquisicionRevision();
            $dependencia->id_entrada= $row[0];
            $dependencia->id_pregunta= $row[1];
            $dependencia->respuesta= $row[2];
            $dependencia->id_puesto_persona= ($row[3])?$row[3]:null;
            $dependencia->activo= $row[4];
            $dependencia->created_at= '2021-08-27 17:19:58';
            $dependencia->updated_at=  '2021-08-27 17:19:58';
			$dependencia->save();
		}
        
    }
}
