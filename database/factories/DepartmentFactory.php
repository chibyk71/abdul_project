<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $index = 0;
        $departments = [
            ['department' => 'Computer Science', 'abbr' => 'CSC', 'faculty' => 'Faculty of Science'],
            ['department' => 'Mathematics', 'abbr' => 'MTH', 'faculty' => 'Faculty of Science'],
            ['department' => 'Physics', 'abbr' => 'PHY', 'faculty' => 'Faculty of Science'],
            ['department' => 'Engineering', 'abbr' => 'ENG', 'faculty' => 'Faculty of Engineering'],
            ['department' => 'Economics', 'abbr' => 'ECO', 'faculty' => 'Faculty of Social Sciences'],
        ];

        $selected = $departments[$index] ?? $departments[0];
        $index++;

        return array_merge($selected, [
            'dean' => $this->faker->name,
        ]);
    }
}
