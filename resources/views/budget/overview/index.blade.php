<x-main-budget heading="Overview">
    <div class="flex justify-center items-center py-3 md:pb-3">
        <div class="pb-1">
            <a href="#">
                <x-icon name="arrow-left" />
            </a>
        </div>

        <div class="text-gray-800 uppercase font-bold text-center px-2">
            April 2022
        </div>

        <div class="pb-1">
            <a href="#">
                <x-icon name="arrow-right" />
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 bg-white dark:bg-gray-900 items-start gap-4">
        <table>
            <tr class="border-b">
                <x-column header>Shops</x-column>

                <x-column header class="text-right">
                    123 €
                </x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Aldi</div>
                </x-column>

                <x-column class="text-right">321 €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">DM</div>
                </x-column>

                <x-column class="text-right">82 €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Rewe</div>
                </x-column>

                <x-column class="text-right">66 €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Edeka</div>
                </x-column>

                <x-column class="text-right">12 €</x-column>
            </tr>
        </table>

        <table>
            <tr class="border-b">
                <x-column header>Persons</x-column>
                <x-column header class="text-right">
                    13 €
                </x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Angelika</div>
                </x-column>

                <x-column class="text-right">36 €</x-column>
            </tr>
            <tr>
                <x-column>
                    <div class="hover:text-blue-500">Nicole</div>
                </x-column>

                <x-column class="text-right">27 €</x-column>
            </tr>
        </table>
    </div>

    <div class="font-semibold text-center">Total: 256 €</div>
</x-main-budget>
