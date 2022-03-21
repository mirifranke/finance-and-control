@props(['heading'])

<x-app-layout heading="Finances">
    <x-setting heading="{{ $heading }}">

        <x-slot name="buttons">
            {{ $buttons ?? '' }}
        </x-slot>

        <x-slot name="links">
            <x-setting-link
                            :href="route('finances')"
                            name="Overview"
                            :active="request()->routeIs('finances')" />

            <x-setting-link
                            :href="route('regular-payments')"
                            name="Regular Payments"
                            :active="request()->routeIs('regular-payments')" />

            <x-setting-link
                            :href="route('one-off-payments')"
                            name="One-Off Payments"
                            :active="request()->routeIs('one-off-payments')" />

            <x-setting-link
                            :href="route('categories')"
                            name="Categories"
                            :active="request()->routeIs('categories')" />
        </x-slot>

        {{ $slot }}
    </x-setting>
</x-app-layout>
