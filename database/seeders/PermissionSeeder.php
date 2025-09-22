<?php

namespace Database\Seeders;

use Brediweb\BrediDashboard\Models\CatPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categorias = CatPermission::pluck('name', 'id')->toArray();
        
        // Exemplo de permissões
        //  Permission::updateOrCreate(
        //     ['name' => 'Visualizar categoria'],
        //     ['cat_permission_id' => array_search('Categoria', $categorias)],
        // );
    }
}
