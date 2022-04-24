<x-main-ledger heading="{{ __('Kategorie') }}: {{ $category->title }}">

    <form method="POST" action="{{ route('ledger.category.update', $category) }}">
        @csrf
        @method('PATCH')

        <div class="flex-col">
            <div class="flex flex-col md:grow md:grid md:grid-cols-3 gap-4">
                {{-- Title --}}
                <div>
                    <x-label for="title" class="">{{ __('Titel') }}</x-label>
                    <x-input id="title" name="title" type="text" class="w-full" value="{{ $category->title }}" />

                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="col-span-3">
                    <x-label for="description" class="">{{ __('Beschreibung') }}</x-label>
                    <x-input id="description" name="description" type="text" class="w-full" value="{{ $category->description }}" />

                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-3 pt-3">
                    <div class="flex justify-end space-x-2">
                        <div>
                            <a href="{{ route('ledger.categories') }}">
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
</x-main-ledger>
