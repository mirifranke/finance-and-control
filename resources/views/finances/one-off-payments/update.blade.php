<div class="bg-white border {{ $isDebit ? 'border-red-600' : 'border-green-600' }} rounded-xl shadow-xl p-4">
    <form method="POST" action="" wire:submit.prevent="updatePayment">
        <div class="flex-col">
            <div class="grid grid-cols-2 gap-4">
                <div class="flex space-x-2 items-end">
                    <x-label class="inline-flex items-center">
                        <x-input type="radio" name="radio_type" wire:click="setToCredit"
                            class="text-green-600 border-none" @if (!$isDebit) "checked" @endif />
                        <span class="ml-2">Incoming</span>
                    </x-label>

                    <x-label class="inline-flex items-center">
                        <x-input type="radio" name="radio_type" wire:click="setToDebit"
                            class="text-red-600 border-none" />
                        <span class="ml-2">Outgoing</span>
                    </x-label>
                </div>
            </div>

            <div class="grow grid grid-cols-3 gap-4 pt-3">

                {{-- Title --}}
                <div>
                    <x-label for="title" class="">Title</x-label>
                    <x-input wire:model.defer="payment.title" id="title" name="title" type="text" class="w-full" />

                    @error('payment.title')
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
                    <select wire:model.defer="payment.category_id" name="category_id" id="category_id"
                        class="w-full text-sm bg-gray-100 rounded-xl border-none px-4 py-2">
                        <option value="null">Unknown</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>

                    @error('payment.category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="col-span-3">
                    <x-label for="description" class="">Description</x-label>
                    <x-input wire:model.defer="payment.description" id="description" name="description" type="text"
                        class="w-full" />

                    @error('payment.description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Start Date --}}
                <div>
                    <x-label for="starts_at" class="">Date</x-label>

                    <x-input wire:model.defer="payment.starts_at" id="starts_at" name="starts_at" type="date"
                        class="w-full" value="{{ $payment->starts_at }}" />

                    @error('payment.starts_at')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
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
