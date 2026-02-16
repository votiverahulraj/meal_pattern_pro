<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Dynamic title --}}
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">

    {{-- Extra CSS --}}
    @yield('styles')

</head>

<body>

<div id="auth">

    {{-- Page content --}}
    @yield('content')

</div>

{{-- JS --}}
<script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>

{{-- Extra JS --}}
@yield('js')

</body>
</html>
