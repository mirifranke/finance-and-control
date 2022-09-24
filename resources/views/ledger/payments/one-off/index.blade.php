<x-main-ledger heading="{{ __('Einmalige Zahlungen') }}">
    <x-slot name="options">
        @include('ledger.payments.one-off.partials.options')
    </x-slot>

    <a href="{{ route('ledger.payments.one-off.view-create') }}">
        <x-button class="w-full md:w-min">{{ __('Neu') }}</x-button>
    </a>

    @livewire('one-off-ledger-table')
</x-main-ledger>
