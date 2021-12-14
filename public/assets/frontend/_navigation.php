<h1><a href="index.php">Ryol Studio</a></h1>
<h2>I'm a passionate <span>Art designer</span> from Yogyakarta</h2>
<nav id="navbar" class="navbar">
    <ul>
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