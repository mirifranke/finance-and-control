<x-main-budget heading="Categories">
    <a href="{{ route('budget.category.view-create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('budget.categories.partials.table')
</x-main-budget>
