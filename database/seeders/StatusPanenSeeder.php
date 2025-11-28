<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StatusPanen;

class StatusPanenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusPanen::create(['status' => 'Pending']);
        StatusPanen::create(['status' => 'Verified']);
        StatusPanen::create(['status' => 'Corrected']);
    }
}
