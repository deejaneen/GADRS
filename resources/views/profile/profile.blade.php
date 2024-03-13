@extends('layout.weblayout')

@section('profileview')
    <div class="profileview-container">
        <div class="left-column">
            <div class="sidebar">
                <a href="{{ route('profile') }}" class="active">
                    <span class="ri-user-line">
                        <h3>Your Account</h3>
                    </span>
                </a>
                <a href="{{ route('passwordprofile') }}">
                    <span class="ri-key-2-line">
                        <h3>Change Password</h3>
                    </span>
                </a>
                <a href="{{ route('reservationhistoryprofile') }}">
                    <span class="ri-receipt-line">
                        <h3>Reservation History</h3>
                    </span>
                </a>
                <a href="{{ route('login') }}">
                    <span class="ri-logout-box-r-line">
                        <h3>Logout</h3>
                    </span>
                </a>
            </div>
        </div>
        <div class="right-column profile" @readonly(true)>
            <div class="img-circle text-center">
                <img src="{{ asset('images/avatar.png') }}" alt="">
            </div>
            <hr>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-edit-profile">
                <span class="ri-pencil-line"></span>Edit
            </a>
            <div class="inputBox firstname">
                <input type="text" value="{{ $user->first_name }}" disabled>
                <span>First Name</span>
            </div>
            <div class="inputBox middlename">
                <input type="text" value="{{ $user->middle_name }}" disabled>
                <span>Middle Name</span>
            </div>
            <div class="inputBox lastname">
                <input type="text" value="{{ $user->last_name }}" disabled>
                <span>Last Name</span>
            </div>
            <div class="inputBox email">
                <input type="text" value="{{ $user->email }}" disabled>
                <span>Email</span>
            </div>
            <div class="inputBox contact-number" >
                <input type="text" value="{{ $user->contact_number }}"disabled>
                <span>Contact Number</span>
            </div>

        </div>

    </div>
@endsection
