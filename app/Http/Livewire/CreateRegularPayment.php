<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Payment;
use App\Rules\IntervalRule;
use App\Utilities\Helper;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Http\Response;

class CreateRegularPayment extends Component
{
    public $title;
    public $amount = 0;
    public $category_id;
    public $description;
    public $interval = Payment::INTERVAL_MONTHLY;
    public $starts_at;
    public $ends_at = null;

    public $isEndless = true;

    public $categories;

    protected $rules = [
        'title' => ['required', 'min:4'],
        'amount' => ['required'],
        'category_id' => ['required'],
        'description' => ['nullable', 'min:4'],
        'interval' => ['required'],
        'starts_at' => ['required', 'date'],
    ];

    public function mount()
    {
        $this->starts_at = Carbon::now()->format('Y-m-d');
        $this->categories = Category::all();
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

        $payment = Payment::create([
            'creator_id' => auth()->id(),
            'type' => Payment::TYPE_REGULAR,
            'title' => $this->title,
            'amount' => Helper::getCents($this->amount),
            'category_id' => $this->category_id,
            'description' => $this->description,
            'interval' => $this->interval,
            'starts_at' => $this->starts_at,
        ]);

        if (!$this->isEndless) {
            $payment->ends_at = $this->ends_at;
            $payment->save();
        }

        session()->flash('success', 'Payment was created successfully.');

        $this->reset();

        return redirect()->route('regular-payments');
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.create-regular-payment')->with(compact('categories'));
    }
}
