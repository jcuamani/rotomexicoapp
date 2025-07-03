<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear el rol si no existe
        $adminRole = Role::firstOrCreate(['name' => 'superadmin']);

        // Crear el usuario
        $user = User::create([
            'name' => 'Super Admin user',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'), // Cambia la contraseña según sea necesario
        ]);

        // Asignar rol al usuario
        $user->assignRole($adminRole);
    }
}
