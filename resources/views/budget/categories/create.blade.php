<x-main-budget heading="{{ __('Neue Kategorie') }}">

    <form method="POST" action="{{ route('budget.category.create') }}">
        @csrf

        <div class="flex-col">
            <div class="flex flex-col md:grow md:grid md:grid-cols-3 gap-4">
                {{-- Title --}}
                <div>
                    <x-label for="title" class="">{{ __('Titel') }}</x-label>
                    <x-input id="title" name="title" type="text" />

                    @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="col-span-3">
                    <x-label for="description" class="">{{ __('Beschreibung') }}</x-label>
                    <x-input id="description" name="description" type="text" />

                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-3 pt-3">
                    <div class="flex justify-end space-x-2">
                        <div>
                            <a href="{{ route('budget.categories') }}">
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
</x-main-budget>
