<?php

namespace Tests\Unit\Services;

use App\Models\Payment;
use App\Services\PaymentService;
use Carbon\Carbon;
use Tests\TestCase;
use Tests\Helpers\Helpers;

class PaymentServiceTest extends TestCase
{
    /** @test */
    public function a_lapsed_payment_should_return_0()
    {
        $date = Carbon::now();
        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 2500,
            'interval' => Payment::INTERVAL_MONTHLY,
            'starts_at' => Carbon::now()->subYears(10),
            'ends_at' => Carbon::now()->subMonth(1),
        ]);

        $sut = new PaymentService;

        $this->assertEquals(0, $sut->getAmount($date, $payment));
    }

    /** @test */
    public function a_payment_which_will_begin_in_the_future_should_return_0()
    {
        $date = Carbon::now();
        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 2500,
            'interval' => Payment::INTERVAL_MONTHLY,
            'starts_at' => Carbon::now()->addMonth(),
            'ends_at' => null,
        ]);

        $sut = new PaymentService;

        $this->assertEquals(0, $sut->getAmount($date, $payment));
    }

    /** @test */
    public function a_payment_with_a_yearly_interval_should_return_the_amount_after_a_year()
    {
        $date = Carbon::now();
        $nextYear = Carbon::create($date)->addYear();
        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 2500,
            'interval' => Payment::INTERVAL_YEARLY,
            'starts_at' => $date,
            'ends_at' => null,
        ]);

        $sut = new PaymentService;

        $this->assertEquals(2500, $sut->getAmount($nextYear, $payment));
    }

    /** @test */
    public function a_payment_with_a_yearly_interval_should_return_0_after_a_month()
    {
        $date = Carbon::now();
        $nextMonth = Carbon::create($date)->addMonth();
        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 2500,
            'interval' => Payment::INTERVAL_YEARLY,
            'starts_at' => $date,
            'ends_at' => null,
        ]);

        $sut = new PaymentService;

        $this->assertEquals(0, $sut->getAmount($nextMonth, $payment));
    }

    /** @test */
    public function a_payment_with_a_quarterly_interval_should_return_the_amount_after_a_quarter()
    {
        $date = Carbon::now();
        $quarter1 = Carbon::create($date)->addMonths(3);
        $quarter2 = Carbon::create($quarter1)->addMonths(3);
        $quarter3 = Carbon::create($quarter2)->addMonths(3);
        $quarter4 = Carbon::create($quarter3)->addMonths(3);
        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 3750,
            'interval' => Payment::INTERVAL_QUARTERLY,
            'starts_at' => $date,
            'ends_at' => null,
        ]);

        $sut = new PaymentService;

        $this->assertEquals(3750, $sut->getAmount($quarter1, $payment));
        $this->assertEquals(3750, $sut->getAmount($quarter2, $payment));
        $this->assertEquals(3750, $sut->getAmount($quarter3, $payment));
        $this->assertEquals(3750, $sut->getAmount($quarter4, $payment));
    }

    /** @test */
    public function a_payment_with_a_quarterly_interval_should_return_0_after_a_month()
    {
        $date = Carbon::now();
        $nextMonth = Carbon::create($date)->addMonth();
        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 3750,
            'interval' => Payment::INTERVAL_QUARTERLY,
            'starts_at' => $date,
            'ends_at' => null,
        ]);

        $sut = new PaymentService;

        $this->assertEquals(0, $sut->getAmount($nextMonth, $payment));
    }

    /** @test */
    public function a_payment_with_a_monthly_interval_should_return_the_amount_after_a_month()
    {
        $date = Carbon::now();
        $nextMonth = Carbon::create($date)->addMonth();
        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 33400,
            'interval' => Payment::INTERVAL_MONTHLY,
            'starts_at' => $date,
            'ends_at' => null,
        ]);

        $sut = new PaymentService;

        $this->assertEquals(33400, $sut->getAmount($nextMonth, $payment));
    }

    /** @test */
    public function a_payment_with_a_weekly_interval_should_multiply_the_amount_by_5_fridays()
    {
        // April 2022 => 5 fridays
        $date = Carbon::createFromDate(2022, 4, 1);

        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 15000,
            'interval' => Payment::INTERVAL_WEEKLY,
            'starts_at' => $date,
            'ends_at' => null,
        ]);

        $sut = new PaymentService;

        $this->assertEquals(15000 * 5, $sut->getAmount($date, $payment));
    }

    /** @test */
    public function a_payment_with_a_weekly_interval_should_multiply_the_amount_by_4_fridays()
    {
        // Mai 2022 => 4 fridays
        $date = Carbon::createFromDate(2022, 5, 1);

        $payment = Helpers::buildPaymentWithChanges([
            'amount' => 15000,
            'interval' => Payment::INTERVAL_WEEKLY,
            'starts_at' => $date,
            'ends_at' => null,
        ]);

        $sut = new PaymentService;

        $this->assertEquals(15000 * 4, $sut->getAmount($date, $payment));
    }
}
