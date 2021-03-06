@props(['heading'])

<x-app-layout heading="{{ __('Hauptkonto') }}">
    <x-setting heading="{{ $heading }}">

        <x-slot name="options">
            {{ $options ?? '' }}
        </x-slot>

        <x-slot name="links">
            <div class="hidden sm:inline-block">
                <x-setting-link :href="route('ledger.overview')" name="{{ __('Übersicht') }}" :active="request()->routeIs('ledger.overview')" />

                <x-setting-link :href="route('ledger.payments.regular')" name="{{ __('Regelmäßige Zahlungen') }}"
                    :active="request()->routeIs('ledger.payments.regular')" />

                <x-setting-link :href="route('ledger.payments.one-off')" name="{{ __('Einmalige Zahlungen') }}"
                    :active="request()->routeIs('ledger.payments.one-off')" />

                <x-setting-link :href="route('ledger.categories')" name="{{ __('Kategorien') }}"
                    :active="request()->routeIs('ledger.categories')" />
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
                        <x-setting-link :href="route('ledger.overview')" name="{{ __('Übersicht') }}"
                            :active="request()->routeIs('ledger.overview')" />

                        <x-setting-link :href="route('ledger.payments.regular')" name="{{ __('Regelmäßige Zahlungen') }}"
                            :active="request()->routeIs('ledger.payments.regular')" />

                        <x-setting-link :href="route('ledger.payments.one-off')" name="{{ __('Einmalige Zahlungen') }}"
                            :active="request()->routeIs('ledger.payments.one-off')" />

                        <x-setting-link :href="route('ledger.categories')" name="{{ __('Kategorien') }}"
                            :active="request()->routeIs('ledger.categories')" />
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('ledger.overview')" :active="request()->routeIs('ledger.overview')">
                        {{ __('Finances') }}
                    </x-responsive-nav-link>
                </div>
        </x-slot>

        <div class="pt-2 md:pt-0 flex flex-col space-y-3">
            {{ $slot }}
        </div>
    </x-setting>
</x-app-layout>
