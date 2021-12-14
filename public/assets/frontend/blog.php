
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Ryol Studio</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <header id="header" class="header-top">
        <div class="container" >
        <?php include "_navigation.php"; ?>
        </div>
    </header><!-- End Header -->
    <!-- ======= Portfolio Section ======= -->
    
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-show">
        <div class="container">

            <div class="section-title">
                <h2>Blog</h2>
                <p>My Article</p>
            </div>

            <div class="row">

                <?php for ($i=0; $i <6 ; $i++) { ?>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-news"></i></div>
                            <h4><a href=""><?= bin2hex(openssl_random_pseudo_bytes(10)) ?></a></h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae corporis sequi dolorem iste harum quas nesciunt, fugit dolorum adipisci, nobis ipsum excepturi. Fugit, facilis tempora.</p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section><!-- End Services Section -->

    <div class="credits">
        Designed by <a href="#">Ryol Studio</a>
    </div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>