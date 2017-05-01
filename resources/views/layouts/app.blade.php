<!DOCTYPE html>
<html lang="en" ng-app="campsite">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Campsite') }}</title>

    <!-- Styles -->
    {{--<link href="/css/app.css" rel="stylesheet">--}}
    <link href="{{elixir('assets/css/app.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    @include('includes.navbar')

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{elixir('js/app.js')}}"></script>
<script src="{{elixir('assets/js/vendor.js')}}"></script>
<script src="{{elixir('assets/js/angular.js')}}"></script>
</body>
</html>
