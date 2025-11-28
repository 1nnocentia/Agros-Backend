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
        Komoditas::create(['nama_komoditas' => 'Padi']);
        Komoditas::create(['nama_komoditas' => 'Jagung']);
    }
}
