<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">My Cart</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <div id="root-cart"></div>
        <div class="sidebar-cart">
            <!-- <div class="head">
                        <p>My Cart</p>
                    </div> -->
            <div id="cartItem">Your cart is empty</div>
            <div class="foot">
                <h3>Total</h3>
                <h2 id="total">$ 0.00</h2>
            </div>
        </div>

    </div>
    <hr>
    <div class="offcanvas-footer d-flex justify-content-center">
        <a href="{{ route('cart_check') }}">
            <button class="btn btn-info btn-lg rounded" data-mdb-ripple-init>Proceed With Reservation</button>
        </a>

    </div>

</div>
