<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <x-dropdown-trigger>Category</x-dropdown-trigger>
    </x-slot>

    <x-slot name="content">
        @foreach ($categories as $category)
            <x-dropdown-link
                href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category')) }}"
                >
                {{ $category->name }}</x-dropdown-link>
        @endforeach
    </x-slot>
</x-dropdown>
