<x-main-finance heading="Regular Payments">
    <x-slot name="options">
        @include('finances.regular-payments.partials.options')
    </x-slot>

    <a href="{{ route('payments.regular.create') }}">
        <x-icon name="add" />
    </a>

    <div class="bg-white dark:bg-gray-900">
        @include('finances.regular-payments.partials.table', $payments)

        <div class="px-6 py-3">
            {{ $payments->links() }}
        </div>
    </div>

    <div class="px-6">
        <div class="font-semibold items-center">
            Total amount: {{ $total }} €
        </div>
    </div>
</x-main-finance>
