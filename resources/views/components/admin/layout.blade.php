@props(['title' => 'Academic Advisement'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — AMIS</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 font-sans text-gray-900 antialiased">
    <div class="flex min-h-screen">
        <x-admin.sidebar />

        <div class="flex min-w-0 flex-1 flex-col">
            <x-admin.topbar />

            <main class="flex-1 overflow-y-auto p-6">
                <x-admin.section-banner>{{ $title }}</x-admin.section-banner>

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
