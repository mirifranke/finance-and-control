<x-main-finance heading="Categories">
    <a href="{{ route('category.view-create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('finances.categories.partials.table')
</x-main-finance>
