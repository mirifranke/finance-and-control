<table class="min-w-fit">
    <tr class="border-b">
        <x-column header>Titel</x-column>
        <x-column header>Betrag</x-column>
        <x-column header>Kategorie</x-column>
        <x-column header>Datum</x-column>
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
