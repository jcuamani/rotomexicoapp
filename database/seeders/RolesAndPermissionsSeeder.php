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
