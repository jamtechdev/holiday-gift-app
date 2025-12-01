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
    {{-- @include('partials.loader') --}}
    @yield('content')

    @stack('scripts')

    {{-- <script>
        // Clear visited routes when user logs out
        document.addEventListener('DOMContentLoaded', function() {
            // Clear sessionStorage if user is on login page (after logout)
            if (window.location.pathname === '/' || window.location.pathname === '/admin/login') {
                sessionStorage.removeItem('holiday_app_visited_routes');
            }

            // Clear sessionStorage when logout form is submitted
            const logoutForms = document.querySelectorAll('form[action*="logout"]');
            logoutForms.forEach(form => {
                form.addEventListener('submit', function() {
                    sessionStorage.removeItem('holiday_app_visited_routes');
                });
            });
        });
    </script> --}}
</body>
</html>
