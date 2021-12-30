<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <title>Ryol Studio</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ asset('assets/frontend') }}/assets/img/favicon.png" rel="icon">
    <link href="{{ asset('assets/frontend') }}/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    
    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/frontend') }}/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/slider') }}/assets/css/style.css">
</head>

<body>
    <!-- ======= Header ======= -->
    @include('theme.navigation')

    <!-- ======= Hero Section ======= -->
    <div id="hero-slider">
        <div id="slideshow">
            <div id="slides-main" class="slides">
                @foreach (resolve(App\Repositories\Entities\Slider::class)->get() as $key => $item)
                    <div class="slide" data-index="{{ $key }}">
                        <div class="abs-mask">
                            <div class="slide-image" style="background-image: url({{ $item->file_url }})"></div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="slide" data-index="1">
                    <div class="abs-mask">
                        <div class="slide-image" style="background-image: url({{ asset('assets/frontend/slider') }}/assets/img/slide-2.jpg)"></div>
                    </div>
                </div>
                <div class="slide" data-index="2">
                    <div class="abs-mask">
                        <div class="slide-image" style="background-image: url({{ asset('assets/frontend/slider') }}/assets/img/slide-3.jpg)"></div>
                    </div>
                </div>
                <div class="slide" data-index="3">
                    <div class="abs-mask">
                        <div class="slide-image" style="background-image: url({{ asset('assets/frontend/slider') }}/assets/img/slide-4.jpg)"></div>
                    </div>
                </div> --}}
            </div>
            <div id="slides-aux" class="slides mask">
                @foreach (resolve(App\Repositories\Entities\Slider::class)->get() as $key => $item)
                    <h2 class="slide-title slide" data-index="{{ $key }}"><a href="#" style="display: none">#{{ $item->year }}</a></h2>
                @endforeach
            </div>
        </div>
        <nav id="slider-nav" style="z-index: -1 !important">
            <span class="current"></span>
            <span class="sep"></span>
            <span class="total"></span>
        </nav>
        
    </div>
    
    <script src="{{ asset('assets/frontend/slider') }}/assets/js/main.js"></script>
    
    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/frontend') }}/assets/vendor/purecounter/purecounter.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/aos/aos.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/php-email-form/validate.js"></script>
    
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/frontend') }}/assets/js/main.js"></script>
    
</body>

</html>