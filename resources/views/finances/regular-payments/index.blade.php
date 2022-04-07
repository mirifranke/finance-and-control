<x-main-finance heading="Regular Payments">
    <x-slot name="options">
        @include('finances.regular-payments.partials.options')
    </x-slot>

    <a href="{{ route('payments.regular.create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('finances.regular-payments.partials.table', $payments)

    {{ $payments->links() }}

    <div class="font-semibold items-center">
        Total amount: {{ $total }} €
    </div>
</x-main-finance>
