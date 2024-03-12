@extends('layout.weblayout')

@section('profileview')
<div class="profileview-container">
    <div class="left-column">
        <div class="sidebar">
            <a href="{{route('profile')}}" >
                <span class="ri-user-line">
                    <h3>Your Account</h3>
                </span>
            </a>
            <a href="{{route('passwordprofile')}}" >
                <span class="ri-key-2-line">
                    <h3>Change Password</h3>
                </span>
            </a>
            <a href="{{route('reservationhistoryprofile')}}" class="active">
                <span class="ri-receipt-line">
                    <h3>Reservation History</h3>
                </span>
            </a>
            <a href="{{route('login')}}">
                <span class="ri-logout-box-r-line">
                    <h3>Logout</h3>
                </span>
            </a>
        </div>
    </div>
    <div class="right-column reservation">
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
    </div>

</div>
@endsection
