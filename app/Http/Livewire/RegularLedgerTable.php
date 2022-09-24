<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use App\Utilities\Helper;
use Livewire\Component;
use Livewire\WithPagination;

class RegularLedgerTable extends Component
{
    use WithPagination;

    public $active = true;

    public function render()
    {
        $total = Payment::select('amount')
            ->regularLedger()
            ->isActive($this->active)
            ->filter(request(['category', 'type']))
            ->sum('amount');

        $payments = Payment::with('category')
            ->regularLedger()
            ->isActive($this->active)
            ->filter(request(['category', 'type']))
            ->orderBy('created_at', 'DESC')
            ->paginate(Payment::MAX_PER_PAGE);

        return view('livewire.regular-ledger-table', [
            'payments' => $payments,
            'total' => Helper::getAmountForView($total),
        ]);
    }
}