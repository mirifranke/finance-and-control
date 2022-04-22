<x-main-budget heading="Shops">
    <a href="{{ route('budget.shop.view-create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('budget.shops.partials.table')
</x-main-budget>
