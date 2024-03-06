<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="{{ ('width=device-width, initial-scale=1') }}">
    <title>@yield('title')</title>
    @include('partials.styles')
</head>

<body class="hold-transition sidebar-mini">
    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @include('partials.scripts')

</body>

</html>