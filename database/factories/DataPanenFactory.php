<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DataTanam;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataPanen>
 */
class DataPanenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'data_tanam_id' => function () {
                $siapPanen = DataTanam::where('status_tanam_id', 2)
                    ->inRandomOrder()
                    ->first();

                return $siapPanen 
                    ? $siapPanen->id 
                    : DataTanam::factory()->create(['status_tanam_id' => 2])->id;
            },
            'harvest_date' => function (array $attributes) {
                    $dataTanam = DataTanam::find($attributes['data_tanam_id']);
                    
                    $tglTanam = Carbon::parse($dataTanam->planting_date);

                    return $tglTanam->addMonths(random_int(3, 4))->format('Y-m-d');
                },
            'yield_weight' => $this->faker->randomFloat(2, 0.1, 100),
            'status_panen_id' => random_int(1, 3)
        ];
    }
}
