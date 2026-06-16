@php
    $menuItems = [
        [
            'label' => 'Curriculum Builder',
            'route' => 'admin.curriculum-builder',
            'icon' => 'builder',
        ],
        [
            'label' => 'Prospectus Preview',
            'route' => 'admin.prospectus-preview',
            'icon' => 'preview',
        ],
        [
            'label' => 'Publish Curriculum',
            'route' => 'admin.publish-curriculum',
            'icon' => 'publish',
        ],
    ];
@endphp

<aside class="flex w-64 shrink-0 flex-col bg-up-maroon text-white">
    <div class="border-b border-white/10 px-5 py-4">
        <p class="text-xs font-bold uppercase tracking-widest text-white/90">Academic Management</p>
    </div>

    <nav class="flex-1 space-y-1 p-3">
        @foreach ($menuItems as $item)
            @php
                $active = request()->routeIs($item['route']);
            @endphp
            <a
                href="{{ route($item['route']) }}"
                @class([
                    'flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition',
                    'bg-white text-up-maroon shadow-sm' => $active,
                    'text-white/90 hover:bg-white/10' => ! $active,
                ])
            >
                @if ($item['icon'] === 'builder')
                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                @elseif ($item['icon'] === 'preview')
                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                @else
                    <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                @endif
                {{ $item['label'] }}
            </a>
        @endforeach
    </nav>
</aside>
