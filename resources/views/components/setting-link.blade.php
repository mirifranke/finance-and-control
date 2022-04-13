@props(['name', 'active' => false])

@php
    $classes = "text-gray-800 font-semibold";
    if ($active) {
        $classes .= " text-blue-500";
    }
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>{{ $name }}</a>
</li>
