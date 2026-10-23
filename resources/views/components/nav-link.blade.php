@props(['active'])

@php
$classes = 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out';
$style = ($active ?? false)
            ? 'color: var(--ivory); border-color: var(--champagne);'
            : 'color: var(--mauve); border-color: transparent;';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'style' => $style]) }}>
    {{ $slot }}
</a>