<?php

use Illuminate\Database\Seeder;
use App\CatTipoRevision;

class CatTipoRevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=CatTipoRevisionSeeder
     * @return void
     */
    public function run()
    {
        CatTipoRevision::updateOrCreate(
            ['clave_tipo_revision'=> 'D'],[
                'tipo_revision'=>'DOCUMENTAL',
                'activo'=> true
            ]);
        CatTipoRevision::updateOrCreate(
            ['clave_tipo_revision'=> 'F'],[
                'tipo_revision'=>'FÍSICA',
                'activo'=> true
            ]);
    }
}
