<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'patient_id' => Patient::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'date' => $this->faker->date,
            'status' => $this->faker->numberBetween(1, 3),
        ];
    }
}
