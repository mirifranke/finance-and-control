@props(['currentShopId' => null])

<x-select id="shop_id" name="shop_id">
    <option value="null">{{ __('Geschäft wählen') }}</option>
    @foreach ($shops as $shop)
    <option value="{{ $shop->id }}" {{ $shop->id == $currentShopId ? 'selected ' : '' }}
        >
        {{ $shop->title }}
    </option>
    @endforeach
</x-select>
