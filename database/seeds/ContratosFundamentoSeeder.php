<?php

use Illuminate\Database\Seeder;
use App\ContratoFundamento;

class ContratosFundamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=ContratosFundamentoSeeder
     * @return void
     */
    public function run()
    {
        ContratoFundamento::updateOrCreate(
            ['id_contrato' =>1,
                'id_fundamento_legal'=> 2,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:34:48',
                'updated_at'=> '2021-08-17 12:34:48'
            ]);   
        ContratoFundamento::updateOrCreate(
            ['id_contrato'=> 2,
                'id_fundamento_legal'=> 1,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:34:48',
                'updated_at'=> '2021-08-17 12:34:48'
            ]);   
        ContratoFundamento::updateOrCreate(
            ['id_contrato'=> 3,
                'id_fundamento_legal'=> 2,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:34:48',
                'updated_at'=> '2021-08-17 12:34:48'
            ]);   
        ContratoFundamento::updateOrCreate(
            ['id_contrato'=> 4,
                'id_fundamento_legal'=> 3,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:34:48',
                'updated_at'=> '2021-08-17 12:34:48'
            ]);   
        ContratoFundamento::updateOrCreate(
            ['id_contrato'=> 5,
                'id_fundamento_legal'=> 2,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:34:48',
                'updated_at'=> '2021-08-17 12:34:48'
            ]);   
        ContratoFundamento::updateOrCreate(
            ['id_contrato'=> 6,
                'id_fundamento_legal'=> 3,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:34:48',
                'updated_at'=> '2021-08-17 12:34:48'
            ]);   
        ContratoFundamento::updateOrCreate(
            ['id_contrato'=> 7,
                'id_fundamento_legal'=> 3,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:34:48',
                'updated_at'=> '2021-08-17 12:34:48'
            ]);   
        ContratoFundamento::updateOrCreate(
            ['id_contrato'=> 8,
                'id_fundamento_legal'=> 2,
                'activo'=> true,
                'created_at'=> '2021-08-17 12:34:48',
                'updated_at'=> '2021-08-17 12:34:48'
            ]);   

    }
}
