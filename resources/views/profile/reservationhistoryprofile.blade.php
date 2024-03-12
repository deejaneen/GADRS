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
        <div class="img-circle text-center">
            <img src="{{ asset('images/avatar.png') }}" alt="">
        </div>
        <hr>
        <button class="btn btn-primary btn-edit-profile">
            <span class="ri-pencil-line"></span>Edit
        </button>

        <div class="inputBox firstname">
            <input type="text">
            <span>First Name</span>
        </div>
        <div class="inputBox middlename">
            <input type="text">
            <span>Middle Name</span>
        </div>
        <div class="inputBox lastname">
            <input type="text">
            <span>Last Name</span>
        </div>
        <div class="inputBox email">
            <input type="text">
            <span>Email</span>
        </div>
        <div class="inputBox contact-number">
            <input type="text">
            <span>Contact Number</span>
        </div>
        <button class="btn-save-profile-changes btn btn-primary">Save Changes</button>
    </div>

</div>
@endsection
