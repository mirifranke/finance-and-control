<div class="z-10 fixed bg-white border border-indigo-200 rounded-xl shadow-xl p-4">
    <form method="POST" action="" @submit.prevent="createCategory()">
        <div class="flex-col">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex space-x-2 items-end">
                    <x-input id="incoming" name="type" type="radio" checked />
                    <x-label for="incoming" class="">Incoming</x-label>

                    <x-input id="outgoing" name="type" type="radio" />
                    <x-label for="outgoing" class="">Outgoing</x-label>
                </div>
            </div>

            <div class="grow grid grid-cols-3 gap-4 pt-3">

                {{-- Title --}}
                <div>
                    <x-label for="title" class="">Title</x-label>
                    <x-input id="title" name="title" type="text" class="w-full" />
                </div>

                {{-- Title --}}
                <div>
                    <x-label for="amount" class="">Amount</x-label>

                    <div class="relative">
                        <x-input id="amount" name="amount" type="text" class="pr-7" />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">€</span>
                        </div>
                    </div>
                </div>

                {{-- Category --}}
                <div>
                    <x-label for="category">Category</x-label>
                    <x-select-category />
                </div>

                <div class="col-span-3">
                    <x-label for="description" class="">Description</x-label>
                    <x-input id="description" name="description" type="text" class="w-full" />
                </div>

                <div class="col-span-3 flex">
                    <div class="form-check">
                        <input
                            class="bg-gray-100 rounded-xl border-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="checkbox" id="is_endless">
                        <x-label class="inline-block pl-1" for="is_endless">
                            endless
                        </x-label>
                    </div>
                </div>

                {{-- Intervall --}}
                <div>
                    <x-label for="description">Intervall</x-label>
                    <x-select-interval />
                </div>

                {{-- Start Date --}}
                <div>
                    <x-label for="title" class="">Start Date</x-label>

                    <x-input id="title" name="title" type="date" class="w-full" />
                </div>

                {{-- End Date --}}
                <div>
                    <x-label for="description">End Date</x-label>
                    <x-input id="description" name="description" type="date" class="w-full" />
                </div>
            </div>

            <div class="col-span-3 pt-3">
                <div class="flex justify-end space-x-2">
                    <button @click.prevent="cancel()">
                        <x-icon name="cancel" />
                    </button>
                    <button @click.prevent="create()">
                        <x-icon name="check" />
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
