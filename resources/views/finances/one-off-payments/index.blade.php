<x-main-finance heading="One-off Payments">
    <x-slot name="options">
        @include('finances.one-off-payments.partials.options')
    </x-slot>

    <a href="{{ route('payments.one-off.create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('finances.one-off-payments.partials.table', $payments)

    {{ $payments->links() }}

    <div class="font-semibold items-center">
        Total amount: {{ $total }} €
    </div>
</x-main-finance>
