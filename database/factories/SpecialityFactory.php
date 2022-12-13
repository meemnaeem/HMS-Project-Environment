<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Speciality>
 */
class SpecialityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                'name' => $this->faker->name,
                'code' => $this->faker->numberBetween(0, 1000),
                'status' => $this->faker->randomElement([1,0]),
                'image' => $this->faker->numberBetween(1, 5),
       ];
    }
}
