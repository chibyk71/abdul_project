<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'session' => $this->faker->randomElement(['2023/2024', '2024/2025', '2025/2026']),
            'date' => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d'),
            'course_id' => Course::inRandomOrder()->first()->id,
            'time' => $this->faker->time('H:i'),
            'duration' => $this->faker->numberBetween(1, 3) . ' hours',
            'semester' => $this->faker->randomElement(['1st Semester', '2nd Semester']),
            'level' => $this->faker->randomElement(['100', '200', '300', '400']),
        ];
    }
}
