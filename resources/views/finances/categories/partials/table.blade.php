<table class="w-full">
    <tr class="border-b">
        <x-column header class="w-9/10 md:w-33/100">Title</x-column>
        <x-column header class="hidden md:table-cell md:w-65/100">Description</x-column>
        <x-column header class="w-1/10 md:w-2/100"></x-column>
    </tr>

    @foreach ($categories as $category)
        <x-row deleteAction="{{ route('categories.destroy', ['id' => $category->id]) }}">
            <x-column>
                <a href="{{ route('category.show', $category) }}">
                    {{ $category->title }}
                </a>
            </x-column>
            <x-column class="hidden md:table-cell">{{ $category->description }}</x-column>
        </x-row>
    @endforeach
</table>
