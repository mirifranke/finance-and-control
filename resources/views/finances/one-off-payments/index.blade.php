<x-main-finance heading="One-off Payments">
    <x-slot name="options">
        @include('finances.one-off-payments.partials.options')
    </x-slot>

    <div class="bg-white dark:bg-gray-900">
        @include('finances.one-off-payments.partials.table')
    </div>
</x-main-finance>
