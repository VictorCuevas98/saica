<?php

use App\Personas;
use App\User;
use Illuminate\Database\Seeder;

class CreateUsuariosContratosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=AdministradorCreateUserSeeder
     * @return void
     */
    public function run()
    {
        //Crear a la persona
        $tipoDePersona =
        $adminPersona = Personas::create([
            'rfc'=>'CUGV98122743A',
            'nombre'=>'Antonio',
            'primer_ap'=>'Cruz',
            'segundo_ap'=>'Benigno',
            'curp'=>'CUGV981227HMCVNC04',
            'telefono'=>'5551321250',
            'email'=>'acruz.sedesa@gmail.com',
            'activo'=>true,
            'num_empleado'=>'12345',
            'id_status_persona'=>'P'
        ]);


        //Crear al usuario
        $adminUser = User::create([
            'rfc'=>'CUGV98122743A',
            'password'=>bcrypt('12345678'),
            'activo'=>true,
            'id_persona'=>$adminPersona->id
        ]);

        //crear los roles del administrador
        $adminUser->assignRole('ADMIN');
    }
}
