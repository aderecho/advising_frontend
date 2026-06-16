@php
    $role = auth()->user()->role->value;
    $navigation = config("navigation.{$role}", []);
@endphp

<aside class="hidden w-64 shrink-0 border-r border-slate-200 bg-white lg:flex lg:flex-col">
    <div class="border-b border-slate-200 px-6 py-5">
        <p class="text-xs font-semibold uppercase tracking-wider text-red-600">Advisement</p>
        <p class="mt-1 text-lg font-bold text-slate-900">{{ auth()->user()->role->label() }}</p>
    </div>

    <nav class="flex-1 space-y-1 p-4">
        @foreach ($navigation as $item)
            <x-navigation.sidebar-link
                :label="$item['label']"
                :route="$item['route']"
                :disabled="$item['disabled'] ?? false"
            />
        @endforeach
    </nav>

    <div class="border-t border-slate-200 p-4">
        <p class="truncate text-sm font-medium text-slate-900">{{ auth()->user()->name }}</p>
        <p class="truncate text-xs text-slate-500">{{ auth()->user()->email }}</p>
    </div>
</aside>
