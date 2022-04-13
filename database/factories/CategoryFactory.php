<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->word();

        return [
            'creator_id' => User::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->sentence(),
        ];
    }
}
