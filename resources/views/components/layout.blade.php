<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <title>Coronatime</title>
</head>

<style>
    body {
        font-family: 'Inter', sans-serif;
    }
</style>

<body>
    {{ $slot }}

</body>

</html>
