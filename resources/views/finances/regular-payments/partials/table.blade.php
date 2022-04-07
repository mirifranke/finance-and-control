<table>
    <tr class="border-b">
        <x-column header class="whitespace-nowrap w-1/4">Titel</x-column>
        <x-column header class="whitespace-nowrap w-1/4">Betrag</x-column>
        <x-column header class="whitespace-nowrap w-1/4">Kategorie</x-column>
        <x-column header class="whitespace-nowrap w-1/4">Intervall</x-column>
        <x-column header class="whitespace-nowrap w-9/100">Stardatum</x-column>
        <x-column header class="whitespace-nowrap w-9/100">Enddatum</x-column>
        <x-column header class="whitespace-nowrap w-2/100"></x-column>
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
        <x-column>{{ $payment->interval }}</x-column>
        <x-column>{{ $payment->getStartsAtForUser() }}</x-column>
        <x-column>{{ $payment->getEndsAtForUser() }}</x-column>
    </x-row>
    @endforeach
</table>
