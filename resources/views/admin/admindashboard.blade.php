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
            <a href="{{ route('adminhome') }}" class="active">
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
                        <h3>LOGOUT</h3></span>
                </button>
            </form>
            
        </div>
    </div>
</aside>
{{-- -------------------------------END-OF-ASIDE-------------------- --}}
    <main>
        <h1>Dashboard</h1>
        <div class="date">
            <input type="date" name="" id="">
        </div>

        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}
            <div class="totalreservation">
                <span class="ri-key-2-line"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Pending Reservations</h3>
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
                        <h3>Total Gym Reservations</h3>
                        <h1>
                            Php25,024
                        </h1>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
            <div class="dormreservations">
                <span class="ri-hotel-bed-fill"></span>
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
        <div class="recent-updates">
            <h2>Recent Updates</h2>
            <div class="updates">
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Loreendis, cupiditate ipsam, saepe orro tempora.</p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque
                            aspernatur nostrum, </p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adae illo, nulla voluptates
                            porro tempora.</p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
            </div>
        </div>
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
        {{-- <div class="recent-updates">
            <h2>Recent Updates</h2>
            <div class="updates">
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Loreendis, cupiditate ipsam, saepe orro tempora.</p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque
                            aspernatur nostrum, </p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                    <div class="message">
                        <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adae illo, nulla voluptates
                            porro tempora.</p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
        <div class="sales-analytics">
            <h2>Sales Analytics</h2>
            <div class="item online">
                <div class="icon">
                    <span class="ri-shopping-cart-2-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>NEW RESERVATIONS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="success">+39%</h5>
                    <h3>3849</h3>
                </div>
            </div>
            {{-- <div class="item offline">
                <div class="icon">
                    <span class="ri-shopping-bag-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>OFFLINE ORDERS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="danger">-17%</h5>
                    <h3>3849</h3>
                </div>
            </div> --}}
            <div class="item customers">
                <div class="icon">
                    <span class="ri-user-fill"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>NEW USERS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="success">+225%</h5>
                    <h3>3849</h3>
                </div>
            </div>
            <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD RESERVATION DATE</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="success">+225%</h5>
                    <h3>3849</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
