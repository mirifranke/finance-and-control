<x-main-finance heading="One-off Payments">
    <x-slot name="buttons">
        <div class="flex">
            <div class="pr-4">
                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    All
                </button>
            </div>

            <div class="pr-4">
                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    Incoming
                </button>
            </div>

            <div class="pr-4">
                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    Outgoing
                </button>
            </div>

            <div class="pr-4">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-dropdown-trigger>Category</x-dropdown-trigger>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link href="#">Mobility</x-dropdown-link>
                        <x-dropdown-link href="#">Living</x-dropdown-link>
                        <x-dropdown-link href="#">Multimedia</x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <x-dropdown-trigger>Sort By</x-dropdown-trigger>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link href="#">Title</x-dropdown-link>
                    <x-dropdown-link href="#">Amount</x-dropdown-link>
                    <x-dropdown-link href="#">Category</x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-900">
        <table class="min-w-full">
            <tr class="border-b">
                <x-column header>Titel</x-column>
                <x-column header>Betrag</x-column>
                <x-column header>Kategorie</x-column>
                <x-column header>Datum</x-column>
            </tr>
            <tr>
                <x-column>Zuschuss Kanadareise</x-column>
                <x-column>500 €</x-column>
                <x-column>Kinder</x-column>
                <x-column>06.02.2022</x-column>
            </tr>
            <tr>
                <x-column>Autoreparatur</x-column>
                <x-column>-663 €</x-column>
                <x-column>Mobilität</x-column>
                <x-column>01.05.2022</x-column>
            </tr>
        </table>
    </div>
</x-main-finance>
