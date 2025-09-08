<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title','Demo')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>body{font-family:system-ui,Segoe UI,Roboto,Ubuntu,Arial,sans-serif}main{max-width:900px;margin:24px auto;padding:0 16px}</style>
</head>
<body>
<x-menu />
<main>@yield('content')</main>
</body>
</html>
