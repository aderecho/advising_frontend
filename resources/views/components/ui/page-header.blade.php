@props([
    'title',
    'description' => null,
])

<div {{ $attributes->class(['mb-6']) }}>
    <h2 class="text-2xl font-bold text-slate-900">{{ $title }}</h2>
    @if ($description)
        <p class="mt-1 text-slate-500">{{ $description }}</p>
    @endif
</div>
