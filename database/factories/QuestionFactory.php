<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'a' => $this->faker->word,
            'b' => $this->faker->word,
            'c' => $this->faker->word,
            'd' => $this->faker->word,
            'answer' => $this->faker->randomElement(['a', 'b', 'c', 'd']),
            'exam_id' => $this->faker->numberBetween(1, 40), // adjust range as needed
        ];
    }
}
