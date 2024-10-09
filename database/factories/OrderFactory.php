<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'total'   => $this->faker->randomFloat(2, 20, 500), // 20 dan 500 gacha tasodifiy onlik raqam
            'status'  => $this->faker->randomElement(['pending', 'completed', 'cancelled']), // Status qiymatlari
        ];
    }

}
