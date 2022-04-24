<x-main-ledger heading="{{ __('Kategorien') }}">
    <a href="{{ route('ledger.category.view-create') }}">
        <x-button class="w-full md:w-min">{{ __('Neu') }}</x-button>
    </a>

    @include('ledger.categories.partials.table')
</x-main-ledger>
