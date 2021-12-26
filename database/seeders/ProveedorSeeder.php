<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedores')->insert([
            'pvd_doc' => '0',
            'pvd_nombre' => 'Varios',
            'pvd_direccion'	=> '-',
            'pvd_telefono' =>''
        ]);
    }
}
