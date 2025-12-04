<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Lahan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lahan>
 */
class LahanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                $petani = User::where('role_id', 2)->inRandomOrder()->first();
                return $petani ? $petani->id : User::factory()->create(['role_id' => 2])->id;
            },
            'land_area' => $this->faker->randomFloat(2, 0.5, 10),
            'latitude' => $this->faker->latitude(-5, -6),
            'longitude' => $this->faker->longitude(119, 120),
            
        ];
    }
}
