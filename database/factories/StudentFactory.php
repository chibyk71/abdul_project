<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'l_name' => $this->faker->lastName,
            'f_name' => $this->faker->firstName,
            'user_id' => User::factory(),
            'email' => function (array $attributes) {
                return User::find($attributes['user_id'])->email;
            },
            'phone' => $this->faker->phoneNumber,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'religion' => $this->faker->randomElement(['Christianity', 'Islam', 'Hinduism', 'Buddhism', 'Atheism', 'Other']),
            'olevel' => $this->faker->randomElement(['WAEC', 'NECO', 'NABTEB', 'GCE']),
            'dob' => $this->faker->date('Y-m-d', '2005-01-01'), // Adjust date range as needed
            'admission_number' => $this->generateAdmissionNumber(),
            'level' => $this->faker->randomElement(['100', '200', '300', '400']),
            'department_id' => Department::inRandomOrder()->first()->id,
        ];
    }

    private function generateAdmissionNumber()
    {
        // Generate a random unique admission number
        // You could change this logic to meet your specific requirements
        $currentYear = now()->year; // Get the current year
        $randomNumber = rand(1000, 9999); // Generate a random 4-digit number

        return 'ADM/' . $currentYear . '/' . $randomNumber;
    }
}
