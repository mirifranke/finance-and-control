<x-main-budget heading="Payments">
    <x-slot name="options">
        @include('budget.payments.partials.options')
    </x-slot>

    <a href="{{ route('budget.payments.view-create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('budget.payments.partials.table', $payments)

    {{ $payments->links() }}

    <div class="font-semibold items-center">
        Total amount: {{ $total }} €
    </div>
</x-main-budget>
