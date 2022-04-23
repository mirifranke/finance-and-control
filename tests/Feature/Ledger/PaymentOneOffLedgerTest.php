<?php

namespace Tests\Feature\Ledger;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentOneOffLedgerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authorized_user_can_visit_ledger_one_off_payments()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/ledger/payments/one-off');

        $response->assertOk();
    }

    /** @test */
    public function an_unauthorized_user_cannot_visit_ledger_one_off_payments()
    {
        $response = $this->get('/ledger/payments/one-off');

        $response->assertRedirect();
    }

    /** @test */
    public function it_creates_an_incoming_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $expected = new Payment([
            'creator_id' => $user->id,
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
            'shop_id' => null,
            'title' => 'title',
            'amount' => 1234,
            'category_id' => $category->id,
            'description' => 'description',
            'interval' => Payment::INTERVAL_ONCE,
            'starts_at' => Carbon::now()->setTime(0, 0),
            'ends_at' => null,
        ]);

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
            ]
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_outgoing_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $expected = new Payment([
            'creator_id' => $user->id,
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
            'shop_id' => null,
            'title' => 'title',
            'amount' => -4321,
            'category_id' => $category->id,
            'description' => 'description',
            'interval' => Payment::INTERVAL_ONCE,
            'starts_at' => Carbon::now()->setTime(0, 0),
            'ends_at' => null,
        ]);

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
            ]
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_updates_an_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
            'title' => 'title',
            'amount' => -2000,
        ]);

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
    public function it_deletes_an_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
        ]);

        $this->actingAs($user)->deleteJson(
            route('ledger.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);

        $this->assertNull($actual);
    }


    /** @test */
    public function an_unauthorized_user_cannot_create_a_ledger_payment()
    {
        $category = Category::factory()->create();

        $this->postJson(
            route('ledger.payment.create'),
            [
                'type' => Payment::PAYMENT_TYPE_ONE_OFF,
                'isDebit' => 0,
                'shop_id' => null,
                'title' => 'title',
                'amount' => 1234,
                'category_id' => $category->category_id,
                'description' => 'description',
                'interval' => Payment::INTERVAL_ONCE,
                'starts_at' => Carbon::now()->setTime(0, 0),
            ]
        );

        $actual = Payment::first();
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_update_a_ledger_payment()
    {
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
        ]);

        $this->patchJson(
            route('ledger.payment.update', $payment),
            [
                'type' => $payment->payment_type,
                'isDebit' => 0,
                'shop_id' => null,
                'title' => 'title',
                'amount' => 1234,
                'category_id' => $payment->category_id,
                'description' => 'description',
                'interval' => $payment->interval,
                'starts_at' => $payment->starts_at->toDateString(),
            ]
        );

        $actual = Payment::find($payment->id);

        $this->assertEquals($payment->amount, $actual->amount);
        $this->assertEquals($payment->description, $actual->description);
    }

    /** @test */
    public function an_unauthorized_user_cannot_delete_a_ledger_payment()
    {
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER
        ]);

        $this->deleteJson(
            route('ledger.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNotNull($actual);
    }
}
