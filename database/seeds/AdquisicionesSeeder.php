<?php


use Keboola\Csv\CsvReader;
use Illuminate\Database\Seeder;
use App\Adquisicion;

class AdquisicionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=AdquisicionesSeeder
     * @return void
     */
    public function run()
    {
        $encabezado= 1; //1 = si , 0 = no
        $delimitador =",";

        $fileName= __DIR__. '/cargaDatosSeeder/Adquisiciones.csv';
        
        $csvFile = new CsvReader(
            $fileName,
            $delimiter = $delimitador,
            $enclosure = CsvReader::DEFAULT_ENCLOSURE,
            $escapedBy = CsvReader::DEFAULT_ESCAPED_BY,
            $skipLines = $encabezado //se omite el encabezado de la linea
        );
		foreach($csvFile as $row){
            $dependencia  = new Adquisicion();
            $dependencia->id_tipo_adquisicion= ($row[0])?$row[0]:null;
            $dependencia->num_requisicion= ($row[1])?$row[1]:null;
            $dependencia->id_origen_recurso=  ($row[2])?$row[2]:null;
            $dependencia->fecha_adjudicacion= ($row[3])?$row[3]:null;
            $dependencia->num_oficio_adjudicacion= ($row[4])?$row[4]:null;
            $dependencia->fecha_oficio_adjudicacion= null;
            $dependencia->num_carpeta= ($row[6])?$row[6]:null;
            $dependencia->monto_subtotal= ($row[7])?$row[7]:null;
            $dependencia->monto_impuesto= ($row[8])?$row[8]:null;
            $dependencia->monto_total= ($row[9])?$row[9]:null;
            $dependencia->tiempo_entrega_dias=($row[10])?$row[10]:null;
            $dependencia->fecha_limite_entrega= null;
            $dependencia->id_status_adquisicion= ($row[12])?$row[12]:null;
            $dependencia->id_proveedor= ($row[13])?$row[13]:null;
            $dependencia->id_puesto_persona= ($row[14])?$row[14]:null;
            $dependencia->activo= 't';
            $dependencia->created_at= '2021-08-18 01:23:51';
            $dependencia->updated_at=  '2021-08-18 01:23:51';;
			$dependencia->save();
            
            //campos de control
			// created_by // id
		}
    }
}
