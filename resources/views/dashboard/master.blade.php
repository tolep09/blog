<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Módulo Admin</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/material-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/demo/demo.css') }}">
    
</head>
<body>
    {{-- @include('dashboard.partials.navbar') --}}

    <div class="wrapper">
        @include('dashboard.partials.sidebar')
        <div class="main-panel">
            @include('dashboard.partials._navbar')
            <div class="content">
                <div class="container-fluid">
                  <div class="container-fluid">
                        @include('dashboard.partials.messages')

                        @yield('content')
                  </div>
                </div>
            </div>
        </div>    
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('dashboard/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/material-dashboard.js') }}"></script>
</body>
</html>