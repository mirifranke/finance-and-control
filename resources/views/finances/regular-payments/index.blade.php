<x-main-finance heading="Regular Payments">
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
                    <x-dropdown-link href="#">Intervall</x-dropdown-link>
                    <x-dropdown-link href="#">Amount</x-dropdown-link>
                    <x-dropdown-link href="#">Category</x-dropdown-link>
                    <x-dropdown-link href="#">End Date</x-dropdown-link>
                    <x-dropdown-link href="#">Start Date</x-dropdown-link>
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
                <x-column header>Intervall</x-column>
                <x-column header>Stardatum</x-column>
                <x-column header>Enddatum</x-column>
            </tr>
            <tr class="hover:bg-blue-500">
                <x-column>Unterhalt</x-column>
                <x-column>1.567 €</x-column>
                <x-column>Kinder</x-column>
                <x-column>monatlich</x-column>
                <x-column>01.01.2022</x-column>
                <x-column>31.12.2022</x-column>
            </tr>
            <tr>
                <x-column>Kindergeld</x-column>
                <x-column>663 €</x-column>
                <x-column>Kinder</x-column>
                <x-column>monatlich</x-column>
                <x-column>01.01.2022</x-column>
                <x-column>31.12.2022</x-column>
            </tr>
            <tr>
                <x-column>Hauskredit</x-column>
                <x-column>-1.100 €</x-column>
                <x-column>Wohnen</x-column>
                <x-column>monatlich</x-column>
                <x-column>01.01.2018</x-column>
                <x-column>31.12.2042</x-column>
            </tr>
        </table>
    </div>

    <div class="py-3 px-6">
        <div class="font-semibold items-center">
            Monthly Regular Payments: 3.6782 €
        </div>
    </div>

    <div x-data="formCreateRegularPayment()">
        <button x-show="! show" @click="showForm()" class="px-6">
            <x-icon name="add" />
        </button>

        <div x-show="show" class="max-w-fit px-6 pt-3 border-t">
            @include('finances.regular-payments._create')
        </div>
    </div>

    <script>
        function formCreateRegularPayment() {
            return {
                show: true,

                showForm() {
                    this.show = true;
                    // TODO: set focus on title
                },

                hideForm() {
                    this.show = false;
                },

                create() {

                    console.log('create');
                },

                cancel() {
                    document.getElementById('title').value = '';
                    document.getElementById('description').value = '';
                    this.hideForm();
                }
            }
        }
    </script>
</x-main-finance>
