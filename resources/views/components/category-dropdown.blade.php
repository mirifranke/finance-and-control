@props(['path'])

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <x-dropdown-trigger>{{ __('Kategorie') }}</x-dropdown-trigger>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link
            href="{{ $path }}"
            :active="! isset($currentCategory)">{{ __('Alle') }}
        </x-dropdown-link>

        @foreach ($categories as $category)
            <x-dropdown-item
                href="{{ $path }}/?category={{ $category->slug }}"
                :active="isset($currentCategory) && $currentCategory->is($category)">
                {{ $category->title }}</x-dropdown-item>
        @endforeach
    </x-slot>
</x-dropdown>
