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
        return [
            'id' => Str::uuid(),
            'creator_id' => User::factory(),
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
        ];
    }
}
