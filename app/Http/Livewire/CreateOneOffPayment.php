<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Payment;
use App\Utilities\Helper;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Livewire\Component;

class CreateOneOffPayment extends Component
{
    public $categories;

    public $isDebit = false;

    public $title;
    public $amount = 0;
    public $category_id;
    public $description;
    public $starts_at;

    protected $rules = [
        'title' => ['required', 'min:4'],
        'amount' => ['required'],
        'category_id' => ['required'],
        'description' => ['nullable', 'min:4'],
        'starts_at' => ['required', 'date'],
    ];

    public function mount()
    {
        $this->starts_at = Carbon::now()->format('Y-m-d');
        $this->categories = Category::all();
    }

    public function setToCredit()
    {
        $this->isDebit = false;
    }

    public function setToDebit()
    {
        $this->isDebit = true;
    }

    public function createPayment()
    {
        if (!auth()->check()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $amountInCents = Helper::getCents($this->amount, $this->isDebit);

        Payment::create([
            'creator_id' => auth()->id(),
            'type' => Payment::TYPE_ONE_OFF,
            'title' => $this->title,
            'amount' => $amountInCents,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'interval' => Payment::INTERVAL_ONCE,
            'starts_at' => $this->starts_at,
        ]);

        session()->flash('success', 'Payment was created successfully.');

        $this->reset();

        return redirect()->route('payments.one-off');
    }

    public function render()
    {
        return view('livewire.create-one-off-payment');
    }
}
