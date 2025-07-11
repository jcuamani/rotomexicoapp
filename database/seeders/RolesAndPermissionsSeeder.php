<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard.access',
            'dashboard.view',
            'admin.access',            
            'permission.access',
            'permission.view',
            'permission.create',
            'permission.edit',
            'permission.delete',
            'menu.access',
            'menu.view',
            'menu.create',
            'menu.edit',
            'menu.delete',
            'role.access',
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',
            'user.access',
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'role.assign',
            'erpconnection.access',
            'erpconnection.view',
            'erpconnection.create',
            'erpconnection.edit',
            'erpconnection.delete',
            'customer.access',
            'customer_cat.access',
            'customer_cat_shopaccounttype.access',
            'customer_cat_shopaccounttype.view',
            'customer_cat_shopaccounttype.create',
            'customer_cat_shopaccounttype.edit',
            'customer_cat_shopaccounttype.delete',
            'customer_customer.access',
            'customer_customer_customer.access',
            'customer_customer_customer.view',
            'customer_customer_customer.create',
            'customer_customer_customer.edit',
            'customer_customer_customer.delete',            
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $superadmin->givePermissionTo($permissions);
        $admin->givePermissionTo($permissions);
        $user->givePermissionTo(['dashboard.view']);
    }
}
