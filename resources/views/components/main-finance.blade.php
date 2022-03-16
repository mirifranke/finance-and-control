@props(['heading'])

<x-app-layout heading="Finances">
    <x-setting heading="{{ $heading }}">
        <x-slot name="links">
            <x-setting-link
                :href="route('finances')"
                name="Overview"
                :active="request()->routeIs('finances')" />

            <x-setting-link
                :href="route('fix-costs')"
                name="Fix Costs"
                :active="request()->routeIs('fix-costs')" />

            <x-setting-link
                :href="route('earnings')"
                name="Earnings"
                :active="request()->routeIs('earnings')" />
        </x-slot>

        {{ $slot }}
    </x-setting>
</x-app-layout>
