<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Test\Helpers\Helpers;
use Tests\TestCase;

class PaymentRegularLedgerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authorized_user_can_visit_ledger_regular_payments()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/ledger/payments/regular');

        $response->assertOk();
    }

    /** @test */
    public function an_authorized_user_cannot_visit_ledger_regular_payments()
    {
        $response = $this->get('/ledger/payments/regular');

        $response->assertRedirect();
    }

    /** @test */
    public function it_creates_an_incoming_regular_ledger_payment_with_start_and_end_date()
    {
        $user = User::factory()->create();

        $expected = Helpers::buildRegularLedgerPayment(1234, false);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            [
                'type' => $expected->payment_type,
                'isDebit' => 0,
                'shop_id' => $expected->shop_id,
                'title' => $expected->title,
                'amount' => $expected->amount / 100,
                'category_id' => $expected->category_id,
                'description' => $expected->description,
                'interval' => $expected->interval,
                'starts_at' => $expected->starts_at->toDateString(),
                'ends_at' => $expected->ends_at->toDateString(),
            ]
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_incoming_regular_ledger_payment_with_start_date()
    {
        $user = User::factory()->create();

        $expected = Helpers::buildRegularLedgerPayment(1234);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            [
                'type' => $expected->payment_type,
                'isDebit' => 0,
                'shop_id' => $expected->shop_id,
                'title' => $expected->title,
                'amount' => $expected->amount / 100,
                'category_id' => $expected->category_id,
                'description' => $expected->description,
                'interval' => $expected->interval,
                'starts_at' => $expected->starts_at->toDateString(),
                'ends_at' => $expected->ends_at,
            ]
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_outgoing_regular_ledger_payment_with_start_and_end_date()
    {
        $user = User::factory()->create();

        $expected = Helpers::buildRegularLedgerPayment(-4321, false);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            [
                'type' => $expected->payment_type,
                'isDebit' => 1,
                'shop_id' => $expected->shop_id,
                'title' => $expected->title,
                'amount' => $expected->amount / (-100),
                'category_id' => $expected->category_id,
                'description' => $expected->description,
                'interval' => $expected->interval,
                'starts_at' => $expected->starts_at->toDateString(),
                'ends_at' => $expected->ends_at->toDateString(),
            ]
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_outgoing_regular_ledger_payment_with_start_date()
    {
        $user = User::factory()->create();

        $expected = Helpers::buildRegularLedgerPayment(-4321);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            [
                'type' => $expected->payment_type,
                'isDebit' => 1,
                'shop_id' => $expected->shop_id,
                'title' => $expected->title,
                'amount' => $expected->amount / (-100),
                'category_id' => $expected->category_id,
                'description' => $expected->description,
                'interval' => $expected->interval,
                'starts_at' => $expected->starts_at->toDateString(),
                'ends_at' => $expected->ends_at,
            ]
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_updates_a_regular_ledger_payment()
    {
        $user = User::factory()->create();

        $payment = Helpers::createRegularLedgerPayment(-2000);

        $this->actingAs($user)->patchJson(
            route('ledger.payment.update', $payment),
            [
                'type' => $payment->payment_type,
                'isDebit' => $payment->isDebit(),
                'title' => 'updated title',
                'amount' => 15,
                'category_id' => $payment->category->id,
                'description' => $payment->description,
                'interval' => $payment->interval,
                'starts_at' => $payment->starts_at,
            ]
        );

        $actual = Payment::find($payment->id);

        $this->assertNotNull($actual);
        $this->assertEquals('updated title', $actual->title);
        $this->assertEquals(-1500, $actual->amount);
    }

    /** @test */
    public function it_deletes_a_regular_ledger_payment()
    {
        $user = User::factory()->create();
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'payment_type' => Payment::PAYMENT_TYPE_REGULAR,
        ]);

        $this->actingAs($user)->deleteJson(
            route('ledger.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);

        $this->assertNull($actual);
    }
}
