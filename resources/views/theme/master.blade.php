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
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="{{ asset('assets/frontend') }}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="{{ asset('assets/frontend') }}/assets/css/style.css" rel="stylesheet">
    <style>
        .slideshow img
        {
            z-index: -1;    
            width: auto;
            height: 100%;
            object-fit: cover;
        }
               
        .slideshow{
            object-fit: cover;
            background-repeat: no-repeat;
            background-size: auto;
            position: relative;
            width: 100%;
        }
        .slideshowimage{
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="slideshow">
        <header id="header">
            <div class="container" style="z-index: 20; background:rgba(0, 0, 0, 0.4);;padding-top: 30px;padding-bottom: 30px;padding-left: 30px;">
                <h1 style="font-weight: 900px !important;"><a href="index.php">Ryol Studio</a></h1>
                <h2 style="color: white;">I'm a passionate <span>Art designer</span> from Yogyakarta</h2>
                <nav id="navbar" class="navbar">
                    <ul style="color: white;">
                        <li><a class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "about.php") ? 'active' : '' ?>" href="about.php">About</a></li>
                        <li><a class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "portfolio.php") ? 'active' : '' ?>" href="portfolio.php">Feed</a></li>
                        <li><a class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "store.php") || strstr($_SERVER['REQUEST_URI'], "product-detail.php") ? 'active' : '' ?>" href="store.php">Store</a></li>
                        <li><a class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "blog.php") ? 'active' : '' ?>" href="blog.php">Blog</a></li>
                        <li><a class="nav-link <?= strstr($_SERVER['REQUEST_URI'], "contact.php") ? 'active' : '' ?>" href="contact.php">Contact</a></li>
                    </ul>
                    <i class="bi bi-list mobile-nav-toggle"></i>
                </nav><!-- .navbar -->

                <div class="social-links">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </header><!-- End Header -->
    </div>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/frontend') }}/assets/vendor/purecounter/purecounter.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="{{ asset('assets/frontend') }}/assets/vendor/php-email-form/validate.js"></script>
    <script src="http://code.jquery.com/jquery-2.2.2.min.js"></script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/frontend') }}/assets/js/main.js"></script>
    <script>
        var images=new Array(
            'https://media.istockphoto.com/photos/fine-art-abstract-floral-painting-background-picture-id1258336471?b=1&k=20&m=1258336471&s=170667a&w=0&h=9axQbqJmQz3qAGDJEqGWiDLnJ3Thvj55NrhqWcifaFg=',
            'https://cdn.pixabay.com/photo/2017/10/14/23/39/wall-art-2852231_960_720.jpg',
            'https://lh6.ggpht.com/HlgucZ0ylJAfZgusynnUwxNIgIp5htNhShF559x3dRXiuy_UdP3UQVLYW6c=s1200'
            );
        var nextimage=0;

        doSlideshow();

        function doSlideshow()
        {
            if($('.slideshowimage').length!=0){
                $('.slideshowimage').fadeOut(500,function(){slideshowFadeIn();$(this).remove()});
            }else{
                slideshowFadeIn();
            }
        }
        function slideshowFadeIn()
        {
            $('.slideshow').prepend($('<img src="'+images[nextimage++]+'" width="100%" class="slideshowimage" style="width:inherit;overflow: hidden;background-size: cover;position:absolute;bottom:0;background-position: center;bottom:0px;" />').fadeIn(500,function(){setTimeout(doSlideshow,5000);}));
            if(nextimage>=images.length)
                nextimage=0;
        }
    </script>
</body>

</html>