<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Descomente as linhas abaixo para rodar os seeders de categorias e permissÃƒÂµes
        // $this->call([
        //     CatPermissionSeeder::class,
        //     PermissionSeeder::class,
        // ]);

        $this->call([
            RaffleSeeder::class,
        ]);
    }
}
