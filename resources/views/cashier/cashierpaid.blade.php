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
    
    <div class="recent-orders">
        <h2>Gym Reservations</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Number</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
            </tbody>
        </table>
        <a href="#">Show All</a>
    </div>
    <div class="recent-orders">
        <h2>Dorm Reservations</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Number</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
                <tr>
                    <td>Fdhsajkdakdh</td>
                    <td>Adska</td>
                    <td>Due</td>
                    <td class="warning">Pending</td>
                    <td class="warning-orange">Details</td>
                </tr>
            </tbody>
        </table>
        <a href="#">Show All</a>
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
