<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Holiday Gift App')</title>
    @vite(['resources/css/app.css'])

    @stack('styles')

    @include('partials.toastr')
</head>
<body>
    @include('partials.loader')
    @yield('content')

    @stack('scripts')
</body>
</html>
