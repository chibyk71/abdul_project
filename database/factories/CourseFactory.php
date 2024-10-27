<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => Department::inRandomOrder()->first()->id, // Retrieve a random existing department
            'level' => $this->faker->randomElement(['100', '200', '300', '400']),
            'course_code' => function (array $attributes) {
                // Find the department based on department_id
                $department = Department::find($attributes['department_id']);
                $abbreviation = strtolower($department->abbr ?? 'GEN'); // Default to 'GEN' if abbreviation is not found
        
                // Extract the first digit of the level
                $level = $attributes['level'][0]; // Get the first digit of level (e.g., '1', '2', '3', '4')
                
                // Generate course_code in the format [abbreviation][level][3 random digits]
                return "{$abbreviation}{$level}" . $this->faker->unique()->numberBetween(10, 99);
            },
            'course_title' => $this->faker->sentence(3), // Generates a course title with 3 words
            'lecturer' => $this->faker->name, // Generates a random lecturer name
        ];
    }
}
