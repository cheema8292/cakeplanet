<?php
// Template Name:products
get_header();
?>

<body>
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Menu & Pricing</h1>
                <a href="">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Menu & Pricing</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Products Start -->
    <div class="container-fluid about py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Menu & Pricing</h2>
                <h1 class="display-4 text-uppercase">Explore Our Cakes</h1>
            </div>

            <div class="tab-class text-center">
                <ul class="nav nav-pills d-inline-flex justify-content-center bg-dark text-uppercase border-inner p-4 mb-5">
                    <?php
                    $categories = get_first_three_categories();
                    $active = 'active';
                    foreach ($categories as $category) {
                        echo '<li class="nav-item">
                            <a class="nav-link text-white ' . $active . '" data-bs-toggle="pill" href="#tab-' . $category->id . '">' . esc_html($category->name) . '</a>
                          </li>';
                        $active = '';
                    }
                    ?>
                </ul>

                <div class="tab-content">
                    <?php
                    $active_class = 'show active';
                    foreach ($categories as $category) {
                        $products = get_products_by_category($category->id);
                    ?>
                        <div id="tab-<?php echo $category->id; ?>" class="tab-pane fade <?php echo $active_class; ?> p-0">
                            <div class="container">
                                <div class="card__container">
                                    <?php foreach ($products as $product) { ?>
                                        <article class="card__article">
                                            <img src="<?php echo esc_url($product->image_url); ?>" alt="image" class="card__img">
                                            <div class="card__data">
                                                <h2 class="card__title"><?php echo esc_html($product->title); ?></h2>
                                                <p class="card__price">$<?php echo number_format($product->price, 2); ?></p>
                                                <button class="btn btn-dark add-to-cart-btn"
                                                    data-id="<?php echo $product->id; ?>"
                                                    data-title="<?php echo esc_attr($product->title); ?>"
                                                    data-price="<?php echo $product->price; ?>"
                                                    data-image="<?php echo esc_url($product->image_url); ?>">
                                                    Add To Cart
                                                </button>
                                            </div>
                                        </article>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php
                        $active_class = '';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Products End -->


    <!-- Offer Start -->
    <div class="container-fluid bg-offer my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-7 text-center">
                    <div class="section-title position-relative text-center mx-auto mb-4 pb-3"
                        style="max-width: 600px;">
                        <h2 class="text-primary font-secondary">Special Kombo Pack</h2>
                        <h1 class="display-4 text-uppercase text-white">Super Crispy Cakes</h1>
                    </div>
                    <p class="text-white mb-4">Eirmod sed tempor lorem ut dolores sit kasd ipsum. Dolor ea et dolore et
                        at sea ea at dolor justo ipsum duo rebum sea. Eos vero eos vero ea et dolore eirmod et. Dolores
                        diam duo lorem. Elitr ut dolores magna sit. Sea dolore sed et.</p>
                    <a href="" class="btn btn-primary border-inner py-3 px-5 me-3">Shop Now</a>
                    <a href="" class="btn btn-dark border-inner py-3 px-5">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Offer End -->


    <!-- Footer Start -->

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>


  
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <?php
    get_footer();
    ?>