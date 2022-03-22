<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    public function definition()
    {
        $date1 = $this->faker->dateTimeThisYear();
        $date2 = $this->faker->dateTimeThisYear();

        if ($date1 < $date2) {
            $starts_at = $date1;
            $ends_at = $date2;
        } else {
            $starts_at = $date2;
            $ends_at = $date1;
        }

        return [
            'id' => Str::uuid(),
            'creator_id' => User::factory(),
            'type' => $this->faker->randomElement([Payment::TYPE_REGULAR, Payment::TYPE_ONE_OFF]),
            'title' => $this->faker->word(),
            'amount' => $this->faker->numberBetween($min = 100, $max = 10000),
            'category_id' => $this->faker->randomElement(Category::all()),
            'interval' => $this->faker->randomElement(Payment::INTERVALS),
            'starts_at' => $starts_at->format('Y-m-d H:i:s'),
            'ends_at' => $ends_at->format('Y-m-d H:i:s'),
        ];
    }
}