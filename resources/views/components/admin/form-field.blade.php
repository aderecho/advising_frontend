@props([
    'label',
    'name' => null,
    'type' => 'text',
    'placeholder' => '',
])

@php
    $wrapperClass = $attributes->get('class');
    $inputAttributes = $attributes->except('class');
@endphp

<div @if ($wrapperClass) class="{{ $wrapperClass }}" @endif>
    <label for="{{ $name }}" class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-gray-700">
        {{ $label }}
    </label>
    @if ($type === 'select')
        <select
            id="{{ $name }}"
            name="{{ $name }}"
            {{ $inputAttributes->class(['w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-sm focus:border-up-maroon focus:outline-none focus:ring-1 focus:ring-up-maroon']) }}
        >
            {{ $slot }}
        </select>
    @else
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            placeholder="{{ $placeholder }}"
            {{ $inputAttributes->class(['w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-700 shadow-sm placeholder:text-gray-400 focus:border-up-maroon focus:outline-none focus:ring-1 focus:ring-up-maroon']) }}
        >
    @endif
</div>
