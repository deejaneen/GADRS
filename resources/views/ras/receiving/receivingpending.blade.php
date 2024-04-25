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
            <a href="{{ route('receivinghome') }}" >
                <span class="ri-dashboard-line ">
                    <h3>Dashboard</h3>
                </span>
            </a>
           
            <a href="{{ route('receivingpending') }}" class="active">
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
        <h1>Pending</h1>
   

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
                        <h3>Total Pending Reservations - Gym</h3>
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
                        <h3>Total Pending Reservations - Dorm</h3>
                        <h1>
                            Php25,024
                        </h1>
                    </div>
                  
                </div>
            </div>
        </div>

        {{-- ------------------END OF INSIGHTS------------------ --}}
        <div class="recent-orders">
            <h2>Recent Orders</h2>
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
    </main>
@endsection
