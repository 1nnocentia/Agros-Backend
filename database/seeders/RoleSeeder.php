<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['nama_role' => 'Admin']);
        Role::create(['nama_role' => 'Petani']);
        Role::create(['nama_role' => 'Bulog']);
        Role::create(['nama_role' => 'Aparat Desa']);
    }
}
