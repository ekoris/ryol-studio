<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>Ryol Studio</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link href="{{ asset('assets/frontend') }}/assets/img/logo.png" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/css/style.css" rel="stylesheet">
    @stack('styles')
</head>
@php
    $website = resolve(App\Repositories\Entities\WebsiteManagement::class)->first();
@endphp
<body>
    @include('theme.navigation')
    <main id="main" style="min-height: calc(100vh - 88px);">
        @yield('body')
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer" style="background-color: #282828 !important;">
        <div class="container">
            <div class="copyright">
                <a href="{{ $website->link_ig ?? '#' }}" target="_blank">
                    <img src="{{ asset('assets/frontend/assets/img/sosmed/ig.png') }}" width="30px" alt="">
                </a>
                <a href="{{ $website->link_twitter ?? '#' }}" target="_blank">
                    <img src="{{ asset('assets/frontend/assets/img/sosmed/twitter.png') }}" width="30px" alt="">
                </a>
                <a href="{{ $website->link_wa ?? '#' }}" target="_blank">
                    <img src="{{ asset('assets/frontend/assets/img/sosmed/wa.png') }}" width="30px" alt="">
                </a>
            </div>
        </div>
    </footer>
    
    <div id="preloader"></div>
    {{-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> --}}
    
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/frontend') }}/assets/vendor/purecounter/purecounter.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    {{-- <script src="{{ asset('assets/frontend') }}/assets/vendor/php-email-form/validate.js"></script> --}}
    
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/frontend') }}/assets/js/main.js"></script>
    @stack('scripts')
    
</body>

</html>