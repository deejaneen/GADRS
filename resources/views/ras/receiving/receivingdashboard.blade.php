@extends('layout.receivinglayout')

@section('receivingdashboard')
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
            <a href="{{ route('receivinghome') }}" class="active">
                <span class="ri-dashboard-line ">
                    <h3>Dashboard</h3>
                </span>
            </a>
           
            <a href="{{ route('receivingpending') }}" >
                <span class="ri-time-line">
                    <h3>Pending</h3>
                </span>
                
            </a>
            <a href="{{ route('receivingreceived') }}">
                <span class="ri-folder-received-fill">
                    <h3>Received</h3>
                </span>
            </a>
            <a href="{{ route('receivingeditreservations') }}">
                <span class="ri-edit-2-line">
                    <h3>Edit Reservations</h3>
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
    <main>
        <h1>Dashboard</h1>
     

        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}
            <div class="totalreservation">
                <span class="ri-key-2-line"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Reservations - Pending</h3>
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
                        <h3>Total Reservations - Received</h3>
                        <h4>This Month "Insert Month Here"</h4>
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
                        <h3>Total Reservations - Received</h3>
                        <h4>Last Month "Insert Month Here"</h4>
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
         
            <div class="profile">
                <div class="info">
                    <p>Hey, <b>{{ Auth::user()->first_name }}</b></p>
                    <small class="text-muted">{{ Auth::user()->role }}</small>
                </div>
                <div class="profile-photo">
                    <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                </div>
            </div>
        </div>
        {{-- ------------------END OF TOP------------------ --}}
     
        {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
        <div class="sales-analytics">
            <h2>Sales Analytics</h2>
           
            <div class="item add-product">
                <div class="icon">
                    <span class="ri-add-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>ADD RESERVATION</h3>
                    </div>
                    <h5 class="success">+225%</h5>
                    <h3>3849</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
