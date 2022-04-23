<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    public function definition()
    {
        return [
            'creator_id' => User::factory(),
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'payment_type' => Payment::PAYMENT_TYPE_REGULAR,
            'shop_id' => Shop::factory(),
            'title' => $this->faker->word(),
            'amount' => $this->faker->numberBetween($min = 100, $max = 10000),
            'category_id' => Category::factory(),
            'interval' => Payment::INTERVAL_MONTHLY,
            'starts_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'ends_at' => Carbon::now()->addYears(5)->format('Y-m-d H:i:s'),
        ];
    }
}
