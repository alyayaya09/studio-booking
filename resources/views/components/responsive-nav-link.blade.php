@props(['active'])

@php
$classes = 'block w-full ps-3 pe-4 py-2 border-l-4 text-start text-base font-medium focus:outline-none transition duration-150 ease-in-out';
$style = ($active ?? false)
            ? 'color: var(--ivory); border-color: var(--champagne); background: var(--wine-soft);'
            : 'color: var(--mauve); border-color: transparent;';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'style' => $style]) }}>
    {{ $slot }}
</a>