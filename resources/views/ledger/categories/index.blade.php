<x-main-ledger heading="Categories">
    <a href="{{ route('ledger.category.view-create') }}">
        <x-button class="w-full md:w-min">Create</x-button>
    </a>

    @include('ledger.categories.partials.table')
</x-main-ledger>
