<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => ['required'],
            'isDebit' => ['required'],
            'shop_id' => ['required_if:title,null'],
            'title' => ['required_if:shop_id,null'],
            'amount' => ['required'],
            'category_id' => ['required'],
            'description' => ['nullable'],
            'interval' => ['required'],
            'starts_at' => ['required', 'date'],
            'ends_at' => ['nullable', 'date'],
        ];
    }
}
