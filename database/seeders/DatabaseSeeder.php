<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UnidadSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(ProveedorSeeder::class);
    }
}
