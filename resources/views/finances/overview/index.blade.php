<x-main-finance heading="Overview">
    <div class="flex justify-center items-center py-3 md:pb-3">
        <div class="pb-1">
            <a href="{{ route('finances', ['date' => $lastMonth]) }}">
                <x-icon name="arrow-left" />
            </a>
        </div>

        <div class="text-gray-800 uppercase font-bold text-center px-2">
            {{ $currentDate->monthName . ' ' . $currentDate->year }}
        </div>

        <div class="pb-1">
            <a href="{{ route('finances', ['date' => $nextMonth]) }}">
                <x-icon name="arrow-right" />
            </a>
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
                    <div class="hover:text-blue-500">Incoming</div>
                </x-column>

                <x-column class="text-right pr-3">{{ $regularCredit }} €</x-column>

                <x-column>
                    <div class="hover:text-blue-500">Incoming</div>
                </x-column>

                <x-column class="text-right pr-3">{{ $regularDebit }} €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Outgoing</div>
                </x-column>
                <x-column class="text-right pr-3">{{ $oneOffCredit }} €</x-column>

                <x-column>
                    <div class="hover:text-blue-500">Outgoing</div>
                </x-column>

                <x-column class="text-right pr-3">{{ $oneOffDebit }} €</x-column>
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
                    <div class="hover:text-blue-500">Incoming</div>
                </x-column>

                <x-column class="text-right">{{ $regularCredit }} €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Outgoing</div>
                </x-column>

                <x-column class="text-right">{{ $regularDebit }} €</x-column>
            </tr>
        </table>
        <table>
            <tr class="border-b">
                <x-column header>One-Off Payments</x-column>
                <x-column header></x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Incoming</div>
                </x-column>

                <x-column class="text-right">{{ $oneOffCredit }} €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Outgoing</div>
                </x-column>

                <x-column class="text-right">{{ $oneOffDebit }} €</x-column>
            </tr>
        </table>
    </div>
</x-main-finance>
