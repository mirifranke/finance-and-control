<x-main-finance heading="Create Category">

    <form method="POST" action="{{ route('category.update', $category) }}">
        @csrf
        @method('PATCH')

        <div class="flex">
            <div class="grow grid grid-cols-3 gap-4">
                {{-- Title --}}
                <div>
                    <x-label for="title" class="">Title</x-label>
                    <x-input id="title" name="title" type="text" class="w-full" value="{{ $category->title }}" />

                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="col-span-3">
                    <x-label for="description" class="">Description</x-label>
                    <x-input id="description" name="description" type="text" class="w-full" value="{{ $category->description }}" />

                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-3 pt-3">
                    <div class="flex justify-end space-x-2">
                        <div>
                            <a href="{{ route('categories') }}">
                                <x-icon name="cancel" />
                            </a>
                        </div>
                        <button type="submit">
                            <x-icon name="check" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-main-finance>
