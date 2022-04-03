<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Payment;
use App\Utilities\Helper;
use Illuminate\Http\Response;
use Livewire\Component;

class UpdateRegularPayment extends Component
{
    public $categories;

    public $payment;

    public $isDebit;

    public $title;
    public $amount;
    public $category_id;
    public $description;
    public $interval;
    public $starts_at;
    public $ends_at;

    public $isEndless = true;

    protected $rules = [
        'title' => ['required', 'min:4'],
        'amount' => ['required'],
        'category_id' => ['required'],
        'description' => ['nullable', 'min:4'],
        'interval' => ['required'],
        'starts_at' => ['required', 'date'],
    ];

    public function mount(Payment $payment)
    {
        $this->categories = Category::all();

        $this->payment = $payment;

        if ($payment->amount < 0) {
            $this->isDebit = true;
            $this->amount = $payment->amount * (-1);
        } else {
            $this->isDebit = false;
            $this->amount = $payment->amount;
        }
        $this->amount = substr_replace($this->amount, ',', -2, 0);

        $this->title = $payment->title;
        $this->category_id = $payment->category_id;
        $this->description = $payment->description;
        $this->interval = $payment->interval;
        $this->starts_at = $payment->starts_at->toDateString();

        if ($payment->ends_at) {
            $this->isEndless = false;
            $this->ends_at = $payment->ends_at->toDateString();
        }
    }

    public function setToCredit()
    {
        $this->isDebit = false;
    }

    public function setToDebit()
    {
        $this->isDebit = true;
    }

    public function toggleIsEndless()
    {
        $this->isEndless = !$this->isEndless;
    }

    public function createPayment()
    {
        if (!auth()->check()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $amountInCents = Helper::getCents($this->amount, $this->isDebit);

        $this->payment->fill([
            'type' => Payment::TYPE_REGULAR,
            'title' => $this->title,
            'amount' => $amountInCents,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'interval' => $this->interval,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->isEndless ? null : $this->ends_at,
        ]);
        $this->payment->save();

        session()->flash('success', 'Payment was updated successfully.');

        $this->reset();

        return redirect()->route('payments.regular');
    }

    public function render()
    {
        return view('livewire.update-regular-payment');
    }
}
