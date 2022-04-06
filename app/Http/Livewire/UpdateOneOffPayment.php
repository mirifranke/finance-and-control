<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Payment;
use App\Utilities\Helper;
use Illuminate\Http\Response;
use Livewire\Component;

class UpdateOneOffPayment extends Component
{
    public $categories;
    public Payment $payment;
    public $isDebit;
    // public $title;
    public $amount;
    // public $category_id;
    // public $description;
    // public $starts_at;

    protected $rules = [
        'payment.title' => ['required', 'min:4'],
        'amount' => ['required'],
        'payment.category_id' => ['required'],
        'payment.description' => ['nullable', 'min:4'],
        'payment.starts_at' => ['required', 'date'],
    ];

    public function mount()
    {
        $this->categories = Category::all();

        if ($this->payment->amount < 0) {
            $this->isDebit = true;
            $this->amount = $this->payment->amount * (-1);
        } else {
            $this->isDebit = false;
            $this->amount = $this->payment->amount;
        }
        $this->amount = substr_replace($this->amount, ',', -2, 0);

        // $this->title = $payment->title;
        // $this->category_id = $payment->category_id;
        // $this->description = $payment->description;
        // $this->starts_at = $payment->starts_at->toDateString();
    }

    public function setToCredit()
    {
        $this->isDebit = false;
    }

    public function setToDebit()
    {
        $this->isDebit = true;
    }

    public function updatePayment()
    {
        if (!auth()->check()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        // $amountInCents = Helper::getCents($this->amount, $this->isDebit);

        // $this->payment->fill([
        //     'title' => $this->title,
        //     'amount' => $amountInCents,
        //     'category_id' => $this->payment->category_id,
        //     'description' => $this->payment->description,
        //     'interval' => Payment::INTERVAL_ONCE,
        //     'starts_at' => $this->payment->starts_at,
        // ]);
        $this->payment->save();

        session()->flash('success', 'Payment was updated successfully.');

        $this->reset();

        return redirect()->route('payments.one-off');
    }

    public function render()
    {
        return view('livewire.update-one-off-payment');
    }
}
