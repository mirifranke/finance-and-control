<x-main-ledger heading="{{ __('Übersicht') }}">
    <div class="flex justify-center items-center py-3 md:pb-3">
        <div class="pb-1">
            <a href="{{ route('ledger.overview', ['date' => $lastMonth]) }}">
                <x-icon name="arrow-left" />
            </a>
        </div>

        <div class="text-gray-800 uppercase font-bold text-center px-2">
            {{ $currentDate->monthName . ' ' . $currentDate->year }}
        </div>

        <div class="pb-1">
            <a href="{{ route('ledger.overview', ['date' => $nextMonth]) }}">
                <x-icon name="arrow-right" />
            </a>
        </div>
    </div>

    <div class="hidden md:flex bg-white dark:bg-gray-900">
        <table class="min-w-full">
            <tr class="border-b">
                <x-column header>{{ __('Regelmäßige Zahlungen') }}</x-column>
                <x-column
                    header
                    class="text-right pr-5
                        {{ $totalRegular >= 0 ? 'text-green-600' : 'text-red-600' }}"
                    >
                    {{ $totalRegular }} €
                </x-column>
                <x-column header>{{ __('Einmalige Zahlungen') }}</x-column>
                <x-column
                    header
                    class="text-right pr-5
                        {{ $totalOneOff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $totalOneOff }} €
                </x-column>
            </tr>
            <tr>
                <x-column>{{ __('Einnahmen') }}</x-column>

                <x-column class="text-right pr-5">
                    {{ $regularCredit }} €
                </x-column>

                <x-column>{{ __('Einnahmen') }}</x-column>

                <x-column class="text-right pr-5">
                    {{ $oneOffCredit }} €
                </x-column>
            </tr>
            <tr>
                <x-column>{{ __('Ausgaben') }}</x-column>

                <x-column class="text-right pr-5">
                    {{ $regularDebit }} €
                </x-column>

                <x-column>{{ __('Ausgaben') }}</x-column>

                <x-column class="text-right pr-5">
                    {{ $oneOffDebit }} €
                </x-column>
            </tr>
        </table>
    </div>

    <div class="flex flex-col md:hidden bg-white dark:bg-gray-900 space-y-2">
        <table>
            <tr class="border-b">
                <x-column header>{{ __('Regelmäßige Zahlungen') }}</x-column>

                <x-column
                    header
                    class="text-right
                    {{ $totalRegular >= 0 ? 'text-green-600' : 'text-red-600' }}"
                    >
                    {{ $totalRegular }} €
                </x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">{{ __('Einnahmen') }}</div>
                </x-column>

                <x-column class="text-right">{{ $regularCredit }} €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">{{ __('Ausgaben') }}</div>
                </x-column>

                <x-column class="text-right">{{ $regularDebit }} €</x-column>
            </tr>
        </table>
        <table>
            <tr class="border-b">
                <x-column header>{{ __('Einmalige Zahlungen') }}</x-column>
                <x-column
                    header
                    class="text-right
                    {{ $totalRegular >= 0 ? 'text-green-600' : 'text-red-600' }}"
                    >
                    {{ $totalOneOff }} €
                </x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">{{ __('Einnahmen') }}</div>
                </x-column>

                <x-column class="text-right">{{ $oneOffCredit }} €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">{{ __('Ausgaben') }}</div>
                </x-column>

                <x-column class="text-right">{{ $oneOffDebit }} €</x-column>
            </tr>
        </table>
    </div>

    <div class="font-semibold text-center
        {{ $total >= 0 ? 'text-green-600' : 'text-red-600' }}">
        {{ __('Gesamt') }}: {{ $total }} €
    </div>
</x-main-ledger>
