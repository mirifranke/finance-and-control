<?php

namespace Tests\Helpers;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Shop;
use App\Models\User;
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

    public static function buildRegularLedgerPayment(int $amount, bool $endless = true)
    {
        return self::buildPayment(
            accountType: Payment::ACCOUNT_TYPE_LEDGER,
            paymentType: Payment::PAYMENT_TYPE_REGULAR,
            shopId: null,
            title: 'title',
            amount: $amount,
            interval: Payment::INTERVAL_MONTHLY,
            endsAt: $endless ? null : Carbon::now()->addYear()->setTime(0, 0),
        );
    }

    public static function createRegularLedgerPayment()
    {
        $payment = self::buildRegularLedgerPayment(999999, true);
        self::save($payment);

        return $payment;
    }

    public static function buildOneOffLedgerPayment(int $amount)
    {
        return self::buildPayment(
            accountType: Payment::ACCOUNT_TYPE_LEDGER,
            paymentType: Payment::PAYMENT_TYPE_ONE_OFF,
            shopId: null,
            title: 'title',
            amount: $amount,
            interval: Payment::INTERVAL_ONCE
        );
    }

    public static function createOneOffLedgerPayment()
    {
        $payment = self::buildOneOffLedgerPayment(999999);
        self::save($payment);

        return $payment;
    }

    public static function buildBudgetPayment(int $amount)
    {
        $shop = Shop::factory()->create();

        return self::buildPayment(
            accountType: Payment::ACCOUNT_TYPE_BUDGET,
            paymentType: Payment::PAYMENT_TYPE_ONE_OFF,
            shopId: $shop->id,
            title: null,
            amount: $amount,
            interval: Payment::INTERVAL_ONCE
        );
    }

    public static function createBudgetPayment()
    {
        $payment = self::buildBudgetPayment(999999);
        self::save($payment);

        return $payment;
    }

    public static function save(Payment $payment)
    {
        $user = User::factory()->create();

        $payment->creator_id = $user->id;
        $payment->created_at = Carbon::now();
        $payment->updated_at = Carbon::now();
        $payment->save();
    }

    public static function getInput(Payment $expected): array
    {
        return [
            'type' => $expected->payment_type,
            'isDebit' => $expected->isDebit() ? true : false,
            'shop_id' => $expected->shop_id,
            'title' => $expected->title,
            'amount' => $expected->isDebit() ? $expected->amount / (-100) : $expected->amount / 100,
            'category_id' => $expected->category_id,
            'description' => $expected->description,
            'interval' => $expected->interval,
            'starts_at' => $expected->starts_at->toDateString(),
            'ends_at' => $expected->ends_at ? $expected->ends_at->toDateString() : null,
        ];
    }

    public static function getInputWithChanges(
        Payment $expected,
        array $changes
    ) {
        $original = self::getInput($expected, 0);

        return array_merge($original, $changes);
    }
}
