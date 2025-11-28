<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusTanam;

class StatusTanamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusTanam::create(['status' => 'Aktif']);
        StatusTanam::create(['status' => 'Panen']);
        StatusTanam::create(['status' => 'Gagal']);
    }
}
