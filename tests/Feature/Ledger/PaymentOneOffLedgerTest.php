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
    public function an_authorized_user_cannot_visit_ledger_one_off_payments()
    {
        $response = $this->get('/ledger/payments/one-off');

        $response->assertRedirect();
    }

    /** @test */
    public function it_creates_an_incoming_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $title = 'title';
        $description = 'description';
        $amount = 10;
        $starts_at = Carbon::now()->setTime(0, 0);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            [
                'type' => Payment::PAYMENT_TYPE_ONE_OFF,
                'isDebit' => 0,
                'title' => $title,
                'amount' => $amount,
                'category_id' => $category->id,
                'description' => $description,
                'interval' => Payment::INTERVAL_ONCE,
                'starts_at' => $starts_at->toDateString(),
            ]
        );

        $this->assertDatabaseHas('payments', [
            'creator_id' => $user->id,
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
            'shop_id' => null,
            'title' => $title,
            'amount' => $amount * 100,
            'category_id' => $category->id,
            'description' => $description,
            'interval' => Payment::INTERVAL_ONCE,
            'starts_at' => $starts_at,
            'ends_at' => null,
        ]);
    }

    /** @test */
    public function it_creates_an_outgoing_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $title = 'title';
        $description = 'description';
        $amount = 10;
        $starts_at = Carbon::now()->setTime(0, 0);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            [
                'type' => Payment::PAYMENT_TYPE_ONE_OFF,
                'isDebit' => '1',
                'title' => $title,
                'amount' => $amount,
                'category_id' => $category->id,
                'description' => $description,
                'interval' => Payment::INTERVAL_ONCE,
                'starts_at' => $starts_at->toDateString(),
            ]
        );

        $this->assertDatabaseHas('payments', [
            'creator_id' => $user->id,
            'account_type' => Payment::ACCOUNT_TYPE_LEDGER,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
            'shop_id' => null,
            'title' => $title,
            'amount' => $amount * (-100),
            'category_id' => $category->id,
            'description' => $description,
            'interval' => Payment::INTERVAL_ONCE,
            'starts_at' => $starts_at,
            'ends_at' => null,
        ]);
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
}
