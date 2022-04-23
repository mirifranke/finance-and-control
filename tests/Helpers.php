<?php

namespace Test\Helpers;

use App\Models\Category;
use App\Models\Payment;
use Carbon\Carbon;

class Helpers
{
    public static function buildPayment(
        string $accountType,
        string $paymentType,
        int $shopId = null,
        string $title = null,
        int $amount,
        string $interval,
        Carbon $endsAt = null
    ) {
        $category = Category::factory()->create();
        $description = 'description';
        $startsAt = Carbon::now()->setTime(0, 0);

        return new Payment([
            'account_type' => $accountType,
            'payment_type' => $paymentType,
            'shop_id' => $shopId,
            'title' => $title,
            'amount' => $amount,
            'category_id' => $category->id,
            'description' => $description,
            'interval' => $interval,
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
        ]);
    }

    public static function buildRegularLedgerPayment(int $amount)
    {
        return self::buildPayment(
            accountType: Payment::ACCOUNT_TYPE_LEDGER,
            paymentType: Payment::PAYMENT_TYPE_REGULAR,
            title: 'title',
            amount: $amount,
            interval: Payment::INTERVAL_MONTHLY,
            endsAt: Carbon::now()->addYear()->setTime(0, 0)
        );
    }

    public static function buildOneOffLedgerPayment(int $amount)
    {
        return self::buildPayment(
            accountType: Payment::ACCOUNT_TYPE_LEDGER,
            paymentType: Payment::PAYMENT_TYPE_ONE_OFF,
            title: 'title',
            amount: $amount,
            interval: Payment::INTERVAL_ONCE
        );
    }

    public static function buildBudgetPayment(int $amount)
    {
        return self::buildPayment(
            accountType: Payment::ACCOUNT_TYPE_BUDGET,
            paymentType: Payment::PAYMENT_TYPE_ONE_OFF,
            title: 'title',
            amount: $amount,
            interval: Payment::INTERVAL_ONCE
        );
    }
}
