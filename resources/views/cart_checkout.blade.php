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
                    <input type="hidden" class="form-control" id="hidden_companyName" name="hidden_companyName">
                    <input type="hidden" class="form-control" id="hidden_address" name="hidden_address">
                    <input type="hidden" class="form-control" id="hidden_nameRepresentative"
                        name="hidden_nameRepresentative">
                    <input type="hidden" class="form-control" id="hidden_contactNumber" name="hidden_contactNumber">
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
                    <input type="hidden" class="form-control" id="hidden_surname" name="hidden_surname">
                    <input type="hidden" class="form-control" id="hidden_firstname" name="hidden_firstname">
                    <input type="hidden" class="form-control" id="hidden_middlename" name="hidden_middlename">
                    <input type="hidden" class="form-control" id="hidden_office" name="hidden_office">
                    <input type="hidden" class="form-control" id="hidden_office_address" name="hidden_office_address">
                    <input type="hidden" class="form-control" id="hidden_position" name="hidden_position">
                    <input type="hidden" class="form-control" id="hidden_contact_number_dorm"
                        name="hidden_contact_number_dorm">
                    <input type="hidden" class="form-control" id="hidden_email" name="hidden_email">
                    <input type="hidden" class="form-control" id="hidden_ei_number" name="hidden_ei_number">
                    <input type="hidden" class="form-control" id="hidden_id_presented" name="hidden_id_presented">
                    <input type="hidden" class="form-control" id="hidden_pos" name="hidden_pos">
                    <input type="hidden" class="form-control" id="hidden_coaEm_name" name="hidden_coaEm_name">
                    <input type="hidden" class="form-control" id="hidden_coaEm_relationshipGuest"
                        name="hidden_coaEm_relationshipGuest">
                    <input type="hidden" class="form-control" id="hidden_coaEm_office" name="hidden_coaEm_office">
                    <input type="hidden" class="form-control" id="hidden_coaEm_office_address"
                        name="hidden_coaEm_office_address">
                    <input type="hidden" class="form-control" id="hidden_ptn" name="hidden_ptn">
                    <input type="hidden" class="form-control" id="hidden_ptn_contact" name="hidden_ptn_contact">
                    <input type="hidden" class="form-control" id="hidden_ptn_home_address"
                        name="hidden_ptn_home_address">

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
                                    <td class="button-center">
                                        <span class="ri-delete-bin-line"></span>

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

@include('cart.cart-to-form-modal')

@section('bottom_nav')
    <nav class="navbar fixed-bottom">
        <div class="container-fluid">
            <a class="navbar-brand">Total:₱<span id="total-price">0</span></a>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something"
                    checked>
                <label class="form-check-label">Agree With <a data-bs-toggle="modal" data-bs-target="#GFG"><u>Terms and
                            Conditions</u></a></label>
            </div>
            {{-- <button class="btn btn-primary btn-lg rounded-pill confirm toogle-btn" data-mdb-ripple-init
                onclick="confirmation()">
                <i class="fa-solid fa-share"></i> Place Reservation to be Received
            </button> --}}

            <button type="button" class="btn btn-primary btn-lg rounded-pill confirm toogle-btn" onclick="openModal()">
                <i class="fa-solid fa-share"></i> Place item into Form
            </button>


        </div>
    </nav>
@endsection

