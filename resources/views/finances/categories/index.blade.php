<x-main-finance heading="Categories">
    <div>
        <table class="min-w-fit">
            <tr class="border-b">
                <x-column header>Title</x-column>
                <x-column header>Description</x-column>
                <x-column header></x-column>
            </tr>
            <tr>
                <x-column>Mobility</x-column>
                <x-column>Car/ Bus/...</x-column>
                <x-column>
                    <x-icon name="trash" />
                </x-column>
            </tr>
            <tr>
                <x-column>Living</x-column>
                <x-column>...</x-column>
                <x-column>
                    <x-icon name="trash" />
                </x-column>
            </tr>
        </table>

    </div>

    <div x-data="{show: false}" class="pt-3">
        <button @click="show = ! show">
            <x-icon name="add"></x-icon>
        </button>

        <div x-show="show">
            <form method="POST" action="">
                <div class="flex">
                    <div class="pr-4">
                        <x-label for="title" class="">Title</x-label>
                        <x-input id="title" name="title" type="text" />
                    </div>

                    <div class="pr-4">
                        <x-label for="description">Description</x-label>
                        <x-input id="description" name="description" type="text" />
                    </div>

                    <div class="pr-4">
                        <button class="border border-gray-300">
                            <x-icon name="check" />
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-main-finance>
