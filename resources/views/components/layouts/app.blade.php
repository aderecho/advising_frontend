<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }} — {{ config('app.name') }}</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div class="flex min-h-screen">
        <x-navigation.sidebar />

        <div class="flex flex-1 flex-col">
            <x-navigation.topbar :title="$title ?? 'Dashboard'" />

            <main class="flex-1 p-6">
                @if (session('status'))
                    <x-ui.alert type="success" class="mb-6">{{ session('status') }}</x-ui.alert>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
