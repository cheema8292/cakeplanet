<?php
// Template Name: cart
get_header();
?>

<div class="container pt-4 pb-4">
    <h2 class="text-center">Shopping Cart</h2>
    <div class="row mt-5">
        <div class="container mt-5">
            <h2>Your Cart</h2>
            <div id="cart-items"></div>
            <h3 id="cart-total">Total: $0.00</h3>
            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#checkoutModal">Go
                To Checkout</button>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="checkoutModalLabel">Checkout</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="first-name" class="col-form-label">First Name:</label>
                        <input type="text" class="form-control" id="first-name">
                    </div>
                    <div class="mb-3">
                        <label for="last-name" class="col-form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last-name">
                    </div>
                    <div class="mb-3">
                        <label for="phone1" class="col-form-label">Phone no:</label>
                        <input type="number" class="form-control" id="phone1">
                    </div>
                    <div class="mb-3">
                        <label for="phone2" class="col-form-label">Other Phone
                            no:(Optional)</label>
                        <input type="number" class="form-control" id="phone2">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="col-form-label">Address:</label>
                        <input type="text" class="form-control" id="address">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="col-form-label">Location:</label>
                        <button type="button" class="btn btn-primary"
                            onclick="getLocation()">Select</button>
                        <p id="demo"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

<?php get_footer(); ?>