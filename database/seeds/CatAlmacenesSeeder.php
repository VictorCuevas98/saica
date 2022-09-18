<?php

use Illuminate\Database\Seeder;
use App\CatAlmacen;

class CatAlmacenesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=CatAlmacenesSeeder
     * @return void
     */
    public function run()
    {
        CatAlmacen::updateOrCreate(
            ['clave_almacen'=>'AC'],[
                'almacen'=>'ALMACÉN CENTRAL',
                'domi_calle'=>'CALLE',
                'domi_num_ext'=>'33',
                'domi_num_int'=>'33',
                'id_asentamiento' => 1,
                'activo'=> true
            ]);
    }
}
