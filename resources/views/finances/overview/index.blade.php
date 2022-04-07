<x-main-finance heading="Overview">
    <div class="flex justify-center items-center py-3 md:pb-3">
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

    <div class="hidden md:flex bg-white dark:bg-gray-900">
        <table class="min-w-full">
            <tr class="border-b">
                <x-column header>Regular Payments</x-column>
                <x-column header></x-column>
                <x-column header>One-Off Payments</x-column>
                <x-column header></x-column>
            </tr>
            <tr>
                <x-column>
                    <a href="{{ route('payments.regular') }}" class="hover:text-blue-500">Incoming</a>
                </x-column>

                <x-column>2.222 €</x-column>

                <x-column>
                    <a href="{{ route('payments.one-off') }}" class="hover:text-blue-500">Incoming</a>
                </x-column>

                <x-column>2.222 €</x-column>
            </tr>
            <tr>
                <x-column>
                    <a href="{{ route('payments.regular') }}" class="hover:text-blue-500">Outgoing</a>
                </x-column>
                <x-column>1.567 €</x-column>

                <x-column>
                    <a href="{{ route('payments.one-off') }}" class="hover:text-blue-500">Outgoing</a>
                </x-column>

                <x-column>1.567 €</x-column>
            </tr>
        </table>
    </div>

    <div class="flex flex-col md:hidden bg-white dark:bg-gray-900 space-y-2">
        <table>
            <tr class="border-b">
                <x-column header>Regular Payments</x-column>
                <x-column header></x-column>
            </tr>
            <tr>
                <x-column>
                    <a href="{{ route('payments.regular') }}" class="hover:text-blue-500">Incoming</a>
                </x-column>

                <x-column>2.222 €</x-column>
            </tr>
            <tr>
                <x-column>
                    <a href="{{ route('payments.regular') }}" class="hover:text-blue-500">Outgoing</a>
                </x-column>

                <x-column>1.567 €</x-column>
            </tr>
        </table>
        <table>
            <tr class="border-b">
                <x-column header>One-Off Payments</x-column>
                <x-column header></x-column>
            </tr>
            <tr>
                <x-column>
                    <a href="{{ route('payments.regular') }}" class="hover:text-blue-500">Incoming</a>
                </x-column>

                <x-column>2.222 €</x-column>
            </tr>
            <tr>
                <x-column>
                    <a href="{{ route('payments.regular') }}" class="hover:text-blue-500">Outgoing</a>
                </x-column>

                <x-column>1.567 €</x-column>
            </tr>
        </table>
    </div>
</x-main-finance>
