<?php

use Illuminate\Database\Seeder;
use App\CatOrdenGobierno;

class CatOrdenGobiernoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatOrdenGobiernoSeeder
     * @return void
     */
    public function run()
    {
        CatOrdenGobierno::updateOrCreate(
            ['clave_orden_gobierno'=>'L'],[
                'orden_gobierno'=>'LOCAL',
                'activo'=> true
            ]);
        CatOrdenGobierno::updateOrCreate(
            ['clave_orden_gobierno'=>'F'],[
                'orden_gobierno'=>'FEDERAL',
                'activo'=> true
            ]);

    }
}
