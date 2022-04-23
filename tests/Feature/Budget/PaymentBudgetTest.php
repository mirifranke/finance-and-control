<?php

namespace Tests\Feature\Budget;

use App\Models\Category;
use App\Models\Payment;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentBudgetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authorized_user_can_visit_budget_payments()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/budget/payments');

        $response->assertOk();
    }

    /** @test */
    public function an_unauthorized_user_cannot_visit_budget_payments()
    {
        $response = $this->get('/budget/payments');

        $response->assertRedirect();
    }

    /** @test */
    public function it_creates_an_incoming_budget_payment()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $shop = Shop::factory()->create();

        $expected = new Payment([
            'creator_id' => $user->id,
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
            'shop_id' => $shop->id,
            'title' => null,
            'amount' => 1234,
            'category_id' => $category->id,
            'description' => 'description',
            'interval' => Payment::INTERVAL_ONCE,
            'starts_at' => Carbon::now()->setTime(0, 0),
            'ends_at' => null,
        ]);

        $this->actingAs($user)->postJson(
            route('budget.payment.create'),
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
    public function it_creates_an_outgoing_budget_payment()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $shop = Shop::factory()->create();

        $expected = new Payment([
            'creator_id' => $user->id,
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
            'payment_type' => Payment::PAYMENT_TYPE_ONE_OFF,
            'shop_id' => $shop->id,
            'title' => null,
            'amount' => -4321,
            'category_id' => $category->id,
            'description' => 'description',
            'interval' => Payment::INTERVAL_ONCE,
            'starts_at' => Carbon::now()->setTime(0, 0),
            'ends_at' => null,
        ]);

        $this->actingAs($user)->postJson(
            route('budget.payment.create'),
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
    public function it_updates_a_budget_payment()
    {
        $user = User::factory()->create();
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
        ]);

        $expectedAmount = 1234;
        $expectedDescription = 'description';

        $this->actingAs($user)->patchJson(
            route('budget.payment.update', $payment),
            [
                'type' => $payment->payment_type,
                'isDebit' => 0,
                'shop_id' => $payment->shop_id,
                'title' => null,
                'amount' => $expectedAmount / 100,
                'category_id' => $payment->category_id,
                'description' => $expectedDescription,
                'interval' => $payment->interval,
                'starts_at' => $payment->starts_at->toDateString(),
            ]
        );

        $actual = Payment::find($payment->id);

        $this->assertEquals($expectedAmount, $actual->amount);
        $this->assertEquals($expectedDescription, $actual->description);
    }

    /** @test */
    public function it_deletes_a_budget_payment()
    {
        $user = User::factory()->create();
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET
        ]);

        $this->actingAs($user)->deleteJson(
            route('budget.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_create_a_budget_payment()
    {
        $category = Category::factory()->create();
        $shop = Shop::factory()->create();

        $this->postJson(
            route('budget.payment.create'),
            [
                'type' => Payment::PAYMENT_TYPE_ONE_OFF,
                'isDebit' => 0,
                'shop_id' => $shop->shop_id,
                'title' => null,
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
    public function an_unauthorized_user_cannot_update_a_budget_payment()
    {
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET,
        ]);

        $this->patchJson(
            route('budget.payment.update', $payment),
            [
                'type' => $payment->payment_type,
                'isDebit' => 0,
                'shop_id' => $payment->shop_id,
                'title' => null,
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
    public function an_unauthorized_user_cannot_delete_a_budget_payment()
    {
        $payment = Payment::factory()->create([
            'account_type' => Payment::ACCOUNT_TYPE_BUDGET
        ]);

        $this->deleteJson(
            route('budget.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNotNull($actual);
    }
}
