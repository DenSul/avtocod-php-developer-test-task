<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    @include('layouts.partials.html_header')
    @yield('additional_style')
</head>

<body>

@include('layouts.partials.main_header')

@yield('main_content')

@section('scripts')
    @include('layouts.partials.scripts')
@show

<style type="text/css">
    .navbar-text a {padding: 0 !important; margin: 0 !important; display: inline !important;}
</style>

</body>
</html>