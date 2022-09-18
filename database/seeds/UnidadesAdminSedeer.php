<?php

use Keboola\Csv\CsvReader;
use Keboola\Csv\CsvWriter;
use Illuminate\Database\Seeder;
use App\UnidadesAdmin;


class UnidadesAdminSedeer extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=UnidadesAdminSedeer
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/UnidadesAdmin.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new UnidadesAdmin();
            $dependencia->clave_uniadm= ($row[0])?$row[0]:null;
            $dependencia->unidad_admin= $row[1];
            $dependencia->created_at= '2020-10-29 15:46:38';
            $dependencia->updated_at= '2020-10-29 15:46:38';
            $dependencia->logo= ($row[4])?$row[4]:null;
            $dependencia->email= ($row[5])?$row[5]:null;
            $dependencia->telefono= ($row[6])?$row[6]:null;
            $dependencia->calle=    ($row[7])?$row[7]:null;
            $dependencia->num_ext= ($row[8])?$row[8]:null;
            $dependencia->num_int= ($row[9])?$row[9]:null;
            $dependencia->id_asentamiento= ($row[10])?$row[10]:null;
            $dependencia->ext_tel= ($row[11])?$row[11]:null;
            $dependencia->id_ente_publico= $row[12];
            $dependencia->activo= $row[13];
			$dependencia->save();
		}
    }
}
