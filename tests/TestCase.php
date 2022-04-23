<?php

namespace Tests;

use App\Models\Payment;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function assertPaymentsEqual(Payment $expected, Payment $actual)
    {
        $this->assertEquals($expected->user_id, $actual->user_id);
        $this->assertEquals($expected->account_type, $actual->account_type);
        $this->assertEquals($expected->payment_type, $actual->payment_type);
        $this->assertEquals($expected->shop_id, $actual->shop_id);
        $this->assertEquals($expected->title, $actual->title);
        $this->assertEquals($expected->amount, $actual->amount);
        $this->assertEquals($expected->category_id, $actual->category_id);
        $this->assertEquals($expected->description, $actual->description);
        $this->assertEquals($expected->interval, $actual->interval);
        $this->assertEquals($expected->starts_at, $actual->starts_at);
        $this->assertEquals($expected->ends_at, $actual->ends_at);
    }
}
