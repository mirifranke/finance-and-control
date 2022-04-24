<table class="w-full">
    <tr class="border-b">
        <x-column header class="w-33/100 md:w-1/5">{{ __('Geschäft') }}</x-column>
        <x-column header class="w-33/100 md:w-15/100">{{ __('Betrag') }}</x-column>
        <x-column header class="hidden md:table-cell w-1/5">{{ __('Kategorie') }}</x-column>
        <x-column header class="hidden md:table-cell w-3/10">{{ __('Beschreibung') }}</x-column>
        <x-column header class="w-33/100 md:w-13/100">{{ __('Datum') }}</x-column>
        <x-column header class="w-1/100 md:w-2/100"></x-column>
    </tr>

    @foreach ($payments as $payment)
        <x-row deleteAction="{{ route('budget.payment.destroy', ['id' => $payment->id]) }}">
            <x-column>
                <a href="{{ route('budget.payment.view-edit', $payment) }}">
                    {{ $payment->shop->title }}
                </a>
            </x-column>
            <x-column>{{ $payment->getAmountForTable() }}</x-column>
            <x-column class="hidden md:table-cell">{{ $payment->category->title }}</x-column>
            <x-column class="hidden md:table-cell">{{ $payment->description }}</x-column>
            <x-column>{{ $payment->getStartsAtForUser() }}</x-column>
        </x-row>
    @endforeach
</table>
