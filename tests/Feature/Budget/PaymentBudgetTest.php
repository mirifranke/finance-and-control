<?php

namespace Tests\Feature\Budget;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\Helpers;
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
        $expected = Helpers::buildBudgetPayment(1234);
        $input = Helpers::getInput($expected);

        $this->actingAs($user)->postJson(
            route('budget.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_outgoing_budget_payment()
    {
        $user = User::factory()->create();
        $expected = Helpers::buildBudgetPayment(-4321);
        $input = Helpers::getInput($expected);

        $this->actingAs($user)->postJson(
            route('budget.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_updates_a_budget_payment()
    {
        $user = User::factory()->create();
        $payment = Helpers::createBudgetPayment();
        $input = Helpers::getInputWithChanges($payment, [
            'isDebit' => true,
            'amount' => 25,
            'description' => 'My Updated Description',
        ]);

        $this->actingAs($user)->patchJson(
            route('budget.payment.update', $payment),
            $input
        );

        $actual = Payment::find($payment->id);
        $this->assertEquals(-2500, $actual->amount);
        $this->assertEquals($input['description'], $actual->description);
    }

    /** @test */
    public function it_deletes_a_budget_payment()
    {
        $user = User::factory()->create();
        $payment = Helpers::createBudgetPayment();

        $this->actingAs($user)->deleteJson(
            route('budget.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_create_a_budget_payment()
    {
        $payment = Helpers::buildBudgetPayment(1234);
        $input = Helpers::getInput($payment);

        $this->postJson(
            route('budget.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_update_a_budget_payment()
    {
        $payment = Helpers::createBudgetPayment();
        $input = Helpers::getInputWithChanges($payment, [
            'description' => 'My Updated Description',
        ]);

        $this->patchJson(
            route('budget.payment.update', $payment),
            $input
        );

        $actual = Payment::find($payment->id);
        $this->assertEquals($payment->description, $actual->description);
    }

    /** @test */
    public function an_unauthorized_user_cannot_delete_a_budget_payment()
    {
        $payment = Helpers::createBudgetPayment();

        $this->deleteJson(
            route('budget.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNotNull($actual);
    }
}
