@props(['header' => false])

@php
    $classes = 'text-left py-1';

    if ($header) {
        $classes .= ' text-gray-600 dark:text-gray-400 text-xs uppercase tracking-widest';
    } else {
        $classes .= ' text-gray-800 dark:text-gray-200 text-sm font-light';
    }
@endphp

<th {{ $attributes->merge([
    'scope' => 'col',
    'class' => $classes])
    }}>
    {{ $slot }}
</th>
