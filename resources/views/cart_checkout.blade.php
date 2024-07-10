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
<div class="container py-4" >
    <!-- Toggle buttons -->
    <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="gymReservationsCartToggleBtn"> <span class="fa-solid fa-repeat"></span> Dorm Reservations
        Cart</button>
    <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="dormReservationsCartToggleBtn" style="display: none;"> <span class="fa-solid fa-repeat"></span> Gym Reservations Cart</button>

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
                <input type="hidden" class="form-control" id="hidden_nameRepresentative" name="hidden_nameRepresentative">
                <input type="hidden" class="form-control" id="hidden_contactNumber" name="hidden_contactNumber">
                <input type="hidden" class="form-control" id="hidden_total_price" name="hidden_total_price">
                <table class="table-home table-hover" id="gymCartReservationsTable" style="width: 100%">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10%">Buttons</th>
                            <th scope="col" style="width: 60%"> Reservation Date</th>
                            <th scope="col" style="width: 10%">Total Price</th>
                            <th scope="col" style="width: 10%">Purpose</th>
                            <th scope="col" style="width: 10%">Checkbox</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gymcarts as $gymcart)
                        <tr class="table-active dorm">
                            <td class="button-center">
                                {{-- <input type="hidden" id="gymCartId" name="gym_cart_id"
                                        value="{{ $gymcart->id }}"> --}}
                                <button type="button" class="button-center delete-button" onclick="confirmDeleteGym('{{ $gymcart->id }}')">
                                    <span class="ri-delete-bin-line"></span>
                                </button>

                            </td>
                            <td>{{ date('F j, Y', strtotime($gymcart->reservation_date)) }},
                                {{ date('g:i A', strtotime($gymcart->reservation_time_start)) }} -
                                {{ date('g:i A', strtotime($gymcart->reservation_time_end)) }}
                            </td>
                            <td>{{ $gymcart->total_price }}</td>
                            <td>{{ $gymcart->purpose }}</td>
                            <td> <input type="checkbox" name="gym_cart_ids[]" class="reservation-checkbox gym-cart-checkbox" value="{{ $gymcart->id }}" data-price="{{ $gymcart->total_price }}"></td>

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
            <input type="checkbox" name="gym_cart_ids[]" class="reservation-checkbox gym-cart-checkbox" value="{{ $gymcart->id }}" data-price="{{ $gymcart->price }}">
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
            <input type="hidden" class="form-control" id="hidden_contact_number_dorm" name="hidden_contact_number_dorm">
            <input type="hidden" class="form-control" id="hidden_email" name="hidden_email">
            <input type="hidden" class="form-control" id="hidden_ei_number" name="hidden_ei_number">
            <input type="hidden" class="form-control" id="hidden_id_presented" name="hidden_id_presented">
            <input type="hidden" class="form-control" id="hidden_pos" name="hidden_pos">
            <input type="hidden" class="form-control" id="hidden_coaEm_name" name="hidden_coaEm_name">
            <input type="hidden" class="form-control" id="hidden_coaEm_relationshipGuest" name="hidden_coaEm_relationshipGuest">
            <input type="hidden" class="form-control" id="hidden_coaEm_office" name="hidden_coaEm_office">
            <input type="hidden" class="form-control" id="hidden_coaEm_office_address" name="hidden_coaEm_office_address">
            <input type="hidden" class="form-control" id="hidden_ptn" name="hidden_ptn">
            <input type="hidden" class="form-control" id="hidden_ptn_contact" name="hidden_ptn_contact">
            <input type="hidden" class="form-control" id="hidden_ptn_home_address" name="hidden_ptn_home_address">

            <table class="table-home table-hover" id="dormCartReservationsTable" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%">Buttons</th>
                        <th scope="col" style="width: 60%"> Reservation Date</th>
                        <th scope="col" style="width: 10%">Total Price</th>
                        <th scope="col" style="width: 10%">No of Beds</th>
                        <th scope="col" style="width: 10%">Dorm</th>
                        <th scope="col" style="width: 10%">Checkbox</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($dormcarts as $dormcart)
                    <tr class="table-active dorm">
                        <td class="button-center">
                            {{-- <input type="hidden" id="dormCartId" name="dorm_cart_id"
                                        value="{{ $dormcart->id }}"> --}}
                            <button type="button" class="button-center delete-button" onclick="confirmDeleteDorm('{{ $dormcart->id }}')">
                                <span class="ri-delete-bin-line"></span>
                            </button>

                        </td>
                        <td>{{ date('F j, Y', strtotime($dormcart->reservation_start_date)) }} -
                            {{ date('g:i A', strtotime($dormcart->reservation_start_time)) }},
                            {{ date('F j, Y', strtotime($dormcart->reservation_end_date)) }} -
                            {{ date('g:i A', strtotime($dormcart->reservation_end_time)) }}
                        </td>
                        <td>{{ $dormcart->total_price }}</td>
                        <td>{{ $dormcart->quantity }}</td>
                        <td>{{ $dormcart->gender }}</td>
                        <td> <input type="checkbox" name="dorm_cart_ids[]" class="reservation-checkbox dorm-cart-checkbox" value="{{ $dormcart->id }}" data-price="{{ $dormcart->total_price }}"></td>

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
        <input type="checkbox" name="dorm_cart_ids[]" class="reservation-checkbox dorm-cart-checkbox" value="{{ $dormcart->id }}" data-price="{{ $dormcart->price }}">
    </div>
