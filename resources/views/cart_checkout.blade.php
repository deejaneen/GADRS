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
    {{-- <div class="container mb-4" style="padding-bottom: 60px;">
    <div class="card cart-checkout">
        <div class="card-header">
            CART CHECKOUT
        </div>
        <div class="card-body d-flex">
            <div>
                <h1 class="text-center">GYM RESERVATIONS</h1>
                <hr>
                <form id="gymReservationForm" method="post" action="{{ route('cart.gym_convert') }}">
                    @csrf
                    <input type="hidden" name="cart_ids_gym">
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
                                    {{ date('g:i A', strtotime($gymcart->reservation_time_end)) }}
                                </li>
                                <li>Price: {{ $gymcart->price }}</li>
                                <li>Purpose: {{ $gymcart->purpose }}</li>
                            </ul>
                        </div>
                        <div class="col-2">
                            <i class="fa-solid fa-trash trash-icon"></i>
                            <input type="checkbox" name="gym_cart_ids[]" class="reservation-checkbox gym-cart-checkbox" value="{{ $gymcart->id }}" data-price="{{ $gymcart->price }}">
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <button type="submit" class="d-none"></button>
                </form>
            </div>
        </div>

    </div>
</div> --}}

    <div class="card" id="dormReservationsCartCard">
        <div>
            <h5 class="card-header text-center">DORM RESERVATIONS</h5>
            <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="gymReservationsCartToggleBtn" data-mdb-ripple-init>
                <span class="fa-solid fa-repeat"></span>
                Female Dorm
            </button>
        </div>

        <div class="card-body">
            <form id="dormReservationForm" method="post" action="{{ route('cart.dorm_convert') }}">
                @csrf
                <input type="hidden" name="cart_ids_dorm">
                @foreach ($dormcarts as $dormcart)
                    <div class="row align-items-center">
                        <div class="col-2">
                            <i class="fa-solid fa-plus add-icon ms-3"></i>
                            <i class="fa-solid fa-minus minus-icon ms-3"></i>
                        </div>
                        <div class="col-8">
                            <ul class="list-unstyled">
                                <li>Date: {{ $dormcart->reservation_start_date }} -
                                    {{ date('g:i A', strtotime($dormcart->reservation_start_time)) }},
                                    {{ $dormcart->reservation_end_date }} -
                                    {{ date('g:i A', strtotime($dormcart->reservation_end_time)) }}</li>
                                <li>Price: {{ $dormcart->price }}</li>
                                <li>Purpose: {{ $dormcart->gender }}</li>
                            </ul>
                        </div>
                        <div class="col-2">
                            <i class="fa-solid fa-trash trash-icon"></i>
                            <input type="checkbox" name="dorm_cart_ids[]" class="reservation-checkbox dorm-cart-checkbox"
                                value="{{ $dormcart->id }}" data-price="{{ $dormcart->price }}">
                        </div>
                    </div>
                @endforeach
                <hr>
                <button type="submit" class="d-none"></button>
            </form>
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
            <button class="btn btn-primary btn-lg rounded-pill toogle-btn" data-mdb-ripple-init onclick="confirmation()">
                <i class="fa-solid fa-share"></i> Place Reservation to be Received
            </button>
        </div>
    </nav>
@endsection

@section('scripts')
    <script>
        function confirmation() {
            Swal.fire({
                title: "Are you sure you want to checkout all the selected items?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Yes",
                denyButtonText: `No`
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get selected gym cart IDs
                    const gymCartIds = [];
                    document.querySelectorAll('.gym-cart-checkbox:checked').forEach((checkbox) => {
                        gymCartIds.push(checkbox.value);
                    });
                    console.log('Selected gym cart IDs:', gymCartIds);

                    // Get selected dorm cart IDs
                    const dormCartIds = [];
                    document.querySelectorAll('.dorm-cart-checkbox:checked').forEach((checkbox) => {
                        dormCartIds.push(checkbox.value);
                    });



                    // Include the selected cart IDs in the form data
                    document.querySelector('#gymReservationForm input[name="cart_ids_gym"]').value = JSON.stringify(
                        gymCartIds);
                    document.querySelector('#dormReservationForm input[name="cart_ids_dorm"]').value = JSON
                        .stringify(dormCartIds);


                    // Submit the reservation forms
                    document.getElementById('gymReservationForm').submit();
                    document.getElementById('dormReservationForm').submit();
                } else if (result.isDenied) {
                    Swal.fire("Checkout Failed", "", "info");
                }
            });
        }

        function goBack() {
            window.history.back();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.reservation-checkbox');
            const totalPriceDisplay = document.getElementById('total-price');
            let totalPrice = 0;

            function updateTotalPrice() {
                let newTotalPrice = 0;
                checkboxes.forEach(function(checkbox) {
                    if (checkbox.checked) {
                        const price = parseFloat(checkbox.dataset.price);
                        if (!isNaN(price)) {
                            newTotalPrice += price;
                        }
                    }
                });
                totalPrice = newTotalPrice;
                totalPriceDisplay.textContent = totalPrice.toFixed(2);
            }

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false; // Uncheck the checkbox on page load
                checkbox.addEventListener('change', updateTotalPrice);
            });

            // Display initial total price
            updateTotalPrice();
        });
    </script>
@endsection
