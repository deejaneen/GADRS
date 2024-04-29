@extends('layout.cashierlayout')

@section('cashierdashboard')
<aside>
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
           
            <a href="{{ route('cashierforpayment') }}" >
                <span class="ri-wallet-3-fill">
                    <h3>For Payment</h3>
                </span>
                
            </a>
            <a href="{{ route('cashierpaid') }}" class="active">
                <span class="ri-receipt-line">
                    <h3>Paid</h3>
                </span>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form-navbar">
                @csrf

                <button class="no-underline logout btn btn-danger btn-md" type="submit" id="logout-button">
                    <span class="ri-logout-box-r-line">
                        <h3>LOGOUT</h3></span>
                </button>
            </form>
        </div>
    </div>
</aside>
{{-- -------------------------------END-OF-ASIDE-------------------- --}}
<main>
    <h1>PAID RESERVATIONS</h1>
    <h1 class="page-title">Gym</h1>

    <div class="card" id="GymReservationTableCard">
        <div>
            <h4 class="card-header text-center home">Gym Reservations</h4>
        </div>
        <table class="table-home table-hover stripe" id="GymReservationTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Form Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gyms as $gym)
                    <tr class="table-active">
                        <td>{{ $gym->form_number_id }}</td>
                        <td>{{ $gym->reservation_date }}</td>
                        <td>{{ $gym->reservation_time_start }}</td>
                        <td>{{ $gym->reservation_time_end }}</td>
                        <td>{{ $gym->occupant_type }}</td>
                        <td>{{ $gym->price }}</td>
                        <td style="color:var(--color-orange);">{{ $gym->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h1 class="page-title" style="margin-top: 30px;">DORM</h1>

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
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dorms as $dorm)
                    <tr class="table-active">
                        <td>{{ $dorm->form_number_id }}</td>
                        <td>{{ $dorm->reservation_start_date }} - {{ $dorm->reservation_end_date }}</td>
                        <td>{{ $dorm->reservation_start_time }}</td>
                        <td>{{ $dorm->reservation_end_time }}</td>
                        <td>{{ $dorm->quantity }} {{ $dorm->gender }} </td>
                        <td>{{ $dorm->occupant_type }}</td>
                        <td>{{ $dorm->price }}</td>
                        <td style="color:var(--color-orange);">{{ $dorm->status }}</td>
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
                    <small class="text-muted">Admin</small>
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
