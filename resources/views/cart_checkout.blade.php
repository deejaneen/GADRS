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
    <div class="container">
        <!-- Toggle buttons -->
        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="gymReservationsCartToggleBtn">Dorm Reservations
            Cart</button>
        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="dormReservationsCartToggleBtn"
            style="display: none;">Gym Reservations Cart</button>

        <!-- Gym Reservations Cart -->
        <div class="card" id="gymReservationsCartCard">
            <div>
                <h2 class="card-header text-center">GYM RESERVATIONS</h2>
            </div>
            <div class="card-body">
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
                                    <li>Date: {{ date('F j, Y', strtotime($gymcart->reservation_date)) }},
                                        {{ date('g:i A', strtotime($gymcart->reservation_time_start)) }} -
                                        {{ date('g:i A', strtotime($gymcart->reservation_time_end)) }}
                                    </li>
                                    <li>Price: {{ $gymcart->price }}</li>
                                    <li>Purpose: {{ $gymcart->purpose }}</li>
                                </ul>
                            </div>
                            <div class="col-2">
                                <i class="fa-solid fa-trash trash-icon"></i>
                                <input type="checkbox" name="gym_cart_ids[]" class="reservation-checkbox gym-cart-checkbox"
                                    value="{{ $gymcart->id }}" data-price="{{ $gymcart->price }}">
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <button type="submit" class="d-none"></button>
                </form>
            </div>

        </div>

        <!-- Dorm Reservations Cart -->
        <div class="card" id="dormReservationsCartCard" style="display: none;">
            <div>
                <h2 class="card-header text-center">DORM RESERVATIONS</h2>
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
                                    <li>Date: {{ date('F j, Y', strtotime($dormcart->reservation_start_date)) }} -
                                        {{ date('g:i A', strtotime($dormcart->reservation_start_time)) }},
                                        {{ date('F j, Y', strtotime($dormcart->reservation_end_date)) }} -
                                        {{ date('g:i A', strtotime($dormcart->reservation_end_time)) }}</li>
                                    <li>Price: {{ $dormcart->price }}</li>
                                    <li>Dorm: {{ $dormcart->gender }}</li>
                                </ul>
                            </div>
                            <div class="col-2">
                                <i class="fa-solid fa-trash trash-icon"></i>
                                <input type="checkbox" name="dorm_cart_ids[]"
                                    class="reservation-checkbox dorm-cart-checkbox" value="{{ $dormcart->id }}"
                                    data-price="{{ $dormcart->price }}">
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <button type="submit" class="d-none"></button>
                </form>
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
            <button class="btn btn-primary btn-lg rounded-pill confirm toogle-btn" data-mdb-ripple-init onclick="confirmation()">
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

                    // Get selected dorm cart IDs
                    const dormCartIds = [];
                    document.querySelectorAll('.dorm-cart-checkbox:checked').forEach((checkbox) => {
                        dormCartIds.push(checkbox.value);
                    });

                    if (gymCartIds.length > 0) {
                        // Include the selected gym cart IDs in the form data
                        document.querySelector('#gymReservationForm input[name="cart_ids_gym"]').value = JSON
                            .stringify(gymCartIds);
                    }

                    if (dormCartIds.length > 0) {
                        // Include the selected dorm cart IDs in the form data
                        document.querySelector('#dormReservationForm input[name="cart_ids_dorm"]').value = JSON
                            .stringify(dormCartIds);
                    }

                    // Submit the forms
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

        // Function to update total price based on selected checkboxes
        function updateTotalPrice() {
            const checkboxes = document.querySelectorAll('.reservation-checkbox');
            const totalPriceDisplay = document.getElementById('total-price');
            let totalPrice = 0;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    const price = parseFloat(checkbox.dataset.price);
                    if (!isNaN(price)) {
                        totalPrice += price;
                    }
                }
            });

            totalPriceDisplay.textContent = totalPrice.toFixed(2);
        }

        function clearPrice() {
            const totalPriceDisplay = document.getElementById('total-price');
            totalPriceDisplay.textContent = "0.00";
        }

        document.addEventListener('DOMContentLoaded', function() {
            const gymToggleBtn = document.getElementById('gymReservationsCartToggleBtn');
            const dormToggleBtn = document.getElementById('dormReservationsCartToggleBtn');
            const gymCard = document.getElementById('gymReservationsCartCard');
            const dormCard = document.getElementById('dormReservationsCartCard');
            const checkboxes = document.querySelectorAll('.reservation-checkbox');

            gymToggleBtn.addEventListener('click', function() {
                clearPrice();
                gymCard.style.display = 'block';
                dormCard.style.display = 'none';
                gymToggleBtn.style.display = 'none';
                dormToggleBtn.style.display = 'block';

                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            });

            dormToggleBtn.addEventListener('click', function() {
                clearPrice();
                dormCard.style.display = 'block';
                gymCard.style.display = 'none';
                dormToggleBtn.style.display = 'none';
                gymToggleBtn.style.display = 'block';

                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            });

            // Attach updateTotalPrice function to change event of checkboxes
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', updateTotalPrice);
            });

            // Display initial total price
            updateTotalPrice();
        });
    </script>
@endsection
