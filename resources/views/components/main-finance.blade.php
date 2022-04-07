@props(['heading'])

<x-app-layout heading="Finances">
    <x-setting heading="{{ $heading }}">

        <x-slot name="options">
            {{ $options ?? '' }}
        </x-slot>

        <x-slot name="links">
            <x-setting-link
                            :href="route('finances')"
                            name="Overview"
                            :active="request()->routeIs('finances')" />

            <x-setting-link
                            :href="route('payments.regular')"
                            name="Regular Payments"
                            :active="request()->routeIs('payments.regular')" />

            <x-setting-link
                            :href="route('payments.one-off')"
                            name="One-Off Payments"
                            :active="request()->routeIs('payments.one-off')" />

            <x-setting-link
                            :href="route('categories')"
                            name="Categories"
                            :active="request()->routeIs('categories')" />
        </x-slot>

        <div class="pt-2 md:pt-0 flex flex-col space-y-3">
            {{ $slot }}
        </div>
    </x-setting>
</x-app-layout>
