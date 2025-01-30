<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'description' => $this->faker->sentence(3),
            'content' => $this->faker->paragraph(3),
            'source' => $this->faker->word(),
            'category' => $this->faker->word(),
            'url' => $this->faker->url(),
            'image_url' => $this->faker->url(),
            'published_at' => $this->faker->dateTime()
        ];
    }
}
