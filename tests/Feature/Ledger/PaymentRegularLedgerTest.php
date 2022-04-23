<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
    public function it_creates_an_outgoing_regular_payment_with_start_and_end_date()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->postJson(
            route('ledger.payment.create'),
            [
                'type' => Payment::PAYMENT_TYPE_REGULAR,
                'isDebit' => '1',
                'title' => 'title',
                'amount' => '1000',
                'category_id' => $category->id,
                'description' => 'description',
                'interval' => Payment::INTERVAL_MONTHLY,
                'starts_at' => Carbon::now()->toDateString(),
                'ends_at' => Carbon::now()->addYear()->toDateString(),
            ]
        );

        $response->dumpHeaders();

        $response->dumpSession();

        $response->dump();

        $this->assertDatabaseCount('payments', 1);
    }
}
