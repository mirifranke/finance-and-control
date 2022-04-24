<div class="flex">
    <div class="pr-4">
        <x-filter-link href="/finances/payments/one-off">
            {{ __('Alle') }}
        </x-filter-link>
    </div>

    <div class="pr-4">
        <x-filter-link href="#">
            {{ __('Einnahmen') }}
        </x-filter-link>
    </div>

    <div class="pr-4">
        <x-filter-link href="#">
            {{ __('Ausgaben') }}
        </x-filter-link>
    </div>

    <div class="pr-4">
        <x-category-dropdown path="#" />
    </div>

    {{-- <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <x-dropdown-trigger>Sort By</x-dropdown-trigger>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link href="#">Title</x-dropdown-link>
            <x-dropdown-link href="#">Amount</x-dropdown-link>
            <x-dropdown-link href="#">Category</x-dropdown-link>
        </x-slot>
    </x-dropdown> --}}
</div>
