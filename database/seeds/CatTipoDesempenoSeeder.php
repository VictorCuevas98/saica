<?php

use Illuminate\Database\Seeder;
use App\CatTipoDesempeno;

class CatTipoDesempenoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoDesempenoSeeder
     * @return void
     */
    public function run()
    {
        CatTipoDesempeno::updateOrCreate(
            ['id'=> 'T'],[
                'tipo_desempeno'=>'TITULAR'
            ]);
        CatTipoDesempeno::updateOrCreate(
            ['id'=> 'E'],[
                'tipo_desempeno'=>'ENCARGADO'
            ]);
    }
}