</div> --}}
<hr>
<button type="submit" class="d-none"></button>
</form>
</div>
</div>

<div>
    <form class="delete-form-dorm" action="{{ route('cart.destroy.dorm') }}" method="post">
        @csrf
        @method('delete')
        <input type="hidden" id="dormCartIdDelete" name="dorm_cart_id_delete">
    </form>
</div>

<div>
    <form class="delete-form-gym" action="{{ route('cart.destroy.gym') }}" method="post">
        @csrf
        @method('delete')
        <input type="hidden" id="gymCartIdDelete" name="gym_cart_id_delete">
    </form>
</div>
</div>
@endsection

@include('cart.cart-to-form-modal')
@include('cart.terms-and-condition-gym')
@include('cart.terms-and-condition-dorm')
@section('bottom_nav')
<nav class="navbar fixed-bottom">
    <div class="container-fluid">
        <a class="navbar-brand">Total:₱<span id="total-price">0</span></a>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="check1" name="option1">
            <label class="form-check-label">Agree With
                <a id="termsLink" data-bs-toggle="modal"><u>Terms and Conditions</u></a>
            </label>
            <p id="checkboxMessage" style="display: none; color: red;">Please agree to the terms and conditions.</p>
        </div>
        <button type="button" class="btn btn-primary btn-lg rounded-pill confirm toogle-btn" onclick="openModal()">
            <i class="fa-solid fa-share"></i> Place item into Form
        </button>


    </div>
</nav>
@endsection

@include('cart.cart_checkout_scripts')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const termsLink = document.getElementById('termsLink');
        const gymToggleBtn = document.getElementById('gymReservationsCartToggleBtn');
        const dormToggleBtn = document.getElementById('dormReservationsCartToggleBtn');
        termsLink.setAttribute('data-bs-target', '#TermsAndConditionGym');


        // Add event listeners to toggle buttons
        gymToggleBtn.addEventListener('click', function() {
            termsLink.setAttribute('data-bs-target', '#TermsAndConditionDorm');
        });

        dormToggleBtn.addEventListener('click', function() {
            termsLink.setAttribute('data-bs-target', '#TermsAndConditionGym');
        });


        //Terms and Conditions
        const termsCheckbox = document.getElementById('check1');
        const placeItemButton = document.querySelector('.confirm.toogle-btn');
        const messageElement = document.getElementById('checkboxMessage');

        // Initially disable the button and show message
        placeItemButton.disabled = true;
        messageElement.style.display = 'block';

        // Add event listener to checkbox
        termsCheckbox.addEventListener('change', function() {
            if (termsCheckbox.checked) {
                placeItemButton.disabled = false;
                messageElement.style.display = 'none';
            } else {
                placeItemButton.disabled = true;
                messageElement.style.display = 'block';
            }
        });
    });
</script>