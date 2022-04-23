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

        $payment_type = $this->faker->randomElement([Payment::PAYMENT_TYPE_REGULAR, Payment::PAYMENT_TYPE_ONE_OFF]);

        $account_type = $this->faker->randomElement([Payment::ACCOUNT_TYPE_LEDGER, Payment::ACCOUNT_TYPE_BUDGET]);

        if ($payment_type === Payment::PAYMENT_TYPE_REGULAR) {
            $interval = $this->faker->randomElement(Payment::INTERVALS);
        } else {
            $interval = Payment::INTERVAL_ONCE;
        }

        return [
            'creator_id' => User::factory(),
            'account_type' => $account_type,
            'payment_type' => $payment_type,
            'title' => $this->faker->word(),
            'amount' => $this->faker->numberBetween($min = 100, $max = 10000),
            'category_id' => Category::factory(),
            'interval' => $interval,
            'starts_at' => $starts_at->format('Y-m-d H:i:s'),
            'ends_at' => $ends_at->format('Y-m-d H:i:s'),
        ];
    }
}
