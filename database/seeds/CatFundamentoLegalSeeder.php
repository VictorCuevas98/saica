<?php
use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\CatFundamentoLegal;

class CatFundamentoLegalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatFundamentoLegalSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/CatFundamentoLegal.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new CatFundamentoLegal();
            $dependencia->clave_fundamento_legal= $row[0];
            $dependencia->fundamento_legal= $row[1];
            $dependencia->activo= $row[2];
            $dependencia->created_at= '2021-07-21 15:49:34';
            $dependencia->updated_at=  null;
			$dependencia->save();
            //campos de control
			// created_by // id
		}
    }
}
