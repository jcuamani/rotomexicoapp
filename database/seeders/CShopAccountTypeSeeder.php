<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CShopAccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            ['clave' => '001', 'descr' => 'Customer', 'estatus' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['clave' => '002', 'descr' => 'Contact', 'estatus' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['clave' => '003', 'descr' => 'Sales Agent', 'estatus' => 1, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('c_shopaccounttype')->insert($data);
    }
}
