<x-select id="category" name="category">
    @foreach ($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->title }}
        </option>
    @endforeach
</x-select>
