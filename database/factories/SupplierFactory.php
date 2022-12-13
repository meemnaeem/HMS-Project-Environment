<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber,
            'company' => $this->faker->address,
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement([1,0]),
        ];
    }
}
