<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Módulo Admin</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('dashboard.partials.navbar')

    <div class="container my-4">
        @include('dashboard.partials.messages')

        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>