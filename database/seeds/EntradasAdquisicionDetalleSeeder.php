<?php

use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\EntradaAdquisicionDetalle;

class EntradasAdquisicionDetalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=EntradasAdquisicionDetalleSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/EntradasAdquisicionDetalle.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new EntradaAdquisicionDetalle();
            $dependencia->id_artmed= $row[0];
            $dependencia->cantidad_unidades= $row[1];
            $dependencia->num_lote= $row[2];
            $dependencia->fecha_caducidad= '2021-08-18 01:23:51';
            $dependencia->id_laboratorio= ($row[4])?$row[4]:null;
            $dependencia->monto_unitario= $row[5];
            $dependencia->monto_subtotal= $row[6];
            $dependencia->monto_impuesto= ($row[7])?$row[7]:null;
            $dependencia->monto_total= ($row[8])?$row[8]:null;
            $dependencia->id_entrada= $row[9];
            $dependencia->activo= $row[10];
            $dependencia->created_at= '2021-08-18 01:23:51';
            $dependencia->updated_at=  '2021-08-18 01:23:51';
			$dependencia->save();
		}
        
    }
}
