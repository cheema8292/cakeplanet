<?php
// Template Name: cart
get_header();
?>

<body>
    <style>
        .card {
            padding: 20px;
            margin-bottom: 20px;
        }

        .store-item {
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .image-store {
            width: 100px;
        }

        .btn-quantity-container {
            gap: 0.5rem;
        }

        .p-quantity {
            margin: 0 5px;
        }
    </style>
    <div class="container pt-4 pb-4">
        <h2 class="text-center">Shopping Cart</h2>
        <div class="row mt-5">
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <h4 id="cart-header">Cart (0 items)</h4>
                    <div id="cart-items"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="card">
                    <h4>The total amount of</h4>
                    <div class="store-item">
                        <p>Temporary amount</p>
                        <p id="temp-amount">$0.00</p>
                        <p>Shipping</p>
                        <p>Gratis</p>
                        <div class="bottom-line"></div>
                        <p>Total amount (Including VAT)</p>
                        <p id="total-amount">$0.00</p>
                        <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#checkoutModal">Go
                            To Checkout</button>

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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>
</body>

<script>
    const dataStore = [
        {
            id: 1,
            image: "https://images.unsplash.com/photo-1617171594202-100a53bdfe04?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTA4NjE0MjN8&ixlib=rb-4.0.3&q=85",
            name: "Blue Hoodie",
            code: "Hodie-B",
            color: "Blue",
            size: "M",
            price: 17.99,
            quantity: 1
        },
        {
            id: 2,
            image: "https://images.unsplash.com/photo-1620799140188-3b2a02fd9a77?crop=entropy&cs=srgb&fm=jpg&ixid=M3wzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2OTA4NjE0MjN8&ixlib=rb-4.0.3&q=85",
            name: "White Hoodie",
            code: "Hodie-W",
            color: "White",
            size: "M",
            price: 35.99,
            quantity: 1
        }
    ];

    let orders = dataStore.map(item => ({ ...item, quantity: 1 }));

    function updateCart() {
        const cartItemsDiv = document.getElementById("cart-items");
        const cartHeader = document.getElementById("cart-header");
        const tempAmount = document.getElementById("temp-amount");
        const totalAmount = document.getElementById("total-amount");

        let cartHtml = "";
        let totalPrice = 0;
        let totalItems = 0;

        orders.forEach((item, index) => {
            if (item.quantity > 0) {
                totalItems += item.quantity;
                totalPrice += item.price * item.quantity;

                cartHtml += `
                    <div class="store-item">
                      <div class="row">
                        <div class="col-lg-3">
                          <img class="image-store" src="${item.image}" alt="${item.name}">
                        </div>
                        <div class="col-lg-9">
                          <h4>${item.name}</h4>
                          <p>${item.code} - ${item.color} - Size: ${item.size}</p>
                          <div class="btn-quantity-container">
                            <button class="btn btn-secondary" onclick="updateQuantity(${index}, -1)">-</button>
                            <span class="p-quantity">${item.quantity}</span>
                            <button class="btn btn-secondary" onclick="updateQuantity(${index}, 1)">+</button>
                          </div>
                          <p>$${item.price.toFixed(2)}</p>
                        </div>
                      </div>
                    </div>`;
            }
        });

        cartItemsDiv.innerHTML = cartHtml || "<p>No items in cart</p>";
        cartHeader.textContent = `Cart (${totalItems} items)`;
        tempAmount.textContent = `$${totalPrice.toFixed(2)}`;
        totalAmount.textContent = `$${totalPrice.toFixed(2)}`;
    }

    function updateQuantity(index, change) {
        orders[index].quantity = Math.max(0, orders[index].quantity + change);
        updateCart();
    }

    document.addEventListener("DOMContentLoaded", () => updateCart());
</script>
<script>
    const x = document.getElementById("demo");

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
    }
</script>

</html>