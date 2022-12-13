<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
            'description' => $this->faker->text,
            'amount' => $this->faker->numberBetween(10, 5000),
            'status' => $this->faker->randomElement(["Due","Paid"]),
        ];
    }
}
