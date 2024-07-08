@extends('layout.cashierlayout')

@section('cashierdashboard')
<!-- <aside>
        <div class="top">
            <div class="logo">
                <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                <h2 class="primary-light">COA <span class="danger">CAR</span></h2>
            </div>
        <div class="close" id="close-btn">
                <span class="ri-close-fill"></span>
            </div>

            <div class="sidebar">
                <a href="{{ route('cashierhome') }}">
                    <span class="ri-dashboard-line ">
                        <h3>Dashboard</h3>
                    </span>
                </a>

                <a href="{{ route('cashierforpayment') }}" class="active">
                    <span class="ri-wallet-3-fill">
                        <h3>For Payment</h3>
                    </span>

                </a>
                <a href="{{ route('cashierpaid') }}">
                    <span class="ri-receipt-line">
                        <h3>Paid</h3>
                    </span>
                </a>
                <form action="{{ route('logout') }}" method="POST" id="logout-form-navbar">
                    @csrf

                    <button class="no-underline logout btn btn-danger btn-md" type="submit" id="logout-button">
                        <span class="ri-logout-box-r-line">
                            <h3>LOGOUT</h3>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </aside> -->
{{-- -------------------------------END-OF-ASIDE-------------------- --}}
<main>
    <h1>RESERVATIONS AWAITING PAYMENT</h1>
    <h1 class="page-title" style="color: var(--color-orange);">GYM</h1>

    <div class="card" id="GymReservationTableCard">
        <div>
            <h4 class="card-header text-center home">Gym Reservations</h4>
        </div>
        <table class="table-home table-hover stripe" id="GymReservationTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Reservation Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gyms as $gym)
                <tr class="table-active">
                    <td>{{ $gym->reservation_number }}</td>
                    <td>{{ \Carbon\Carbon::parse($gym->reservation_date)->format('F j, Y')  }}</td>
                    <td>{{ formatTime($gym->reservation_time_start) }}</td>
                    <td>{{ formatTime($gym->reservation_time_end) }}</td>
                    <td>{{ $gym->occupant_type }}</td>
                    <td>{{ $gym->total_price }}</td>
                    <td class="{{ 
                        $gym->status === 'Pending' ? 'status-pending' : (
                        $gym->status === 'Received' || $gym->status === 'For Payment' ? 'status-received' : (
                        $gym->status === 'Paid' || $gym->status === 'Reserved' ? 'status-paid' : (
                        $gym->status === 'Cancelled' || $gym->status === 'Unavailable' ? 'status-cancelled' : '')))
                    }}">
                        {{ $gym->status }}
                    </td>
                    <td>
                        <a href="{{ route('cashier.editCashierGym', $gym->id) }}" class="btn btn-confirm-payment rounded-pill" id="gymReservationTableConfirmbtn">
                            Confirm Payment
                        </a>

                        <a href="{{ route('cashier.viewPDFGym', $gym->id) }}" target="_blank" class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn">
                            Generate PDF
                        </a>
                        <!-- <button class="btn btn-primary btn-lg rounded-pill" id="gymReservationTableConfirmbtn"> Confirm Payment</button> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h1 class="page-title" style="margin-top: 30px;  color: var(--color-orange);">DORM</h1>

    <div class="card" id="DormReservationTableCard">
        <div>
            <h4 class="card-header text-center home">Dorm Reservations</h4>
        </div>
        <table class="table-home table-hover stripe" id="DormReservationTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Form Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Dorm Type/Quantity</th>
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dorms as $dorm)
                <tr class="table-active">
                    <td>{{ $dorm->Form_number }}</td>
                    <td>{{ \Carbon\Carbon::parse($dorm->reservation_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($dorm->reservation_end_date)->format('F j, Y') }}</td>
                    <td>{{ formatTime($dorm->reservation_start_time) }}</td>
                    <td>{{ formatTime($dorm->reservation_end_time) }}</td>
                    <td>{{ $dorm->quantity }} {{ $dorm->gender }} </td>
                    <td>{{ $dorm->occupant_type }}</td>
                    <td>{{ $dorm->total_price }}</td>
                    <td class="{{ 
                        $dorm->status === 'Pending' ? 'status-pending' : (
                        $dorm->status === 'Received' || $dorm->status === 'For Payment' ? 'status-received' : (
                        $dorm->status === 'Paid' || $dorm->status === 'Reserved' ? 'status-paid' : (
                        $dorm->status === 'Cancelled' || $dorm->status === 'Unavailable' ? 'status-cancelled' : '')))
                    }}">
                        @if ($dorm->status === 'Received')
                        For Payment
                        @else
                        {{ $dorm->status }}
                        @endif
                    </td>
                       
                    </td>
                    <td>
                        <a href="{{ route('cashier.editCashierDorm', $dorm->id) }}" class="btn btn-confirm-payment rounded-pill" id="dormReservationTableConfirmbtn">
                            Confirm Payment
                        </a>
                        <a href="{{ route('cashier.viewPDFDorm', $dorm->id) }}" target="_blank" class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn">
                            Generate PDF
                        </a>
                        <!-- <button class="btn btn-primary btn-lg rounded-pill" id="dormReservationTableConfirmbtn"> Confirm Payment</button> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ------------------END OF INSIGHTS------------------ --}}

</main>

{{-- ------------------END OF MAIN------------------ --}}
<div class="right">
    <div class="top">
        <button id="menu-btn">
            <span class="ri-menu-line"></span>
        </button>

        @auth()
        <div class="profile">
            <div class="info">
                <p>Hey, <b>{{ Auth::user()->first_name }}</b></p>
                <small class="text-muted">{{ Auth::user()->role }}</small>
            </div>
            <div class="profile-photo">
                <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
            </div>
        </div>
        @endauth
    </div>
    {{-- ------------------END OF TOP------------------ --}}

    {{-- ------------------ END OF RECENT UPDATES ------------------ --}}

</div>
@endsection
<?php
function formatTime($time) {
    return \Carbon\Carbon::createFromFormat('H:i:s', $time)->format('g:i a');
}
?>
