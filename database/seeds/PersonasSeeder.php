<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\Personas;

class PersonasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PersonasSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/Personas.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new Personas();
            $dependencia->rfc= $row[0];
            $dependencia->nombre=  ($row[1])?$row[1]:null;
            $dependencia->primer_ap= ($row[2])?$row[2]:null;
            $dependencia->segundo_ap= ($row[3])?$row[3]:null;
            $dependencia->created_at= '2021-06-14 16:32:06';
            $dependencia->updated_at=  ($row[5])?$row[5]:null;
            $dependencia->curp= ($row[6])?$row[6]:null;
            $dependencia->telefono= ($row[7])?$row[7]:null;
            $dependencia->email=($row[8])?$row[8]:null;
            $dependencia->activo= $row[9];
            $dependencia->num_empleado= ($row[10])?$row[10]:null;
            $dependencia->genero= ($row[12])?$row[11]:null;
            $dependencia->id_status_persona= $row[12];
			$dependencia->save();
            //campos de control
			// created_by // id
		}
        
    }
}
