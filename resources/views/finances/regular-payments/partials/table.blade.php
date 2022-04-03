<table class="min-w-fit">
    <tr class="border-b">
        <x-column header>Titel</x-column>
        <x-column header>Betrag</x-column>
        <x-column header>Kategorie</x-column>
        <x-column header>Intervall</x-column>
        <x-column header>Stardatum</x-column>
        <x-column header>Enddatum</x-column>
    </tr>
    @foreach ($payments as $payment)
        <x-row deleteAction="#">
            <x-column>{{ $payment->title }}</x-column>
            <x-column>{{ $payment->getAmountForUser() }}</x-column>
            <x-column>{{ $payment->category->title }}</x-column>
            <x-column>{{ $payment->interval }}</x-column>
            <x-column>{{ $payment->getStartsAtForUser() }}</x-column>
            <x-column>{{ $payment->getEndsAtForUser() }}</x-column>
        </x-row>
    @endforeach
</table>
