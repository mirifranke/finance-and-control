@props(['heading'])

<x-app-layout heading="Finances">
    <x-setting heading="{{ $heading }}">

        <x-slot name="options">
            {{ $options ?? '' }}
        </x-slot>

        <x-slot name="links">
            <div class="hidden sm:inline-block">
                <x-setting-link :href="route('finances')" name="Overview" :active="request()->routeIs('finances')" />

                <x-setting-link :href="route('payments.regular')" name="Regular Payments"
                    :active="request()->routeIs('payments.regular')" />

                <x-setting-link :href="route('payments.one-off')" name="One-Off Payments"
                    :active="request()->routeIs('payments.one-off')" />

                <x-setting-link :href="route('categories')" name="Categories"
                    :active="request()->routeIs('categories')" />
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
                        <x-setting-link :href="route('finances')" name="Overview"
                            :active="request()->routeIs('finances')" />

                        <x-setting-link :href="route('payments.regular')" name="Regular Payments"
                            :active="request()->routeIs('payments.regular')" />

                        <x-setting-link :href="route('payments.one-off')" name="One-Off Payments"
                            :active="request()->routeIs('payments.one-off')" />

                        <x-setting-link :href="route('categories')" name="Categories"
                            :active="request()->routeIs('categories')" />
                    </div>
                </div>
            </div>


            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('finances')" :active="request()->routeIs('finances')">
                        {{ __('Finances') }}
                    </x-responsive-nav-link>
                </div>
        </x-slot>

        <div class="pt-2 md:pt-0 flex flex-col space-y-3">
            {{ $slot }}
        </div>
    </x-setting>
</x-app-layout>
