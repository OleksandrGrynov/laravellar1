<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased flex flex-col min-h-screen bg-gray-100">
<div class="flex-grow">
    @include('layouts.navigation')
    @auth
        <a href="{{ route('orders.mine') }}">📦 Мої замовлення</a>
    @endauth

    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="container mx-auto py-6">
        @yield('content')
    </main>
</div>

<footer class="bg-gray-800 text-gray-200 mt-8">
    <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center">
        <p class="text-sm">&copy; {{ date('Y') }} Система публікації новин та коментарів</p>
        <p class="text-sm">Розробив: Олександр</p>
    </div>
</footer>
{{-- Маска для телефону --}}
<script src="https://unpkg.com/imask"></script>
<script src="{{ asset('js/phone-mask.js') }}"></script>
@stack('modals')

</body>
</html>
