<x-main-finance heading="Overview">
    <div class="flex justify-center items-center pb-3">
        <div class="pb-1">
            <x-icon name="arrow-left" />
        </div>

        <div class="text-gray-800 uppercase font-bold text-center px-2">
            März 2022
        </div>

        <div class="pb-1">
            <x-icon name="arrow-right" />
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900">
        <table class="min-w-full">
            <tr class="border-b">
                <x-column header>Regular Payments</x-column>
                <x-column header></x-column>
                <x-column header>One-Off Payments</x-column>
                <x-column header></x-column>
            </tr>
            <tr>
                {{-- TODO: Add Filter --}}
                <x-column>
                    <a href="{{ route('regular-payments') }}" class="hover:text-blue-500">Incoming</a>
                </x-column>
                <x-column>2.222 €</x-column>
                {{-- TODO: Add Filter --}}
                <x-column>
                    <a href="{{ route('one-off-payments') }}" class="hover:text-blue-500">Incoming</a>
                </x-column>
                <x-column>2.222 €</x-column>
            </tr>
            <tr>
                {{-- TODO: Add Filter --}}
                <x-column>
                    <a href="{{ route('regular-payments') }}" class="hover:text-blue-500">Outgoing</a>
                </x-column>
                <x-column>1.567 €</x-column>
                {{-- TODO: Add Filter --}}
                <x-column>
                    <a href="{{ route('one-off-payments') }}" class="hover:text-blue-500">Outgoing</a>
                </x-column>
                <x-column>1.567 €</x-column>
            </tr>
        </table>
    </div>
</x-main-finance>
