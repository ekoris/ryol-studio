<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin') }}/assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="{{ asset('assets/admin') }}/assets/img/favicon.png">
        <title>Ryol</title>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
        <link href="{{ asset('assets/admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <link id="pagestyle" href="{{ asset('assets/admin/assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
        @stack('styles')
    </head>

    <body class="g-sidenav-show  bg-gray-200">
        @include('admin.theme.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            @include('admin.theme.navbar')
            <div class="container-fluid py-4">
                @yield('body')
            </div>
            @include('admin.theme.footer')
        </main>
        <script src="{{ asset('assets/admin') }}/assets/js/core/popper.min.js"></script>
        <script src="{{ asset('assets/admin') }}/assets/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('assets/admin') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="{{ asset('assets/admin') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="{{ asset('assets/admin') }}/assets/js/material-dashboard.min.js?v=3.0.0"></script>
        @stack('scripts')
    </body>
</html>