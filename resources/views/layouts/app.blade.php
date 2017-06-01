<!DOCTYPE html>
<html lang="en" ng-app="campsite">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">

    <!-- Styles -->
    {{--<link href="/css/app.css" rel="stylesheet">--}}
    <link rel="shortcut icon" href="{{ url('assets/img/favicon.ico') }}">
    <link href="{{elixir('assets/css/app.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
        laravel_csrf = "{{ csrf_token() }}";
    </script>
    <!-- Scripts -->
    <script src="{{elixir('js/app.js')}}"></script>
    <script src="{{elixir('assets/js/vendor.js')}}"></script>
    <script src="{{elixir('assets/js/angular.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMAW5zXJPvHHAAdYeR9eBx-BcRVh8xFNA&libraries=places"
            async defer></script>
</head>
<body>
<div id="app">
    @include('includes.navbar')

    @yield('content')

    @include('includes.footer')
</div>

@yield('scripts')
</body>
</html>
