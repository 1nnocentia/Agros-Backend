<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KelompokTani;

class KelompokTaniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KelompokTani::create(['kelompok_tani' => 'Tani Makmur']);

        KelompokTani::factory()->count(5)->create();
    }
}
