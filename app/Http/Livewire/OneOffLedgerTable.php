<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use App\Utilities\Helper;
use Livewire\Component;
use Livewire\WithPagination;

class OneOffLedgerTable extends Component
{
    use WithPagination;

    public $active = true;

    public function render()
    {
        $total = Payment::select('amount')
            ->oneOffLedger()
            ->filter(request(['category', 'type']))
            ->sum('amount');

        $payments = Payment::with('category')
            ->oneOffLedger()
            ->filter(request(['category', 'type']))
            ->orderBy('created_at', 'DESC')
            ->paginate(Payment::MAX_PER_PAGE);

        return view('livewire.one-off-ledger-table', [
            'payments' => $payments,
            'total' => Helper::getAmountForView($total),
        ]);
    }
}