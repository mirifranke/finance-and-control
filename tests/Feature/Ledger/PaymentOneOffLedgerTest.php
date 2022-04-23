<?php

namespace Tests\Feature\Ledger;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helpers\Helpers;
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
        $expected = Helpers::buildOneOffLedgerPayment(1234);
        $input = Helpers::getInput($expected);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_creates_an_outgoing_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $expected = Helpers::buildOneOffLedgerPayment(-4321);
        $input = Helpers::getInput($expected);

        $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertPaymentsEqual($expected, $actual);
    }

    /** @test */
    public function it_updates_an_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $payment = Helpers::createOneOffLedgerPayment();
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
    public function it_deletes_an_one_off_ledger_payment()
    {
        $user = User::factory()->create();
        $payment = Helpers::createOneOffLedgerPayment();

        $this->actingAs($user)->deleteJson(
            route('ledger.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNull($actual);
    }


    /** @test */
    public function an_unauthorized_user_cannot_create_a_ledger_payment()
    {
        $payment = Helpers::buildOneOffLedgerPayment(1234);
        $input = Helpers::getInput($payment);

        $this->postJson(
            route('ledger.payment.create'),
            $input
        );

        $actual = Payment::first();
        $this->assertNull($actual);
    }

    /** @test */
    public function an_unauthorized_user_cannot_update_a_ledger_payment()
    {
        $payment = Helpers::createOneOffLedgerPayment();
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
    public function an_unauthorized_user_cannot_delete_a_ledger_payment()
    {
        $payment = Helpers::createOneOffLedgerPayment();

        $this->deleteJson(
            route('ledger.payment.destroy', $payment)
        );

        $actual = Payment::find($payment->id);
        $this->assertNotNull($actual);
    }
}
