@props(['currentCategoryId' => null])

<x-select id="category_id" name="category_id">
    @foreach ($categories as $category)
    <option value="{{ $category->id }}" {{ $category->id == $currentCategoryId ? 'selected ' : '' }}
        >
        {{ $category->title }}
    </option>
    @endforeach
</x-select>
