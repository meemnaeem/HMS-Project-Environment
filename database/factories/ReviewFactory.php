<?php

namespace Database\Factories;

use App\Models\Doctor;
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
            'doctor_id' => Doctor::all()->random()->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->text,
            'description' => $this->faker->text,
            'like' => $this->faker->randomElement([1, 0]),
            'status' => $this->faker->randomElement([1, 0]),
        ];
    }
}
