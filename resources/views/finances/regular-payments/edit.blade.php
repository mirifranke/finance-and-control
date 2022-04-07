<x-main-finance heading="Update Regular Payment">
    <div x-data="{
            isDebit: {{ $payment->isDebit() }},
            isEndless: {{ $payment->isEndless() }}
        }">
            <form method="POST" action="{{ route('payment.update', $payment) }}">
            @csrf
            @method('PATCH')

            <input type="hidden" id="type" name="type" value="regular">

            <div class="flex-col">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex space-x-2 items-end">
                        <x-label class="inline-flex items-center">
                            <input
                                @click="isDebit = false"
                                type="radio"
                                name="isDebit"
                                class="bg-gray-200 text-green-600 border-none"
                                value="0"
                                {{ !$payment->isDebit() ? 'checked' : '' }}
                            />
                            <span class="ml-2">Incoming</span>
                        </x-label>

                        <x-label class="inline-flex items-center">
                            <input
                                @click="isDebit = true"
                                type="radio"
                                name="isDebit"
                                class="bg-gray-200 text-red-600 border-none"
                                value="1"
                                {{ $payment->isDebit() ? 'checked' : '' }}
                            />
                            <span class="ml-2">Outgoing</span>
                        </x-label>
                    </div>
                </div>

                <div class="grow grid grid-cols-3 gap-4 pt-3">

                    {{-- Title --}}
                    <div>
                        <x-label for="title" class="">Title</x-label>
                        <x-input id="title" name="title" type="text" class="w-full" value="{{ $payment->title }}" />

                        @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div>
                        <x-label for="amount" class="">Amount</x-label>

                        <div class="relative border rounded-xl" :class="isDebit ? 'border-red-600' : 'border-green-600'">
                            <x-input
                                id="amount"
                                name="amount"
                                type="text"
                                class="pl-7"
                                value="{{ $payment->getAmountForForm() }}"
                            />
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none w-full">
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
                        <x-select-category currentCategoryId="{{ $payment->category_id }}" />

                        @error('category_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-span-3">
                        <x-label for="description" class="">Description</x-label>
                        <x-input id="description" name="description" type="text" class="w-full" value="{{ $payment->description }}" />

                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- endless --}}
                    <div class="col-span-3 flex">
                        <div class="form-check">
                            <input
                                @click="isEndless = !isEndless"
                                type="checkbox"
                                id="is_endless"
                                class="bg-gray-100 rounded-xl border-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                {{ $payment->isEndless() ? 'checked' : '' }}
                                >
                            <x-label class="inline-block pl-1" for="is_endless">
                                endless
                            </x-label>
                        </div>
                    </div>

                    {{-- Intervall --}}
                    <div>
                        <x-label for="interval">Interval</x-label>
                        <x-select-interval currentInterval="{{ $payment->interval }}" />

                        @error('interval')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Start Date --}}
                    <div>
                        <x-label for="starts_at">Start Date</x-label>

                        <x-input id="starts_at" name="starts_at" type="date" value="{{ $payment->starts_at->toDateString() }}" />

                        @error('starts_at')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div>
                        <template x-if="!isEndless">
                            <div>
                                <x-label for="ends_at">End Date</x-label>
                                <x-input id="ends_at" name="ends_at" type="date" class="w-full" value="{{ $payment->ends_at->toDateString() }}" />

                                @error('ends_at')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </template>
                    </div>
                </div>

                <div class="col-span-3 pt-3">
                    <div class="flex justify-end space-x-2">
                        <div>
                            <a href="{{ route('payments.regular') }}">
                                <x-icon name="cancel" />
                            </a>
                        </div>
                        <button type="submit">
                            <x-icon name="check" />
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-main-finance>
