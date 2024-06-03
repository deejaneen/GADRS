@extends('layout.adminlayout')



@section('admindashboard')
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
                <a href="{{ route('adminhome') }}">
                    <span class="ri-dashboard-line ">
                        <h3>Dashboard</h3>
                    </span>
                </a>
                <a href="{{ route('adminusers') }}">
                    <span class="ri-team-line">
                        <h3>Users</h3>
                    </span>
                </a>
                <a href="{{ route('adminreservations') }}">
                    <span class="ri-receipt-line">
                        <h3>Reservations</h3>
                        <span class="message-count">26</span>
                    </span>
                </a>
                <a href="{{ route('admingym') }}" class="active">
                    <span class="ri-basketball-fill">
                        <h3>Gym</h3>
                    </span>
                </a>
                <a href="{{ route('admindorm') }}">
                    <span class="ri-home-3-line">
                        <h3>Dorm</h3>
                    </span>

                </a>
                <a href="{{ route('adminprofile') }}">
                    <span class="ri-user-line">
                        <h3>Change Password</h3>
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
    </aside>
    {{-- -------------------------------END-OF-ASIDE-------------------- --}}
    <main>
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
        <div class="card" id="GymReservationCartTableCard">
            <div>
                <h4 class="card-header text-center home">Gym Reservations (Currently In Cart)</h4>
            </div>
            <table class="table-home table-hover stripe" id="GymReservationCartTable" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time Start</th>
                        <th scope="col">Time End</th>
                        <th scope="col">Occupant Type</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        <tr class="table-active">
                            <td>{{ $cart->reservation_date }}</td>
                            <td>{{ $cart->reservation_time_start }}</td>
                            <td>{{ $cart->reservation_time_end }}</td>
                            <td>{{ $cart->occupant_type }}</td>
                            <td>{{ $cart->price }}</td>
                            <td style="color:var(--color-orange);">{{ $cart->status }}</td>
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

        {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
        <div class="sales-analytics">
            <h2>Add New Gym Reservation Date</h2>
            <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD NEW GYM DATE</h3>

                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
