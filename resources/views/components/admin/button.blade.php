@props([
    'type' => 'button',
    'variant' => 'primary',
])

<button
    type="{{ $type }}"
    {{ $attributes->class([
        'inline-flex items-center justify-center rounded-full px-8 py-3 text-sm font-bold uppercase tracking-wide transition',
        'bg-up-green text-white shadow-sm hover:bg-up-green-dark' => $variant === 'primary',
        'bg-gray-200 text-gray-800 hover:bg-gray-300' => $variant === 'secondary',
        'bg-up-green px-6 py-2.5 text-xs hover:bg-up-green-dark' => $variant === 'primary-sm',
    ]) }}
>
    {{ $slot }}
</button>
