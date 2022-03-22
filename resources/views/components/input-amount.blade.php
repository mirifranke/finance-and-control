@props(['disabled' => false, 'currency' => '€'])

<div class="mt-1 relative rounded-md shadow-sm">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <span class="text-gray-500 sm:text-sm">{{ $currency }}</span>
    </div>

    <x-input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge() !!} />
</div>
