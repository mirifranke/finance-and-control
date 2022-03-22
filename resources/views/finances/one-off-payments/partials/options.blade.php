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
