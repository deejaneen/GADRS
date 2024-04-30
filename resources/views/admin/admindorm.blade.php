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
            <a href="{{ route('adminusers') }}" >
                <span class="ri-team-line">
                    <h3>Users</h3>
                </span>
            </a>
            <a href="{{ route('adminreservations') }}" >
                <span class="ri-receipt-line">
                    <h3>Reservations</h3>
                    <span class="message-count">26</span>
                </span>
            </a>
            <a href="{{ route('admingym') }}" >
                <span class="ri-basketball-fill">
                    <h3>Gym</h3>
                </span>
            </a>
            <a href="{{ route('admindorm') }}" class="active">
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
                        <h3>LOGOUT</h3></span>
                </button>
            </form>
        </div>
    </div>
</aside>
{{-- -------------------------------END-OF-ASIDE-------------------- --}}
    <main>
        <h1 class="page-title">DORM</h1>
        
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
                            <td>{{ $dorm->form_number_id}}</td> 
                            <td>{{ $dorm->reservation_start_date}} - {{ $dorm->reservation_end_date}}</td> 
                            <td>{{ $dorm->reservation_start_time}}</td> 
                            <td>{{ $dorm->reservation_end_time}}</td> 
                            <td>{{ $dorm->quantity}} {{ $dorm->gender}} </td> 
                            <td>{{ $dorm->occupant_type}}</td> 
                            <td>{{ $dorm->price }}</td> 
                            <td style="color:var(--color-orange);">{{ $dorm->status }}</td> 
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
        <div class="card" id="DormReservationCartTableCard">
            <div>
                <h4 class="card-header text-center home">Dorm Reservations (Currently In Cart)</h4>
            </div>
            <table class="table-home table-hover stripe" id="DormReservationCartTable" style="width: 100%">
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
                    @foreach ($carts as $cart)
                        <tr class="table-active">
                            <td>{{ $cart->form_number_id}}</td> 
                            <td>{{ $cart->reservation_start_date}} - {{ $cart->reservation_end_date}}</td> 
                            <td>{{ $cart->reservation_start_time}}</td> 
                            <td>{{ $cart->reservation_end_time}}</td> 
                            <td>{{ $cart->quantity}} {{ $cart->gender}} </td> 
                            <td>{{ $cart->occupant_type}}</td> 
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
            {{-- <div class="theme-toggler">
                <span class="ri-sun-fill active"></span>
                <span class="ri-moon-fill"></span>
            </div> --}}
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
        
   
        <div class="sales-analytics">
            <h2>Add New Dorm Reservation Date</h2>
                      <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD NEW DORM DATE</h3>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
@endsection
