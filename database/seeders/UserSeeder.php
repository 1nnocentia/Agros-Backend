<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'admin_inno',
            'email' => 'inno@admin.com',
            'password' => bcrypt('password1234'),
            'role_id' => 1,
        ]);

        User::factory()->count(10)->create();
    }
}
