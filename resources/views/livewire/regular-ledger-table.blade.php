<div>
    <div class="relative flex items-start">
        <div class="flex items-center h-5">
            <input wire:model="active" id="active" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
        </div>
        <div class="ml-3 text-sm leading-5">
            <label for="active" class="font-medium text-gray-700">Active</label>
        </div>
    </div>

    <table class="w-full">
        <tr class="border-b">
            <x-column header class="w-33/100 md:w-1/5">{{ __('Titel') }}</x-column>
            <x-column header class="w-33/100 md:w-15/100">{{ __('Betrag') }}</x-column>
            <x-column header class="hidden md:table-cell w-1/5">{{ __('Kategorie') }}</x-column>
            <x-column header class="w-33/100 md:w-15/100">{{ __('Intervall') }}</x-column>
            <x-column header class="hidden md:table-cell w-14/100">{{ __('Startdatum') }}</x-column>
            <x-column header class="hidden md:table-cell w-14/100">{{ __('Enddatum') }}</x-column>
            <x-column header class="w-1/100 md:w-2/100"></x-column>
        </tr>
        @foreach ($payments as $payment)
        <x-row deleteAction="{{ route('ledger.payment.destroy', ['id' => $payment->id]) }}">
            <x-column>
                <a href="{{ route('ledger.payment.view-edit', $payment) }}">
                    {{ $payment->title }}
                </a>
            </x-column>
            <x-column>{{ $payment->getAmountForTable() }}</x-column>
            <x-column class="hidden md:table-cell">{{ $payment->category->title }}</x-column>
            <x-column>{{ $payment->interval }}</x-column>
            <x-column class="hidden md:table-cell">{{ $payment->getStartsAtForUser() }}</x-column>
            <x-column class="hidden md:table-cell">{{ $payment->getEndsAtForUser() }}</x-column>
        </x-row>
        @endforeach
    </table>

    {{ $payments->links() }}

    <div class="font-semibold items-center">
        {{ __('Gesamt') }}: {{ $total }} €
    </div>
</div>
