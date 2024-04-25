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
            <a href="{{ route('cashierhome') }}" class="active">
                <span class="ri-dashboard-line ">
                    <h3>Dashboard</h3>
                </span>
            </a>
           
            <a href="{{ route('cashierforpayment') }}" >
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
                        <h3>LOGOUT</h3></span>
                </button>
            </form>
        </div>
    </div>
</aside>
{{-- -------------------------------END-OF-ASIDE-------------------- --}}
<main>
    <h1>Dashboard</h1>
    <div class="insights">
        {{-- -------------------------------END-OF-SALES-------------------- --}}
        <div class="totalreservation">
            <span class="ri-basketball-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Gym Reservations - Pending Payment</h3>
                    <h1>
                        Php25,024
                    </h1>
                </div>
            </div>
        </div>
        {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
        <div class="gymreservation">
            <span class="ri-basketball-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Gym Reservations - Paid</h3>
                    <h1>
                        Php25,024
                    </h1>
                </div>
            </div>
        </div>
        {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
        <div class="dormreservations">
            <span class="ri-basketball-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Gym Reservations</h3>
                    <h1>
                        Php25,024
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="insights">
        {{-- -------------------------------END-OF-SALES-------------------- --}}
        <div class="totalreservation">
            <span class="ri-key-2-line"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Dorm Reservations - Pending Payment</h3>
                    <h1>
                        Php25,024
                    </h1>
                </div>
            </div>
        </div>
        {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
        <div class="gymreservation">
            <span class="ri-key-2-line"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Dorm Reservations - Paid</h3>
                    <h1>
                        Php25,024
                    </h1>
                </div>
            </div>
        </div>
        {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
        <div class="dormreservations">
            <span class="ri-key-2-line"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Dorm Reservations</h3>
                    <h1>
                        Php25,024
                    </h1>
                </div>
            </div>
        </div>
    </div>

    {{-- ------------------END OF INSIGHTS------------------ --}}
    
</main>

    {{-- ------------------END OF MAIN------------------ --}}
    <div class="right">
        <div class="top">
            <button id="menu-btn">
                <span class="ri-menu-line"></span>
            </button>
            <div class="theme-toggler">
                <span class="ri-sun-fill active"></span>
                <span class="ri-moon-fill"></span>
            </div>
            <div class="profile">
                <div class="info">
                    <p>Hey, <b>Name</b></p>
                    <small class="text-muted">Cashier</small>
                </div>
                <div class="profile-photo">
                    <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                </div>
            </div>
        </div>
        {{-- ------------------END OF TOP------------------ --}}
        
        {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
        
    </div>
@endsection
