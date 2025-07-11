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
        $permission = Menu::create([
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

        $erpconnection = Menu::create([
            'title' => 'ERP connection',
            'route' => 'admin.erpconnection.index',
            'url' => 'erpconnection',
            'icon' => 'ti ti-shield-up',
            'permission' => 'erpconnection.access',
            'parent_id' => $admin->id,
            'order' => 5,
            'enabled' => 1
        ]);
        
        $clientes = Menu::create([
            'title' => 'Clientes',
            'url' => 'customer',
            'icon' => 'ti ti-users-group',
            'permission' => 'customer.access',
            'order' => 3,
            'enabled' => 1
        ]);

        $clientes_cat = Menu::create([
            'title' => 'Catalogos',
            'url' => 'customer_cat',
            'icon' => 'ti ti-users-group',
            'permission' => 'customer_cat.access',
            'parent_id' => $clientes->id,
            'order' => 0,
            'enabled' => 1
        ]);

        $clientes_cat_Shop_Account_Type = Menu::create([
            'title' => 'Shop Account Type',
            'route' => 'customer.cat.shopaccounttype.index',
            'url' => 'customer_cat_shopaccounttype',
            'icon' => 'ti ti-users-group',
            'permission' => 'customer_cat_shopaccounttype.access',
            'parent_id' => $clientes_cat->id,
            'order' => 0,
            'enabled' => 1
        ]);

        $clientes_customers = Menu::create([
            'title' => 'Customers',
            'url' => 'customer_customer',
            'icon' => 'ti ti-users-group',
            'permission' => 'customer_customer.access',
            'parent_id' => $clientes->id,
            'order' => 1,
            'enabled' => 1
        ]);

        $clientes_customers_customers = Menu::create([
            'title' => 'Customers',
            'route' => 'customer.customer.customer.index',
            'url' => 'customer_customer_customer',
            'icon' => 'ti ti-users-group',
            'permission' => 'customer_customer_customer.access',
            'parent_id' => $clientes_customers->id,
            'order' => 0,
            'enabled' => 1
        ]);
        

    }
}
