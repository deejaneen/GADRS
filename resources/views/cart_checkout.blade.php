@extends('layout.weblayout')

{{-- @section('secondary_nav')
    <nav class="navbar sticky-top bg-body-tertiary secondary_nav">
        <div class="container-fluid">
            <a class="navbar-brand" onclick="goBack()">
                <i class="fa-solid fa-backward"> Back</i>
            </a>
        </div>
    </nav>
@endsection --}}

@section('content')
    <div class="container">
        <!-- Toggle buttons -->
        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="gymReservationsCartToggleBtn"> <span
                class="fa-solid fa-repeat"></span> Dorm Reservations
            Cart</button>
        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="dormReservationsCartToggleBtn"
            style="display: none;"> <span class="fa-solid fa-repeat"></span> Gym Reservations Cart</button>

        <!-- Gym Reservations Cart -->
        <div class="card" id="gymReservationsCartCard">
            <div>
                <h2 class="card-header text-center checkout">GYM RESERVATIONS</h2>
            </div>
            <div class="card-body-checkout">
                <form id="gymReservationForm" method="post" action="{{ route('cart.gym_convert') }}">
                    @csrf
                    <input type="hidden" name="cart_ids_gym">
                    <table class="table-home table-hover" id="gymCartReservationsTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%">Buttons</th>
                                <th scope="col" style="width: 60%"> Reservation Date</th>
                                <th scope="col" style="width: 10%">Price</th>
                                <th scope="col"style="width: 10%">Dorm</th>
                                <th scope="col" style="width: 10%">Checkbox</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gymcarts as $gymcart)
                                <tr class="table-active dorm">
                                    <td><i class="fa-solid fa-plus add-icon ms-3"></i>
                                        <i class="fa-solid fa-minus minus-icon ms-3"></i>
                                    </td>
                                    <td>{{ date('F j, Y', strtotime($gymcart->reservation_date)) }},
                                        {{ date('g:i A', strtotime($gymcart->reservation_time_start)) }} -
                                        {{ date('g:i A', strtotime($gymcart->reservation_time_end)) }}</td>
                                    <td>{{ $gymcart->price }}</td>
                                    <td>{{ $gymcart->purpose }}</td>
                                    <td> <input type="checkbox" name="gym_cart_ids[]"
                                            class="reservation-checkbox gym-cart-checkbox" value="{{ $gymcart->id }}"
                                            data-price="{{ $gymcart->price }}"></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- @foreach ($gymcarts as $gymcart)
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
                            <div class="co@l-2">
                                <i class="fa-solid fa-trash trash-icon"></i>
                                <input type="checkbox" name="gym_cart_ids[]" class="reservation-checkbox gym-cart-checkbox"
                                    value="{{ $gymcart->id }}" data-price="{{ $gymcart->price }}">
                            </div>
                        </div>
                    @endforeach --}}
                    <hr>
                    <button type="submit" class="d-none"></button>
                </form>
            </div>

        </div>

        <!-- Dorm Reservations Cart -->
        <div class="card" id="dormReservationsCartCard" style="display: none;">
            <div>
                <h2 class="card-header text-center checkout">DORM RESERVATIONS</h2>
            </div>
            <div class="card-body-checkout">
                <form id="dormReservationForm" method="post" action="{{ route('cart.dorm_convert') }}">
                    @csrf
                    <input type="hidden" name="cart_ids_dorm">
                    <table class="table-home table-hover" id="dormCartReservationsTable" style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%">Buttons</th>
                                <th scope="col" style="width: 60%"> Reservation Date</th>
                                <th scope="col" style="width: 10%">Price</th>
                                <th scope="col"style="width: 10%">Dorm</th>
                                <th scope="col" style="width: 10%">Checkbox</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dormcarts as $dormcart)
                                <tr class="table-active dorm">
                                    <td><i class="fa-solid fa-plus add-icon ms-3"></i>
                                        <i class="fa-solid fa-minus minus-icon ms-3"></i>
                                    </td>
                                    <td>{{ date('F j, Y', strtotime($dormcart->reservation_start_date)) }} -
                                        {{ date('g:i A', strtotime($dormcart->reservation_start_time)) }},
                                        {{ date('F j, Y', strtotime($dormcart->reservation_end_date)) }} -
                                        {{ date('g:i A', strtotime($dormcart->reservation_end_time)) }}</td>
                                    <td>{{ $dormcart->price }}</td>
                                    <td>{{ $dormcart->gender }}</td>
                                    <td> <input type="checkbox" name="dorm_cart_ids[]"
                                            class="reservation-checkbox dorm-cart-checkbox" value="{{ $dormcart->id }}"
                                            data-price="{{ $dormcart->price }}"></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="row align-items-center">
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
                        </div> --}}
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
            <button class="btn btn-primary btn-lg rounded-pill confirm toogle-btn" data-mdb-ripple-init
                onclick="confirmation()">
                <i class="fa-solid fa-share"></i> Place Reservation to be Received
            </button>
        </div>
    </nav>
