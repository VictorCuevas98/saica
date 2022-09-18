<?php

use Illuminate\Database\Seeder;
use App\CatEjerciciosFiscales;

class CatEjerciciosFiscalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatEjerciciosFiscalesSeeder
     * @return void
     */
    public function run()
    {
        CatEjerciciosFiscales::updateOrCreate(
            ['created_at' => '2021-08-24 17:54:26'],[
                'updated_at' => null
            ]);
        CatEjerciciosFiscales::updateOrCreate(
            ['created_at' => '2021-08-24 17:54:27'],[
                'updated_at' => null
            ]);
        CatEjerciciosFiscales::updateOrCreate(
            ['created_at' => '2021-08-24 17:54:28'],[
                'updated_at' => null
            ]);
        CatEjerciciosFiscales::updateOrCreate(
            ['created_at' => '2021-08-24 17:54:29'],[
                'updated_at' => null
            ]);
        CatEjerciciosFiscales::updateOrCreate(
            ['created_at' => '2021-08-24 17:54:30'],[
                'updated_at' => null
            ]);
        CatEjerciciosFiscales::updateOrCreate(
            ['created_at' => '2021-08-24 17:54:31'],[
                'updated_at' => null
            ]);
    }
}
