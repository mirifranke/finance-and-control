@props(['path'])

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <x-dropdown-trigger>Category</x-dropdown-trigger>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link
            href="{{ $path }}/?{{ http_build_query(request()->except('category')) }}"
            :active="! isset($currentCategory)">All
        </x-dropdown-link>

        @foreach ($categories as $category)
            <x-dropdown-link
                href="{{ $path }}/?category={{ $category->slug }}"
                :active="isset($currentCategory) && $currentCategory->is($category)">
                {{ $category->title }}</x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>
