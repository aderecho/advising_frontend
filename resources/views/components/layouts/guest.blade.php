<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sign in' }} — {{ config('app.name') }}</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 text-slate-100 antialiased">
    <div class="flex min-h-screen items-center justify-center p-6">
        <div class="w-full max-w-md">
            <div class="mb-8 text-center">
                <p class="text-sm font-semibold uppercase tracking-wider text-red-400">Advisement Management</p>
                <h1 class="mt-2 text-2xl font-bold text-white">{{ $title ?? 'Sign in' }}</h1>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>
</html>
