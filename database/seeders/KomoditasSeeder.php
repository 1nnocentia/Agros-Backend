<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Komoditas;

class KomoditasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Komoditas::create(['komoditas_name' => 'Padi']);
        Komoditas::create(['komoditas_name' => 'Jagung']);
    }
}
