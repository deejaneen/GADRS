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
        @auth
            <form action="{{ route('update_password') }}" id="change_password_form" method="post">
                @csrf
                @method('post')
                <div class="right-column password">
                    <h3 class="profile-title">Change your password</h3>

                    <div class="inputBox current-password">
                        <input type="password" name="current_password" id="current_password">
                        <span>Current Password</span>
                        @if ($errors->any('current_password'))
                            <span>{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>
                    <hr>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                    <div class="inputBox new-password">
                        <input type="password" name="new_password" id="new_password">
                        <span>New Password</span>
                        @if ($errors->any('new_password'))
                            <span>{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>

                    <div class="inputBox confirm-password">
                        <input type="password" name="confirm_password" id="confirm_password">
                        <span>Confirm Password</span>
                        @if ($errors->any('confirm_password'))
                            <span>{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>
                    <button class="btn-save-password-changes btn btn-primary" type="submit">Save</button>
                </div>
            </form>

        @endauth

    </div>
@endsection
