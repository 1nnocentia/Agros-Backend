<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataTanam>
 */
class DataTanamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lahan_id' => random_int(1, 15),
            'varietas_id' => random_int(1, 10),
            'status_tanam_id' => random_int(1, 3),
            'planting_date' => $this->faker->date(),
        ];
    }
}
