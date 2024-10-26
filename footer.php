<div class="container-fluid bg-img text-secondary" style="margin-top: 90px">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-4 col-md-6 mb-lg-n5">
                <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 bg-primary border-inner p-4">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="m-0 text-uppercase text-white"><i class="fa fa-birthday-cake fs-1 text-dark me-3"></i>CakeZone</h1>
                    </a>
                    <p class="mt-3">Lorem diam sit erat dolor elitr et, diam lorem justo labore amet clita labore stet eos magna sit. Elitr dolor eirmod duo tempor lorem, elitr clita ipsum sea. Nonumy rebum et takimata ea takimata amet gubergren, erat rebum magna lorem stet eos. Diam amet et kasd eos duo dolore no.</p>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="row gx-5">
                    <div class="col-lg-4 col-md-12 pt-5 mb-5">
                        <h4 class="text-primary text-uppercase mb-4">Get In Touch</h4>
                        <div class="d-flex mb-2">
                            <i class="bi bi-geo-alt text-primary me-2 mt-1"></i>
                            <p class="mb-0">123 Street, New York, USA</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-envelope-open text-primary me-2 mt-1"></i>
                            <p class="mb-0">info@example.com</p>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="bi bi-telephone text-primary me-2 mt-1"></i>
                            <p class="mb-0">+012 345 67890</p>
                        </div>
                        <div class="d-flex mt-4">
                            <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i class="fab fa-twitter fw-normal mt-2"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i class="fab fa-facebook-f fw-normal mt-2"></i></a>
                            <a class="btn btn-lg btn-primary btn-lg-square border-inner rounded-0 me-2" href="#"><i class="fab fa-linkedin-in fw-normal mt-2"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-primary text-uppercase mb-4">Quick Links</h4>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Meet The Team</a>
                            <a class="text-secondary mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                            <a class="text-secondary" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                        <h4 class="text-primary text-uppercase mb-4">Newsletter</h4>
                        <p>Amet justo diam dolor rebum lorem sit stet sea justo kasd</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                                <button class="btn btn-primary">Sign Up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid text-secondary py-4" style="background: #111111;">
    <div class="container text-center">
        <p class="mb-0">&copy; <a class="text-white border-bottom" href="#">CakePlanet</a>. All Rights Reserved.
            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
            Designed by <a class="text-white border-bottom" href="https://alphaspheres.com/">AlphaSpheres</a>
        </p>
    </div>
</div>
<!-- Back to Top -->
<a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        updateCartCounter();

        // Event Delegation for Add to Cart Button
        document.body.addEventListener('click', function(event) {
            if (event.target.classList.contains('add-to-cart-btn')) {
                console.log('Add to Cart Button Clicked'); // Debug log

                const product = {
                    id: event.target.dataset.id,
                    title: event.target.dataset.title,
                    price: parseFloat(event.target.dataset.price),
                    image: event.target.dataset.image,
                    quantity: 1,
                };

                addToCart(product);
                updateCartCounter();
            }
        });

        function addToCart(product) {
            if (product.price < 0) {
                alert('Invalid price.');
                return;
            }

            const existingProduct = cart.find(item => item.id === product.id);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push(product);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            alert('Product added to cart!');
        }

        function updateCartCounter() {
            document.getElementById('cart-counter').innerText = cart.reduce(
                (total, item) => total + item.quantity, 0
            );
        }

        // Render Cart Items if on Cart Page
        if (document.getElementById('cart-items')) {
            renderCart();
        }

        function renderCart() {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = '';
            let total = 0;

            console.log('Current Cart:', cart); // Debug log

            if (cart.length === 0) {
                cartContainer.innerHTML = '<p>Your cart is empty.</p>';
                document.getElementById('cart-total').innerText = 'Total: $0.00';
                return;
            }

            cart.forEach((item, index) => {
                total += item.price * item.quantity;
                cartContainer.innerHTML += `
                <div class="cart-item">
                    <img src="${item.image}" class="cart-item-img" />
                    <div class="cart-item-details">
                        <h4>${item.title}</h4>
                        <p>$${item.price.toFixed(2)}</p>
                        <div class="quantity-controls">
                            <button onclick="changeQuantity(${index}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button onclick="changeQuantity(${index}, 1)">+</button>
                        </div>
                    </div>
                    <button class="remove-item-btn" onclick="removeItem(${index})">Remove</button>
                </div>
            `;
            });

            document.getElementById('cart-total').innerText = `Total: $${total.toFixed(2)}`;
        }

        window.changeQuantity = function(index, delta) {
            cart[index].quantity += delta;
            if (cart[index].quantity <= 0) {
                cart.splice(index, 1);
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
            updateCartCounter();
        };

        window.removeItem = function(index) {
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
            updateCartCounter();
        };
        document.getElementById('checkoutModal').addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-primary') && event.target.innerText === 'Send message') {
                event.preventDefault(); // Prevent default form submission

                // Collect form data
                const firstName = document.getElementById('first-name').value;
                const lastName = document.getElementById('last-name').value;
                const phone1 = document.getElementById('phone1').value;
                const phone2 = document.getElementById('phone2').value;
                const email = document.getElementById('email').value;
                const address = document.getElementById('address').value;

                // Prepare the data object
                const orderData = {
                    customer: {
                        firstName,
                        lastName,
                        phone1,
                        phone2,
                        email,
                        address,
                        location: document.getElementById('demo').innerText // Assuming location is displayed here
                    },
                    cart: cart // Use the existing cart variable
                };

                // Send data to the server
                fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=process_checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(orderData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Order placed successfully!');
                            // Optionally, clear the cart and form fields here
                            localStorage.removeItem('cart');
                            cart = [];
                            updateCartCounter();
                            renderCart(); // Clear cart display
                        } else {
                            alert('Failed to place the order. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while placing your order.');
                    });
            }
        });
    });






    document.addEventListener('DOMContentLoaded', function() {
        const heroHeader = document.querySelector('.hero-header');

        // Array of image URLs with the correct WordPress path
        const images = [
            '<?php echo get_template_directory_uri(); ?>/assets/img/hero.jpg',
            '<?php echo get_template_directory_uri(); ?>/assets/img/hero4.jpg',
            '<?php echo get_template_directory_uri(); ?>/assets/img/hero3.jpg',
            '<?php echo get_template_directory_uri(); ?>/assets/img/hero4.jpg'
        ];

        let currentImageIndex = 0;

        function changeBackgroundImage() {
            // Update the background image
            heroHeader.style.backgroundImage = `url(${images[currentImageIndex]})`;
            currentImageIndex = (currentImageIndex + 1) % images.length;
        }

        // Change the background image every 10 seconds
        setInterval(changeBackgroundImage, 10000);

        // Set the first image initially
        changeBackgroundImage();
    });


    const x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
</script>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>