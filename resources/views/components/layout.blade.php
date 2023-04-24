<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
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
