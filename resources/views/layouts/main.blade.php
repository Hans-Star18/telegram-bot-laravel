<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('admins/assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('admins/assets/css/main/app-dark.css') }}" />

    @stack('style')

    <link rel="stylesheet" href="{{ asset('admins/assets/css/shared/iconly.css') }}" />
</head>

<body>
    <script src="assets/js/initTheme.js"></script>
    <div id="app">
        @include('partials.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Dashboard</h3>
            </div>
            @yield('content')

            @include('partials.footer')
        </div>
    </div>
    <script src="{{ asset('admins/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admins/assets/js/app.js') }}"></script>

    @stack('script')

    <!-- Need: Apexcharts -->
    <script src="{{ asset('admins/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admins/assets/js/pages/dashboard.js') }}"></script>
</body>

</html>
