<div {{ $attributes->class(['rounded-xl border border-slate-200 bg-white p-6 shadow-sm']) }}>
    @isset($title)
        <h2 class="text-lg font-semibold text-slate-900">{{ $title }}</h2>
    @endisset

    @isset($description)
        <p class="mt-1 text-sm text-slate-500">{{ $description }}</p>
    @endisset

    <div @class(['mt-4' => isset($title) || isset($description)])>
        {{ $slot }}
    </div>
</div>
