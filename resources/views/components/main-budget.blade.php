@props(['heading'])

<x-app-layout heading="{{ __('Haushaltskonto') }}">
    <x-setting heading="{{ $heading }}">

        <x-slot name="options">
            {{ $options ?? '' }}
        </x-slot>

        <x-slot name="links">
            <div class="hidden sm:inline-block">
                <x-setting-link :href="route('budget.overview')" name="{{__('Übersicht')}}"
                    :active="request()->routeIs('budget.overview')" />

                <x-setting-link :href="route('budget.payments')" name="{{__('Zahlungen')}}"
                    :active="request()->routeIs('budget.payments')" />

                <x-setting-link :href="route('budget.categories')" name="{{__('Kategorien')}}"
                    :active="request()->routeIs('budget.categories')" />

                <x-setting-link :href="route('budget.shops')" name="Geschäfte" :active="request()->routeIs('budget.shops')" />
            </div>

            <div x-data="{ open: false }">
                <!-- Hamburger -->
                <div class="flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <x-icon name="hamburger"></x-icon>
                    </button>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <x-setting-link :href="route('budget.overview')" name="{{__('Übersicht')}}"
                            :active="request()->routeIs('budget.overview')" />

                        <x-setting-link :href="route('budget.payments')" name="{{__('Zahlungen')}}"
                            :active="request()->routeIs('budget.payments')" />

                        <x-setting-link :href="route('budget.categories')" name="{{__('Kategorien')}}"
                            :active="request()->routeIs('budget.categories')" />

                        <x-setting-link :href="route('budget.shops')" name="Geschäfte" :active="request()->routeIs('budget.shops')" />
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('ledger.overview')"
                        :active="request()->routeIs('ledger.overview')">
                        {{ __('Ledger Account') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('budget.overview')" :active="request()->routeIs('budget.overview')">
                        {{ __('Budget Account') }}
                    </x-responsive-nav-link>
                </div>
        </x-slot>

        <div class="pt-2 md:pt-0 flex flex-col space-y-3">
            {{ $slot }}
        </div>
    </x-setting>
</x-app-layout>
