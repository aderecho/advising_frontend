@props([
    'label',
    'route',
    'disabled' => false,
])

@php
    $active = ! $disabled && request()->routeIs($route);
@endphp

@if ($disabled)
    <span {{ $attributes->class([
        'flex items-center rounded-lg px-3 py-2 text-sm text-slate-400 cursor-not-allowed',
    ]) }}>
        {{ $label }}
        <span class="ml-auto text-xs">Soon</span>
    </span>
@else
    <a
        href="{{ route($route) }}"
        {{ $attributes->class([
            'flex items-center rounded-lg px-3 py-2 text-sm font-medium transition',
            'bg-red-50 text-red-700' => $active,
            'text-slate-700 hover:bg-slate-100' => ! $active,
        ]) }}
    >
        {{ $label }}
    </a>
@endif
