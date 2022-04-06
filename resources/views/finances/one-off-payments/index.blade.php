<x-main-finance heading="One-off Payments">
    <x-slot name="options">
        @include('finances.one-off-payments.partials.options')
    </x-slot>

    <a href="{{ route('payments.one-off.create') }}">
        <x-icon name="add" />
    </a>

    <div class="bg-white dark:bg-gray-900">
        @include('finances.one-off-payments.partials.table')
    </div>

    <div class="py-3 px-6">
        <div class="font-semibold items-center">
            One-Off Payments: 3.6782 €
        </div>
    </div>
</x-main-finance>
