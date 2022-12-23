<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Specialist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'about_doctor' => $this->faker->text,
            'charge' => $this->faker->numberBetween(0, 1000),
            'experience' => $this->faker->text,
            'user_id' => User::all()->random()->id,
            'specialist_id' => Specialist::all()->random()->id,
            // 'image' => $this->faker->numberBetween(1, 9),

        ];
    }
}
