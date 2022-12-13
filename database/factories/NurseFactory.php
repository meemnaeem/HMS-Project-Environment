<?php

namespace Database\Factories;

use App\Models\Specialist;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nurse>
 */
class NurseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
                'about_nurse' => $this->faker->text,
                'experience' => $this->faker->text,
                'user_id' => User::all()->random()->id,
                'specialist_id' => Specialist::all()->random()->id,
        ];
    }
}
