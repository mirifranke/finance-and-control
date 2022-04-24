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
