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

</body>
</html>