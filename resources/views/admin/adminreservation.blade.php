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
                <a href="{{ route('adminreservations') }}" class="active">
                    <span class="ri-receipt-line">
                        <h3>Reservations</h3>
                        <span class="message-count">26</span>
                    </span>
                </a>
                <a href="{{ route('admingym') }}">
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
                        <h3>Profile</h3>
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
        <h1 class="page-title">RESERVATIONS DATES THAT CAN BE BOOKED</h1>
        <div class="card" id="AdminGymReservationTableCard">
            <div>
                <h2 class="card-header text-center home">Active Gym Dates For Reservation</h2>
            </div>
            <table class="table-home table-hover stripe" id="AdminGymReservationTable" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Reservation Date</th>
                        <th scope="col">Time Start</th>
                        <th scope="col">Time End</th>
                        <th scope="col">Buttons</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($users as $user)
                        <tr class="table-active">
                            <td>{{ $user->last_name}}</td> 
                            <td>{{ $user->first_name }}</td> 
                            <td>{{ $user->middle_name }}</td> 
                            <td>{{ $user->email }}</td> 
                            <td>{{ $user->contact_number }}</td> 
                            <td>{{ $user->role }}</td> 
                            <td>
                                <button class="btn btn-primary btn-lg rounded-pill" id="userTableEditbtn"> Edit</button>
                                <button class="btn btn-primary btn-lg rounded-pill" id="userTableDeletebtn"> Delete</button>

                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
        <div class="card" id="AdminDormReservationTableCard">
            <div>
                <h2 class="card-header text-center home">Active Dorm Dates For Reservation</h2>
            </div>
            <table class="table-home table-hover stripe" id="AdminDormReservationTable" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Reservation Date</th>
                        <th scope="col">Buttons</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($users as $user)
                        <tr class="table-active">
                            <td>{{ $user->last_name}}</td> 
                            <td>{{ $user->first_name }}</td> 
                            <td>{{ $user->middle_name }}</td> 
                            <td>{{ $user->email }}</td> 
                            <td>{{ $user->contact_number }}</td> 
                            <td>{{ $user->role }}</td> 
                            <td>
                                <button class="btn btn-primary btn-lg rounded-pill" id="userTableEditbtn"> Edit</button>
                                <button class="btn btn-primary btn-lg rounded-pill" id="userTableDeletebtn"> Delete</button>

                            </td>
                        </tr>
                    @endforeach --}}
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
            <h2>Add Reservation Dates</h2>
            <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD NEW GYM DATE ONLY</h3>
                        <span class="ri-basketball-fill"></span>

                    </div>
                </div>

            </div>
            <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD NEW DORM DATE ONLY</h3>
                        <span class="ri-hotel-bed-fill"></span>
                    </div>
                </div>
            </div>
            <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD DATE FOR BOTH</h3>
                        <span class="ri-basketball-fill"></span>
                        <span class="ri-hotel-bed-fill"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
