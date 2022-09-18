<?php
use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\RegistroRevision;

class RegistroRevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=RegistroRevisionSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/RegistroRevision.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new RegistroRevision();
            $dependencia->id= $row[0];
            $dependencia->status_persona_id= $row[1];
            $dependencia->persona_id= $row[2];
            $dependencia->activo= $row[3];
            $dependencia->created_at= '2019-08-06 17:43:52';
            $dependencia->updated_at=  '2019-08-06 17:43:52';
            $dependencia->deleted_at= ($row[6])?$row[6]:null;
            $dependencia->created_by=  ($row[7])?$row[7]:null;
            $dependencia->updated_by= ($row[8])?$row[8]:null; ;
            $dependencia->deleted_by= null;;            
			$dependencia->save();
		}
    }
}
