<div class="z-10 fixed bg-white border border-indigo-200 rounded-xl shadow-xl p-4">
    <form method="POST" action="" wire:submit.prevent="createPayment">
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
                    <x-input wire:model.defer="title" id="title" name="title" type="text" class="w-full" />

                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Amount --}}
                <div>
                    <x-label for="amount" class="">Amount</x-label>

                    <div class="relative">
                        <x-input wire:model.defer="amount" id="amount" name="amount" type="text" class="pr-7" />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">€</span>
                        </div>
                    </div>

                    @error('amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <x-label for="category_id">Category</x-label>
                    <select wire:model.defer="category_id" name="category_id" id="category_id"
                        class="w-full text-sm bg-gray-100 rounded-xl border-none px-4 py-2">
                        <option value="null">Unknown</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="col-span-3">
                    <x-label for="description" class="">Description</x-label>
                    <x-input wire:model.defer="description" id="description" name="description" type="text" class="w-full" />

                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- endless --}}
                <div class="col-span-3 flex">
                    <div class="form-check">
                        <input
                            wire:click="toggleIsEndless"
                            class="bg-gray-100 rounded-xl border-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="checkbox" id="is_endless" {{ $isEndless ? 'checked' : '' }}>
                        <x-label class="inline-block pl-1" for="is_endless">
                            endless
                        </x-label>
                    </div>
                </div>

                {{-- Intervall --}}
                <div>
                    <x-label for="interval">Intervall</x-label>
                    <x-select-interval />

                    @error('interval')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Start Date --}}
                <div>
                    <x-label for="starts_at" class="">Start Date</x-label>

                    <x-input wire:model.defer="starts_at" id="starts_at" name="starts_at" type="date" class="w-full" value="{{ $starts_at }}" />

                    @error('starts_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- End Date --}}
                <div>
                    @if (! $isEndless)
                        <x-label for="ends_at">End Date</x-label>
                        <x-input wire:model.defer="ends_at" id="ends_at" name="ends_at" type="date" class="w-full" />

                        @error('ends_at')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    @endif
                </div>
            </div>

            <div class="col-span-3 pt-3">
                <div class="flex justify-end space-x-2">
                    <button @click.prevent="cancel()">
                        <x-icon name="cancel" />
                    </button>
                    <button type="submit">
                        <x-icon name="check" />
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
