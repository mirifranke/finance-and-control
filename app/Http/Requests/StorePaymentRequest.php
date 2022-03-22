<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['nullable', 'max:2000'],
            'starts_at' => ['required', 'date'],
            'is_endless' => ['nullable'],
            'ends_at' => ['nullable', 'date'],
            'amount' => ['required', 'numeric', 'min:0', 'not_in:0'],
            'interval' => ['required',  Rule::in(FixCost::getIntervals())],
        ];
    }
}
