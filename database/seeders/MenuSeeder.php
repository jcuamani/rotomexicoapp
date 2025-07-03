<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Menu::truncate(); // limpia tabla si estás en desarrollo

        // Nivel 1
        $dashboard = Menu::create([
            'title' => 'Dashboard',
            'route' => '',
            'url' => 'dashboard',
            'icon' => 'ti ti-layout-grid',
            'permission' => 'dashboard.view',
            'order' => 1,
            'enabled' => 1
        ]);
        
        $dashboardD = Menu::create([
            'title' => 'Dashboard',
            'route' => 'dashboard.dashboard',
            'url' => 'dashboard',
            'icon' => 'ti ti-chart-bar',
            'permission' => 'dashboard.view',
            'parent_id' => $dashboard->id,
            'order' => 1,
            'enabled' => 1
        ]);
        $admin = Menu::create([
            'title' => 'Administración',
            'url' => 'admin',
            'icon' => 'bi bi-gear',
            'permission' => 'admin.access',
            'order' => 2,
            'enabled' => 1
        ]);

        
        // Nivel 2 - hijos de administración
        $menus = Menu::create([
            'title' => 'Permisos',
            'route' => 'admin.permission.index',
            'url' => 'permission',
            'icon' => 'ti ti-jump-rope',
            'permission' => 'permission.access',
            'parent_id' => $admin->id,
            'order' => 1,
            'enabled' => 1
        ]);
        $menus = Menu::create([
            'title' => 'Menús',
            'route' => 'admin.menus.index',
            'url' => 'menus',
            'icon' => 'ti ti-menu-2',
            'permission' => 'menu.access',
            'parent_id' => $admin->id,
            'order' => 2,
            'enabled' => 1
        ]);
        
        $roles = Menu::create([
            'title' => 'Rol',
            'route' => 'admin.rol.index',
            'url' => 'rol',
            'icon' => 'ti ti-jump-rope',
            'permission' => 'role.access',
            'parent_id' => $admin->id,
            'order' => 3,
            'enabled' => 1
        ]);

        $usuarios = Menu::create([
            'title' => 'Usuarios',
            'route' => 'admin.users.index',
            'url' => 'users',
            'icon' => 'ti ti-shield-up',
            'permission' => 'user.access',
            'parent_id' => $admin->id,
            'order' => 4,
            'enabled' => 1
        ]);

        
    }
}
