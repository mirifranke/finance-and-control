<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use App\Utilities\Helper;
use Livewire\Component;
use Livewire\WithPagination;

class BudgetTable extends Component
{
    use WithPagination;

    public function render()
    {
        $total = Payment::select('amount')
            ->budget()
            ->filter(request(['category', 'type']))
            ->sum('amount');

        $payments = Payment::with('category')
            ->budget()
            ->filter(request(['category', 'type']))
            ->orderBy('starts_at', 'DESC')
            ->paginate(Payment::MAX_PER_PAGE);

        return view('livewire.budget-table', [
            'payments' => $payments,
            'total' => Helper::getAmountForView($total),
        ]);
    }
}