<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('titulo') - Javier Martínez González
    </title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-bodyBackground">
@include('partials.nav')
<main class=" mt-32">
    @yield('contenido')
</main>
    @include('partials.footer')
</body>

</html>

