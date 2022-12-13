<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id'  => Patient::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement([1,0]),
            'date' => $this->faker->date()
        ];
    }
}
