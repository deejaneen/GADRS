@extends('layout.weblayout')
@section('secondary_nav')
    <nav class="navbar sticky-top bg-body-tertiary secondary_nav">
        <div class="container-fluid">
            <a class="navbar-brand" onclick="goBack()">
                <i class="fa-solid fa-backward"> Back</i>
            </a>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container mb-4" style="padding-bottom: 60px;">
        <div class="card cart-checkout">
            <div class="card-header">
                CART CHECKOUT
            </div>
            <div class="card-body d-flex">
                <div class="col-6">
                    <h1 class="text-center">GYM RESERVATIONS</h1>
                    <hr>
                    @foreach ($gymcarts as $gymcart)
                        <div class="row align-items-center">
                            <div class="col-2">
                                <i class="fa-solid fa-plus add-icon ms-3"></i>
                                <i class="fa-solid fa-minus minus-icon ms-3"></i>
                            </div>
                            <div class="col-8">
                                <ul class="list-unstyled">
                                    <li>Date: {{ $gymcart->reservation_date }},
                                        {{ date('g:i A', strtotime($gymcart->reservation_time_start)) }} -
                                        {{ date('g:i A', strtotime($gymcart->reservation_time_end)) }}</li>
                                    <li>Price: {{ $gymcart->price }}</li>
                                    <li>Purpose: {{ $gymcart->purpose }}</li>
                                </ul>
                            </div>
                            <div class="col-2">
                                <i class="fa-solid fa-trash trash-icon"></i>
                                <input type="checkbox" class="reservation-checkbox" data-price="{{ $gymcart->price }}">
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="mt-3">
                        {{ $gymcarts->withQueryString()->links() }}
                    </div>
                </div>
                <div class="vertical-line"></div>
                <div class="col-6">
                    <h1 class="text-center">DORM RESERVATIONS</h1>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col-2">
                            <i class="fa-solid fa-plus add-icon  ms-3"></i>
                            <i class="fa-solid fa-minus minus-icon ms-3"></i>
                        </div>
                        <div class="col-8">
                            <ul class="list-unstyled">
                                <li>Feb 22, 2024 2pm - Feb 24, 2024 12pm</li>
                                <li>COA Employee</li>
                                <li>Activity: Basketball</li>
                            </ul>
                        </div>
                        <div class="col-2">
                            <i class="fa-solid fa-trash trash-icon"></i>
                        </div>
                    </div>
                    <hr>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('bottom_nav')
    <nav class="navbar fixed-bottom">
        <div class="container-fluid">
            <a class="navbar-brand">Total:₱<span id="total-price">0</span></a>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" checked>
                <label class="form-check-label">Agree With <a data-bs-toggle="modal" data-bs-target="#GFG"><u>Terms and
                            Conditions</u></a></label>
            </div>
            <button class="btn btn-primary btn-lg rounded-pill toogle-btn" data-mdb-ripple-init>
                <i class="fa-solid fa-share"></i> Place Reservation to be Received
            </button>
        </div>
    </nav>
@endsection


<div class="modal fade" id="GFG">
    <div class="modal-dialog modal-dialog-scrollable lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="GFGLabel">
                    Modal Scroll independent of the page
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">


                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac nisl sem. Phasellus et nibh vel justo
                blandit sagittis. Suspendisse vehicula tellus at dignissim pulvinar. Vestibulum tristique augue at
                porttitor facilisis. Cras sit amet sem odio. Fusce a risus tristique, gravida magna eu, luctus magna.
                Quisque vehicula, libero sed congue tempor, lectus arcu placerat est, sed molestie mi dui a justo.
                Aenean vel sapien nisi. Nam imperdiet neque eget aliquet rhoncus.

                Ut cursus, orci laoreet commodo commodo, arcu leo placerat libero, et efficitur mi dolor ac ipsum. Sed
                gravida gravida accumsan. Suspendisse mi risus, volutpat eu velit nec, auctor maximus nibh. Donec augue
                neque, mattis vel orci ac, feugiat auctor enim. Praesent nec tortor eget eros varius porta ut at risus.
                Quisque posuere magna sit amet ipsum ultrices ultrices. In eleifend massa sed felis euismod pharetra. In
                hac habitasse platea dictumst. Etiam malesuada pellentesque nisl eget ultricies. Quisque purus libero,
                molestie eget ex a, tempor vestibulum dui. Maecenas at eros nec risus finibus volutpat et ut sem. Nam id
                turpis blandit, molestie augue in, consectetur orci. Suspendisse a iaculis lorem. Suspendisse eget nisi
                id ex dictum elementum. Sed malesuada dolor nunc.

                Morbi a ex nec justo cursus interdum vel eu ante. Fusce sit amet leo ultrices, sodales ante id, maximus
                libero. Fusce justo tortor, ullamcorper faucibus tempor sodales, imperdiet ac massa. Praesent aliquet mi
                urna. Duis id tempus magna, at porttitor nisl. Ut ut odio ac tellus fringilla lacinia eget non arcu.
                Phasellus non diam non dolor mattis iaculis.

                Aliquam aliquam velit et molestie rutrum. Suspendisse in mi dignissim, cursus augue sed, hendrerit
                libero. Pellentesque neque ante, laoreet non posuere nec, laoreet vitae ligula. Morbi et vulputate
                lectus, vitae tristique turpis. Mauris eget nunc enim. Quisque id augue ac felis dapibus suscipit. Nam
                iaculis mollis libero eget congue. Cras placerat erat ac odio iaculis porta. Etiam mollis rutrum mauris,
                eget consectetur mi accumsan quis. Donec fermentum consequat fringilla. Nam et justo tellus.
                Pellentesque laoreet nibh vel venenatis porta. Donec volutpat dui a dui bibendum placerat.

                Proin nunc risus, ullamcorper sagittis tincidunt vulputate, efficitur at enim. Integer luctus facilisis
                consectetur. Curabitur fermentum velit non enim molestie fermentum. Sed eu hendrerit ante, viverra
                porttitor tellus. Phasellus iaculis ligula lacus, a luctus ante mollis ut. Pellentesque sem odio,
                consequat eu aliquet a, egestas eget odio. Fusce convallis, orci eu fringilla porta, tortor nulla luctus
                velit, a blandit libero lacus tempor nulla. Nulla vehicula libero orci. Donec tristique interdum mi nec
                ultrices. Mauris interdum et augue rutrum pellentesque. Quisque faucibus massa quis dictum tincidunt.
                Vestibulum quam eros, semper in magna vitae, porta hendrerit nibh.
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all checkboxes
        const checkboxes = document.querySelectorAll('.reservation-checkbox');
        const totalPriceDisplay = document.getElementById('total-price');

        let totalPrice = 0;

        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false; // Uncheck the checkbox on page load
            checkbox.addEventListener('change', function() {
                // If checkbox is checked, add the price; otherwise, subtract it
                const price = parseFloat(this.dataset.price);
                if (this.checked) {
                    totalPrice += price;
                } else {
                    totalPrice -= price;
                }
                // Update total price display
                totalPriceDisplay.textContent = totalPrice.toFixed(2);
            });
        });

        // Optional: Handle checkout button click
        const checkoutBtn = document.getElementById('checkout-btn');
        checkoutBtn.addEventListener('click', function() {
            // Implement checkout functionality here
            alert('Total price: $' + totalPrice.toFixed(2));
        });
    });
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
