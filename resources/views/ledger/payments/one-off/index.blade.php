<x-main-ledger heading="One-off Payments">
    <x-slot name="options">
        @include('ledger.payments.one-off.partials.options')
    </x-slot>

    <a href="{{ route('ledger.payments.one-off.view-create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('ledger.payments.one-off.partials.table', $payments)

    {{ $payments->links() }}

    <div class="font-semibold items-center">
        Total amount: {{ $total }} €
    </div>
</x-main-ledger>
