<x-main-budget heading="{{ __('Geschäfte') }}">
    <a href="{{ route('budget.shop.view-create') }}">
        <x-button class="w-full md:w-min">{{ __('Neu') }}</x-button>
    </a>

    @include('budget.shops.partials.table')
</x-main-budget>
