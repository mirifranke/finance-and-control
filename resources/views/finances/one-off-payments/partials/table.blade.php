<table>
    <tr class="border-b">
        <x-column header class="whitespace-nowrap w-1/3">Titel</x-column>
        <x-column header class="whitespace-nowrap w-1/3">Betrag</x-column>
        <x-column header class="whitespace-nowrap w-1/3">Kategorie</x-column>
        <x-column header class="whitespace-nowrap w-9/100">Datum</x-column>
        <x-column header class="whitespace-nowrap w-1/100"></x-column>
    </tr>
    @foreach ($payments as $payment)
    <x-row deleteAction="{{ route('payment.destroy', ['id' => $payment->id]) }}">
        <x-column>
            <a href="{{ route('payment.show', $payment) }}">
                {{ $payment->title }}
            </a>
        </x-column>
        <x-column>{{ $payment->getAmountForTable() }}</x-column>
        <x-column>{{ $payment->category->title }}</x-column>
        <x-column>{{ $payment->getStartsAtForUser() }}</x-column>
    </x-row>
    @endforeach
</table>
