<?php

namespace Database\Seeders;

use Brediweb\BrediDashboard\Models\CatPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatPermissionSeeder extends Seeder
{
    public function run()
    {
        CatPermission::updateOrCreate(
            ['name' => 'Usuário'],
        );

        CatPermission::updateOrCreate(
            ['name' => 'Config'],
        );
    }
}
