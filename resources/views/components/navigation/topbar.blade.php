@props(['title' => 'Dashboard'])

<header class="flex items-center justify-between border-b border-slate-200 bg-white px-6 py-4">
    <div>
        <h1 class="text-xl font-semibold text-slate-900">{{ $title }}</h1>
        <p class="text-sm text-slate-500">Welcome back, {{ auth()->user()->name }}</p>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-ui.button type="submit" variant="secondary">Sign out</x-ui.button>
    </form>
</header>
