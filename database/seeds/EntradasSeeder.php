<?php
use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\Entrada;

class EntradasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=EntradasSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/Entradas.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new Entrada();
            $dependencia->id_tipo_entrada= $row[0];
            $dependencia->folio_entrada= $row[1];
            $dependencia->fecha_entrada= '2021-08-18 01:23:51';
            $dependencia->id_puesto_persona= $row[3];
            $dependencia->id_almacen= $row[4];
            $dependencia->activo= $row[5];
            $dependencia->created_at= '2021-08-18 01:23:51';
            $dependencia->updated_at=  '2021-08-18 01:23:51';
			$dependencia->save();
            //campos de control
			// created_by // id
		}
        # end::dependencias paraestatales
    }
}
