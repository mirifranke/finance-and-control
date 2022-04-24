<x-main-budget heading="{{ __('Zahlungen') }}">
    <x-slot name="options">
        @include('budget.payments.partials.options')
    </x-slot>

    <a href="{{ route('budget.payments.view-create') }}">
        <x-button class="w-full md:w-min">{{ __('Neu') }}</x-button>
    </a>

    @include('budget.payments.partials.table', $payments)

    {{ $payments->links() }}

    <div class="font-semibold items-center">
        {{ __('Gesamt') }}: {{ $total }} €
    </div>
</x-main-budget>
