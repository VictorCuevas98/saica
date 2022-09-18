<?php

use Illuminate\Database\Seeder;
use App\CatStatusPersona;

class CatStatusPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=CatStatusPersonaSeeder
     * @return void
     */
    public function run()
    {
        CatStatusPersona::updateOrCreate(
            ['id'=> 'A'],[
                'status_persona'=>'ACTIVO'
            ]);
        CatStatusPersona::updateOrCreate(
            ['id'=> 'P'],[
                'status_persona'=>'PENDIENTE'
            ]);
        CatStatusPersona::updateOrCreate(
            ['id'=> 'C'],[
                'status_persona'=>'CANCELADO'
            ]);
        CatStatusPersona::updateOrCreate(
            ['id'=> 'R'],[
                'status_persona'=>'REVISIÓN'
            ]);
    }
}
