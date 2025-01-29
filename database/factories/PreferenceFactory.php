<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Preference>
 */
class PreferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => Str::uuid(),
            'sources' => ["Gizmodo.com", "The Verge"],
            'authors' => ['Tom Warren', 'Brittany Vincent','Amanda Krause'],
            'categories' => ['US news', 'Article', 'Books']
        ];
    }
}
