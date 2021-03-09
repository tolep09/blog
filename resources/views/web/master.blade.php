<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Módulo Admin</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div id="app">
        @include('web.partials.navbar')

        <div class="container my-4">
            @yield('content')
        </div>

        @include('web.partials.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>