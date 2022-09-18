<?php

use Illuminate\Database\Seeder;
use App\Personas;
use App\User;

class AdministradorCreateUserSeeder extends Seeder
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
            //'tipo_persona'=>'F', //persona fisica o moral
            'rfc'=>'ADMINISTRADOR',
            'nombre'=>'administrador',
            'primer_ap'=>'admin',
            'segundo_ap'=>'admin',
            //'razon_social'=>null,
            'curp'=>null,
            'telefono'=>null,
            'email'=>null,
            'id_status_persona' => 'A'
        ]);


        //Crear al usuario
        $adminUser = User::create([
            'rfc'=>'ADMINISTRADOR', 
            'password'=>bcrypt('12345678'),
            'activo'=>true,
            'id_persona'=>$adminPersona->id
        ]);
        
        //crear los roles del administrador 
    }
}
