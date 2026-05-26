<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Courier Master' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-zinc-50 text-zinc-950 antialiased">
        <main class="mx-auto w-full max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
            <header class="mb-8 flex flex-col gap-4 border-b border-zinc-200 pb-6 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-medium text-teal-700">Master Data</p>
                    <h1 class="mt-1 text-3xl font-semibold tracking-tight">{{ $heading ?? 'Couriers' }}</h1>
                </div>
                <nav class="flex items-center gap-2">
                    <a href="{{ route('couriers.index') }}" class="rounded-md border border-zinc-300 px-4 py-2 text-sm font-medium hover:bg-white">List</a>
                    <a href="{{ route('couriers.create') }}" class="rounded-md bg-teal-700 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-800">Add Courier</a>
                </nav>
            </header>

            @if (session('status'))
                <div class="mb-6 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                    {{ session('status') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </body>
</html>
