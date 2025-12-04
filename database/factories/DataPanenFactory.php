<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'data_tanam_id' => random_int(1, 20),
            'harvest_date' => $this->faker->date(),
            'yield_weight' => $this->faker->randomFloat(2, 0.1, 100),
            'status_panen_id' => random_int(1, 3)
        ];
    }
}
