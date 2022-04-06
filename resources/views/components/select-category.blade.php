<x-select id="category_id" name="category_id">
    <option value="null">select category</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}">
            {{ $category->title }}
        </option>
    @endforeach
</x-select>
