<table class="w-full">
    <tr class="border-b">
        <x-column header class="w-9/10 md:w-33/100">{{ __('Titel') }}</x-column>
        <x-column header class="hidden md:table-cell md:w-65/100">{{ __('Beschreibung') }}</x-column>
        <x-column header class="w-1/10 md:w-2/100"></x-column>
    </tr>

    @foreach ($shops as $shop)
        <x-row deleteAction="{{ route('budget.shop.destroy', ['id' => $shop->id]) }}">
            <x-column>
                <a href="{{ route('budget.shop.view-edit', $shop) }}">
                    {{ $shop->title }}
                </a>
            </x-column>
            <x-column class="hidden md:table-cell">{{ $shop->description }}</x-column>
        </x-row>
    @endforeach
</table>
