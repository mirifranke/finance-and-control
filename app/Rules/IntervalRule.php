<?php

namespace App\Rules;

use App\Models\Payment;
use Illuminate\Contracts\Validation\Rule;

class IntervalRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        switch ($value) {
            case (Payment::INTERVAL_DAILY):
            case (Payment::INTERVAL_WEEKLY):
            case (Payment::INTERVAL_MONTHLY):
            case (Payment::INTERVAL_QUARTERLY):
            case (Payment::INTERVAL_HALF_YEARLY):
            case (Payment::INTERVAL_YEARLY):
                return true;
            default:
                return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid interval.';
    }
}
