<x-select id="category" name="category">
    <option value="null">select category</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->title }}
        </option>
    @endforeach
</x-select>

