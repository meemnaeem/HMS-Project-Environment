<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'dob' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            // 'home_address' => $this->faker->address,
            'image' => $this->faker->numberBetween(1, 15),
            'registration_no' => $this->faker->numberBetween(0, 1000),
            'registration_date' => $this->faker->date(),
            'age' => $this->faker->numberBetween(1, 100),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'address_1' => $this->faker->address,
            'address_2' => $this->faker->address,
            'description' => $this->faker->text,
            'symptoms' => $this->faker->text,
            'user_id' => User::all()->random()->id,
            'doctor_id' => Doctor::all()->random()->id,
        ];
    }
}
