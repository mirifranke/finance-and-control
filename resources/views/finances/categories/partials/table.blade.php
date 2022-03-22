<table class="min-w-fit">
    <tr class="border-b">
        <x-column header>Title</x-column>
        <x-column header>Description</x-column>
    </tr>

    @foreach ($categories as $category)
        <x-row>
            <x-column>{{ $category->title }}</x-column>
            <x-column>{{ $category->description }}</x-column>
        </x-row>
    @endforeach
</table>
