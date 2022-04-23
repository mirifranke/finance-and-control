<?php

namespace Tests\Feature;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\Helpers;
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
        $input = Helpers::getInput($expected);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_incoming_regular_ledger_payment_with_start_date()
    {
        $user = User::factory()->create();
        $expected = Helpers::buildRegularLedgerPayment(1234);
        $input = Helpers::getInput($expected);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_outgoing_regular_ledger_payment_with_start_and_end_date()
    {
        $user = User::factory()->create();
        $expected = Helpers::buildRegularLedgerPayment(-4321, false);
        $input = Helpers::getInput($expected);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_outgoing_regular_ledger_payment_with_start_date()
    {
        $user = User::factory()->create();
        $expected = Helpers::buildRegularLedgerPayment(-4321);
        $input = Helpers::getInput($expected);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_updates_a_regular_ledger_payment()
    {
        $user = User::factory()->create();
        $payment = Helpers::createRegularLedgerPayment();
        $input = Helpers::getInputWithChanges($payment, [
            'isDebit' => true,
            'amount' => 25,
            'description' => 'My Updated Description',
        ]);

        $this->actingAs($user)->patchJson(
            route('ledger.payment.update', $payment),
            $input
        );

        $actual = Payment::find($payment->id);
        $this->assertEquals(-2500, $actual->amount);
        $this->assertEquals($input['description'], $actual->description);
    }

    /** @test */
    public function it_deletes_a_regular_ledger_payment()
    {
        $user = User::factory()->create();
        $payment = Helpers::createRegularLedgerPayment();

        $this->actingAs($user)->deleteJson(
            route('ledger.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNull($actual);
    }


    /** @test */
    public function an_unauthorized_user_cannot_create_a_regular_ledger_payment()
    {
        $payment = Helpers::buildRegularLedgerPayment(1234);
        $input = Helpers::getInput($payment);

        $this->postJson(
            route('ledger.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_update_a_regular_ledger_payment()
    {
        $payment = Helpers::createRegularLedgerPayment();
        $input = Helpers::getInputWithChanges($payment, [
            'description' => 'My Updated Description',
        ]);

        $this->patchJson(
            route('ledger.payment.update', $payment),
            $input
        );

        $actual = Payment::find($payment->id);

        $this->assertEquals($payment->amount, $actual->amount);
        $this->assertEquals($payment->description, $actual->description);
    }

    /** @test */
    public function an_unauthorized_user_cannot_delete_a_regular_ledger_payment()
    {
        $payment = Helpers::createRegularLedgerPayment();

        $this->deleteJson(
            route('ledger.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNotNull($actual);
    }
}
