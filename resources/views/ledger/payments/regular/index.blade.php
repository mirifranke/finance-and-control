<x-main-ledger heading="Regular Payments">
    <x-slot name="options">
        @include('ledger.payments.regular.partials.options')
    </x-slot>

    <a href="{{ route('ledger.payments.regular.view-create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('ledger.payments.regular.partials.table', $payments)

    {{ $payments->links() }}

    <div class="font-semibold items-center">
        Total amount: {{ $total }} €
    </div>
</x-main-ledger>
