<x-main-budget heading="{{ __('Zahlung') }}: {{ $payment->getStartsAtForUser() }} - {{ $payment->shop->title }}">
    <div x-data="{ isDebit: {{ $payment->isDebit() }} }">
       <form method="POST" action="{{ route('budget.payment.update', $payment) }}">
            @csrf
            @method('PATCH')

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
                                {{ ! $payment->isDebit() ? 'checked' : ''}}
                            />
                            <span class="ml-2">{{ __('Einnahme') }}</span>
                        </x-label>

                        <x-label class="inline-flex items-center">
                            <input
                                @click="isDebit = true"
                                type="radio"
                                name="isDebit"
                                class="bg-gray-200 text-red-600 border-none"
                                value="1"
                                {{ $payment->isDebit() ? 'checked' : ''}}
                            />
                            <span class="ml-2">{{ __('Ausgabe') }}</span>
                        </x-label>
                    </div>
                </div>

                <div class="flex flex-col md:grow md:grid md:grid-cols-3 gap-4 pt-3">
                    {{-- Shop --}}
                    <div>
                        <x-label for="shop" class="">{{ __('Geschäft') }}</x-label>
                        <x-select-budget-shop :currentShopId="$payment->shop_id" />

                        @error('shop')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Amount --}}
                    <div>
                        <x-label for="amount" class="">{{ __('Betrag') }}</x-label>

                        <div
                            class="relative border rounded-xl"
                            :class="isDebit ? 'border-red-600' : 'border-green-600'"
                        >
                            <x-input id="amount" name="amount" type="text" class="pl-7" value="{{ $payment->getAmountForForm() }}" />
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
                        <x-label for="category_id">{{ __('Kategorie') }}</x-label>
                        <x-select-budget-category currentCategoryId="{{ $payment->category_id }}" />

                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-span-3">
                        <x-label for="description" class="">{{ __('Beschreibung') }}</x-label>
                        <x-input id="description" name="description" type="text" value="{{ $payment->description }}" />

                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Start Date --}}
                    <div>
                        <x-label for="starts_at">{{ __('Datum') }}</x-label>

                        <x-input id="starts_at" name="starts_at" type="date" value="{{ $payment->starts_at->toDateString() }}" />

                        @error('starts_at')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-3 pt-3">
                    <div class="flex justify-end space-x-2">
                        <div>
                            <a href="{{ route('budget.payments') }}">
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
