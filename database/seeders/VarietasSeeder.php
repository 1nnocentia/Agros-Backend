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
        Varietas::create(['varietas_name' => 'Ciliwung', 'komoditas_id' => 1]);
        Varietas::create(['varietas_name' => 'Ciherang', 'komoditas_id' => 1]);
        Varietas::create(['varietas_name' => 'Inpari 32', 'komoditas_id' => 1]);
        Varietas::create(['varietas_name' => 'Mekongga', 'komoditas_id' => 1]);
        Varietas::create(['varietas_name' => 'IR 64', 'komoditas_id' => 1]);
        Varietas::create(['varietas_name' => 'Way Apo', 'komoditas_id' => 2]);

        Varietas::create(['varietas_name' => 'BISI 2', 'komoditas_id' => 2]);
        Varietas::create(['varietas_name' => 'Srikandi', 'komoditas_id' => 2]);
        Varietas::create(['varietas_name' => 'BISI 18', 'komoditas_id' => 2]);
        Varietas::create(['varietas_name' => 'NK Sumo', 'komoditas_id' => 2]);
    }
}


