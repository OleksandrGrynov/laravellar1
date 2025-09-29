<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Laravel Lab Project')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
<x-header />
<x-nav />

<main class="container py-3">
    @yield('content')
</main>

<x-footer />
</body>
</html>
