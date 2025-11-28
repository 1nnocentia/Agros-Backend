<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Varietas;

class VarietasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Varietas::create(['nama_varietas' => 'Ciliwung', 'komoditas_id' => 1]);
        Varietas::create(['nama_varietas' => 'Ciherang', 'komoditas_id' => 1]);
        Varietas::create(['nama_varietas' => 'Inpari 32', 'komoditas_id' => 1]);
        Varietas::create(['nama_varietas' => 'Mekongga', 'komoditas_id' => 1]);
        Varietas::create(['nama_varietas' => 'IR 64', 'komoditas_id' => 1]);
        Varietas::create(['nama_varietas' => 'Way Apo', 'komoditas_id' => 2]);

        Varietas::create(['nama_varietas' => 'BISI 2', 'komoditas_id' => 2]);
        Varietas::create(['nama_varietas' => 'Srikandi', 'komoditas_id' => 2]);
        Varietas::create(['nama_varietas' => 'BISI 18', 'komoditas_id' => 2]);
        Varietas::create(['nama_varietas' => 'NK Sumo', 'komoditas_id' => 2]);
    }
}