@section('scripts')
    <script>
        function openModal() {
            // Check if any checkbox is selected
            const checkboxes = document.querySelectorAll('.reservation-checkbox');
            let isAnyCheckboxSelected = false;
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    isAnyCheckboxSelected = true;
                    break;
                }
            }

            // If at least one checkbox is selected, open the modal
            if (isAnyCheckboxSelected) {
                const gymCardVisible = window.getComputedStyle(document.getElementById(
                    'gymReservationsCartCard')).display !== 'none';
                const dormCardVisible = window.getComputedStyle(document.getElementById(
                    'dormReservationsCartCard')).display !== 'none';
                if (gymCardVisible) {
                    $('#cartToFormModalGym').modal('show');
                } else if (dormCardVisible) {
                    $('#cartToFormModalDorm').modal('show');
                }
            } else {
                // Otherwise, display a message
                Swal.fire("Please select items to place into form", "", "warning");
            }
        }

        // Declare variable to store DataTable instance
        let dormTable;

        // Function to initialize DataTable for dorm reservations
        function initializeDormTable() {
            if (!dormTable) {
                dormTable = $('#dormCartReservationsTable').DataTable({
                    "paging": false,
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
                denyButtonText: `No`,
                customClass: {
                        popup: 'small-modal'
                    }
            }).then((result) => {
                if (result.isConfirmed) {
                    // // Check if gym reservations card is visible
                    // const gymCardVisible = document.getElementById('gymReservationsCartCard').style.display !==
                    //     'none';
                    // // Check if dorm reservations card is visible
                    // const dormCardVisible = document.getElementById('dormReservationsCartCard').style.display !==
                    //     'none';
                    // Prevent default form submission
                    const gymCardVisible = window.getComputedStyle(document.getElementById(
                        'gymReservationsCartCard')).display !== 'none';
                    const dormCardVisible = window.getComputedStyle(document.getElementById(
                        'dormReservationsCartCard')).display !== 'none';


                    if (gymCardVisible) {
                        const companyName = document.getElementById('companyName').value;
                        const address = document.getElementById('address').value;
                        const nameRepresentative = document.getElementById('nameRepresentative').value;
                        const contactNumber = document.getElementById('contactNumber').value;


                        // Check if any field is empty
                        if (!companyName || !address || !nameRepresentative || !contactNumber) {
                            document.getElementById('companyName').placeholder = (!companyName) ?
                                "Please fill in Company Name" : "";
                            document.getElementById('address').placeholder = (!address) ? "Please fill in Address" :
                                "";
                            document.getElementById('nameRepresentative').placeholder = (!nameRepresentative) ?
                                "Please fill in Name Representative" : "";
                            document.getElementById('contactNumber').placeholder = (!contactNumber) ?
                                "Please fill in Contact Number" : "";
                            return; // Prevent form submission
                        }

                        // Set values of hidden input fields in the form
                        document.getElementById('hidden_companyName').value = companyName;
                        document.getElementById('hidden_address').value = address;
                        document.getElementById('hidden_nameRepresentative').value = nameRepresentative;
                        document.getElementById('hidden_contactNumber').value = contactNumber;

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
                        var dormcarts = {!! json_encode($dormcarts) !!};
                        // Get selected dorm cart IDs
                        const dormCartIds = [];
                        document.querySelectorAll('.dorm-cart-checkbox:checked').forEach((checkbox) => {
                            dormCartIds.push(checkbox.value);
                        });

                        let isReservorCOA = true;

                        // Loop through dormcarts data
                        for (let i = 0; i < dormcarts.length; i++) {
                            const dormcart = dormcarts[i];
                            if (dormCartIds.includes(dormcart.id.toString())) {
                                // Check if the occupant_type is 'COA'
                                if (dormcart.occupant_type === 'Non COAn') {
                                    isReservorCOA = false;
                                    break;
                                }
                            }
                        }


                        const surname = document.getElementById('surname').value;
                        const firstname = document.getElementById('firstname').value;
                        const middlename = document.getElementById('middlename').value;
                        const office = document.getElementById('office').value;
                        const office_address = document.getElementById('office_address').value;
                        const position = document.getElementById('position').value;
                        const contact_number_dorm = document.getElementById('contact_number_dorm').value;
                        const email = document.getElementById('email').value;
                        const ei_number = document.getElementById('ei_number').value;
                        const id_presented = document.getElementById('id_presented').value;
                        const pos = document.getElementById('pos').value;
                        const coaEm_name = document.getElementById('coaEm_name').value;
                        const coaEm_relationshipGuest = document.getElementById('coaEm_relationshipGuest').value;
                        const coaEm_office = document.getElementById('coaEm_office').value;
                        const coaEm_office_address = document.getElementById('coaEm_office_address').value;
                        const ptn = document.getElementById('ptn').value;
                        const ptn_contact = document.getElementById('ptn_contact').value;
                        const ptn_home_address = document.getElementById('ptn_home_address').value;

                        if (isReservorCOA) {
                            // Check if any field is empty
                            if (!surname || !firstname || !middlename || !office || !office_address || !position ||
                                !
                                contact_number_dorm || !email || !ei_number || !id_presented || !pos || !
                                coaEm_name || !
                                coaEm_relationshipGuest || !coaEm_office || !coaEm_office_address || !ptn || !
                                ptn_contact || !ptn_home_address) {
                                document.getElementById('surname').placeholder = (!surname) ?
                                    "Please fill in your surname" : "";
                                document.getElementById('firstname').placeholder = (!firstname) ?
                                    "Please fill in your firstname" : "";
                                document.getElementById('middlename').placeholder = (!middlename) ?
                                    "Please fill in your middlename" : "";
                                document.getElementById('office').placeholder = (!office) ?
                                    "Please fill in your office" : "";
                                document.getElementById('office_address').placeholder = (!office_address) ?
                                    "Please fill in your office address" : "";
                                document.getElementById('position').placeholder = (!position) ?
                                    "Please fill in your position" : "";
                                document.getElementById('contact_number_dorm').placeholder = (!
                                        contact_number_dorm) ?
                                    "Please fill in your contact number dorm" : "";
                                document.getElementById('email').placeholder = (!email) ?
                                    "Please fill in your email" :
                                    "";
                                document.getElementById('ei_number').placeholder = (!ei_number) ?
                                    "Please fill in your EI number" : "";
                                document.getElementById('id_presented').placeholder = (!id_presented) ?
                                    "Please fill in your ID presented" : "";
                                document.getElementById('pos').placeholder = (!pos) ? "Please fill in your POS" :
                                    "";
                                document.getElementById('coaEm_name').placeholder = (!coaEm_name) ?
                                    "Please fill in COA EM name" : "";
                                document.getElementById('coaEm_relationshipGuest').placeholder = (!
                                    coaEm_relationshipGuest) ? "Please fill in COA EM relationshipGuest" : "";
                                document.getElementById('coaEm_office').placeholder = (!coaEm_office) ?
                                    "Please fill in COA EM office" : "";
                                document.getElementById('coaEm_office_address').placeholder = (!
                                        coaEm_office_address) ?
                                    "Please fill in COA EM office address" : "";
                                document.getElementById('ptn').placeholder = (!ptn) ? "Please fill in PTN" : "";
                                document.getElementById('ptn_contact').placeholder = (!ptn_contact) ?
                                    "Please fill in PTN contact" : "";
                                document.getElementById('ptn_home_address').placeholder = (!ptn_home_address) ?
                                    "Please fill in PTN home address" : "";
                                return; // Prevent form submission
                            }
                        } else {
                            if (!surname || !firstname || !middlename || !office || !office_address || !position ||
                                !
                                contact_number_dorm || !email || !ei_number || !id_presented || !pos  || !ptn || !
                                ptn_contact || !ptn_home_address) {
                                document.getElementById('surname').placeholder = (!surname) ?
                                    "Please fill in your surname" : "";
                                document.getElementById('firstname').placeholder = (!firstname) ?
                                    "Please fill in your firstname" : "";
                                document.getElementById('middlename').placeholder = (!middlename) ?
                                    "Please fill in your middlename" : "";
                                document.getElementById('office').placeholder = (!office) ?
                                    "Please fill in your office" : "";
                                document.getElementById('office_address').placeholder = (!office_address) ?
                                    "Please fill in your office address" : "";
                                document.getElementById('position').placeholder = (!position) ?
                                    "Please fill in your position" : "";
                                document.getElementById('contact_number_dorm').placeholder = (!
                                        contact_number_dorm) ?
                                    "Please fill in your contact number dorm" : "";
                                document.getElementById('email').placeholder = (!email) ?
                                    "Please fill in your email" :
                                    "";
                                document.getElementById('ei_number').placeholder = (!ei_number) ?
                                    "Please fill in your EI number" : "";
                                document.getElementById('id_presented').placeholder = (!id_presented) ?
                                    "Please fill in your ID presented" : "";
                                document.getElementById('pos').placeholder = (!pos) ? "Please fill in your POS" :
                                    "";
                                document.getElementById('coaEm_name').placeholder = (!coaEm_name) ?
                                    "Please fill in COA EM name" : "";
                                document.getElementById('coaEm_relationshipGuest').placeholder = (!
                                    coaEm_relationshipGuest) ? "Please fill in COA EM relationshipGuest" : "";
                                document.getElementById('coaEm_office').placeholder = (!coaEm_office) ?
                                    "Please fill in COA EM office" : "";
                                document.getElementById('coaEm_office_address').placeholder = (!
                                        coaEm_office_address) ?
                                    "Please fill in COA EM office address" : "";
                                document.getElementById('ptn').placeholder = (!ptn) ? "Please fill in PTN" : "";
                                document.getElementById('ptn_contact').placeholder = (!ptn_contact) ?
                                    "Please fill in PTN contact" : "";
                                document.getElementById('ptn_home_address').placeholder = (!ptn_home_address) ?
                                    "Please fill in PTN home address" : "";
                                return; // Prevent form submission
                            }
                        }


                        // Set values of hidden input fields in the form
                        document.getElementById('hidden_surname').value = surname;
                        document.getElementById('hidden_firstname').value = firstname;
                        document.getElementById('hidden_middlename').value = middlename;
                        document.getElementById('hidden_office').value = office;
                        document.getElementById('hidden_office_address').value = office_address;
                        document.getElementById('hidden_position').value = position;
                        document.getElementById('hidden_contact_number_dorm').value = contact_number_dorm;
                        document.getElementById('hidden_email').value = email;
                        document.getElementById('hidden_ei_number').value = ei_number;
                        document.getElementById('hidden_id_presented').value = id_presented;
                        document.getElementById('hidden_pos').value = pos;
                        document.getElementById('hidden_coaEm_name').value = coaEm_name;
                        document.getElementById('hidden_coaEm_relationshipGuest').value = coaEm_relationshipGuest;
                        document.getElementById('hidden_coaEm_office').value = coaEm_office;
                        document.getElementById('hidden_coaEm_office_address').value = coaEm_office_address;
                        document.getElementById('hidden_ptn').value = ptn;
                        document.getElementById('hidden_ptn_contact').value = ptn_contact;
                        document.getElementById('hidden_ptn_home_address').value = ptn_home_address;



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

        function resetFormGymCartModal() {
            console.log("Resetting form...");
            var form = document.getElementById("cartToFormModalGymForm");
            if (form) {
                form.reset(); // Reset the form
                console.log("Form reset successfully.");
            } else {
                console.error("Form not found.");
            }
        }

        function resetFormDormCartModal() {
            console.log("Resetting form...");
            var form = document.getElementById("cartToFormModalDormForm");
            if (form) {
                form.reset(); // Reset the form
                console.log("Form reset successfully.");
            } else {
                console.error("Form not found.");
            }
        }
    </script>
@endsection
