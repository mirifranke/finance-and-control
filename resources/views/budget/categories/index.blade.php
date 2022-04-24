<x-main-budget heading="{{ __('Kategorien') }}">
    <a href="{{ route('budget.category.view-create') }}">
        <x-button class="w-full md:w-min">{{ __('Neu') }}</x-button>
    </a>

    @include('budget.categories.partials.table')
</x-main-budget>