@endsection

@section('scripts')
    <script>
        // Declare variable to store DataTable instance
        let dormTable;

        // Function to initialize DataTable for dorm reservations
        function initializeDormTable() {
            if (!dormTable) {
                dormTable = $('#dormCartReservationsTable').DataTable({
                    "paging" : false,
                    "pageLength": 5,
                    "lengthMenu": [5, 10, 15, 20],
                    "columnDefs": [{
                        "targets": "_all",
                        "className": "dt-head-left"
                    }],
                });
            }
        }

        // Function to destroy DataTable for dorm reservations
        function destroyDormTable() {
            if (dormTable) {
                dormTable.destroy();
                dormTable = null; // Reset dormTable variable
            }
        }


        function confirmation() {
            Swal.fire({
                title: "Are you sure you want to checkout all the selected items?",
                showDenyButton: true,
                confirmButtonText: "Yes",
                denyButtonText: `No`
            }).then((result) => {
                if (result.isConfirmed) {
                    // // Check if gym reservations card is visible
                    // const gymCardVisible = document.getElementById('gymReservationsCartCard').style.display !==
                    //     'none';
                    // // Check if dorm reservations card is visible
                    // const dormCardVisible = document.getElementById('dormReservationsCartCard').style.display !==
                    //     'none';

                    const gymCardVisible = window.getComputedStyle(document.getElementById(
                        'gymReservationsCartCard')).display !== 'none';
                    const dormCardVisible = window.getComputedStyle(document.getElementById(
                        'dormReservationsCartCard')).display !== 'none';


                    if (gymCardVisible) {
                        // Get selected gym cart IDs
                        const gymCartIds = [];
                        document.querySelectorAll('.gym-cart-checkbox:checked').forEach((checkbox) => {
                            gymCartIds.push(checkbox.value);
                        });

                        if (gymCartIds.length > 0) {
                            // Include the selected gym cart IDs in the form data
                            document.querySelector('#gymReservationForm input[name="cart_ids_gym"]').value = JSON
                                .stringify(gymCartIds);
                            // Submit the gym form
                            document.getElementById('gymReservationForm').submit();
                        } else {
                            Swal.fire("Please select items to checkout", "", "warning");
                        }
                    } else if (dormCardVisible) {
                        // Get selected dorm cart IDs
                        const dormCartIds = [];
                        document.querySelectorAll('.dorm-cart-checkbox:checked').forEach((checkbox) => {
                            dormCartIds.push(checkbox.value);
                        });

                        if (dormCartIds.length > 0) {
                            // Include the selected dorm cart IDs in the form data
                            document.querySelector('#dormReservationForm input[name="cart_ids_dorm"]').value = JSON
                                .stringify(dormCartIds);
                            // Submit the dorm form
                            document.getElementById('dormReservationForm').submit();
                        } else {
                            Swal.fire("Please select items to checkout", "", "warning");
                        }
                    }
                } else if (result.isDenied) {
                    Swal.fire("Checkout Cancelled", "", "info");
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
            // const gymCard = document.getElementById('gymReservationsCartCard');
            // const dormCard = document.getElementById('dormReservationsCartCard');
            const checkboxes = document.querySelectorAll('.reservation-checkbox');

            gymToggleBtn.addEventListener('click', function() {
                clearPrice();
                // gymCard.style.display = 'block';
                // dormCard.style.display = 'none';
                gymToggleBtn.style.display = 'none';
                dormToggleBtn.style.display = 'block';

                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            });

            dormToggleBtn.addEventListener('click', function() {

                clearPrice();
                // dormCard.style.display = 'block';
                // gymCard.style.display = 'none';
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

