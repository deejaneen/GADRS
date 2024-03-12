@extends('layout.weblayout')

@section('profileview')
    <div class="profileview-container">
        <div class="left-column">
            <div class="sidebar">
                <a href="{{ route('profile') }}">
                    <span class="ri-user-line">
                        <h3>Your Account</h3>
                    </span>
                </a>
                <a href="{{ route('passwordprofile') }}" class="active">
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
        <div class="right-column password">
            <h3 class="profile-title">Change your password</h3>

            <div class="inputBox current-password">
                <input type="text">
                <span>Current Password</span>
            </div>
            <hr>
            <a href="#" class="forgot-password">Forgot Password?</a>
            <div class="inputBox new-password">
                <input type="text">
                <span>New Password</span>
            </div>
            <div class="inputBox confirm-password">
                <input type="text">
                <span>Confirm Password</span>
            </div>
            <button class="btn-save-password-changes btn btn-primary">Save</button>
        </div>

        {{-- <div class="left-column">
           <div class="card-body pt-3">
            <ul class="nav nav-link-profile flex-column fw-bold gap-4">
                <li class="nav-item">
                    <a href="{{route('profile')}}" class="nav-link">ACCOUNT DETAILS</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('passwordprofile')}}" class="{{(Route::is('passwordprofile')) ? 'profile-active' : '' }} nav-link">PRIVACY AND SECURITY</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('reservationhistoryprofile')}}" class="nav-link">RESERVATION HISTORY</a>
                </li>
            </ul>
           </div>
        </div>
        <div class="right-column">
            <!-- Content for the right column goes here -->
            <h2>Right Column</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec velit eu est eleifend viverra. Nullam
                euismod nulla id bibendum accumsan. Mauris suscipit consectetur tellus.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec velit eu est eleifend viverra. Nullam
                euismod nulla id bibendum accumsan. Mauris suscipit consectetur tellus.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed nec velit eu est eleifend viverra. Nullam
                euismod nulla id bibendum accumsan. Mauris suscipit consectetur tellus.</p>
        </div> --}}
    </div>
@endsection
