<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cakeplanet.com
 */

?>

<head>
    <meta charset="utf-8">
    <title>CakeZone - Cake Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo get_template_directory_uri() ?>/assets/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?php echo get_template_directory_uri() ?>/style.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>./assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

</head>


<!-- Topbar Start -->
<div class="container-fluid px-0 d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-lg-4 text-center bg-secondary py-3">
            <div class="d-inline-flex align-items-center justify-content-center">
                <i class="bi bi-envelope fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Email Us</h6>
                    <span>info@example.com</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center bg-primary border-inner py-3">
            <div class="d-inline-flex align-items-center justify-content-center">
                <a href="index.html" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-white"><i
                            class="fa fa-birthday-cake fs-1 text-dark me-3"></i>CakeZone</h1>
                </a>
            </div>
        </div>
        <div class="col-lg-4 text-center bg-secondary py-3">
            <div class="d-inline-flex align-items-center justify-content-center">
                <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                <div class="text-start">
                    <h6 class="text-uppercase mb-1">Call Us</h6>
                    <span>0344 5359553</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="index.php" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>CakeZone
        </h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto mx-lg-auto py-0">
            <a href="<?php echo site_url(''); ?>" class="nav-item nav-link active">Home</a>
            <a href="<?php echo site_url('/about'); ?>" class="nav-item nav-link">About Us</a>
            <a href="<?php echo site_url('/product'); ?>" class="nav-item nav-link">Menu & Pricing</a>
            <a href="<?php echo site_url('/team'); ?>" class="nav-item nav-link">Master Chefs</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="service" class="dropdown-item">Our Service</a>
                    <a href="#" class="dropdown-item">Testimonial</a>
                </div>
            </div>
            <a href="<?php echo site_url('/contact'); ?>" class="nav-item nav-link">Contact Us</a>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('/cart'); ?>">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-counter">0</span>
                </a>
            </li>

        </div>
    </div>
</nav>
<!-- Navbar End -->