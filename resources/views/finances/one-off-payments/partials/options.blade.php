<div class="flex">
    <div class="pr-4">
        <x-filter-link href="/finances/payments/one-off">
            All
        </x-filter-link>
    </div>

    <div class="pr-4">
        <x-filter-link href="/finances/payments/one-off/?type=incoming">
            Incoming
        </x-filter-link>
    </div>

    <div class="pr-4">
        <x-filter-link href="/finances/payments/one-off/?type=outgoing">
            Outgoing
        </x-filter-link>
    </div>

    <div class="pr-4">
        <x-category-dropdown path="/finances/payments/one-off" />
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
