<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'cli_doc' => '0',
            'cli_nombre' => 'Varios',
            'cli_direccion'	=> '-',
            'cli_telefono' =>'',
            'cli_correo' =>'',
        ]);
    }
}
