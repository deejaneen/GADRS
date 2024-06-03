@extends('layout.weblayout')

@section('profileview')
    <div class="profileview-container">
        @include('profile.leftcolumn_sidebar')
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
                            <span class="errors">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>
                    <hr>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                    <div class="inputBox new-password">
                        <input type="password" name="new_password" id="new_password">
                        <span>New Password</span>
                        @if ($errors->any('new_password'))
                            <span class="errors">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>

                    <div class="inputBox confirm-password">
                        <input type="password" name="confirm_password" id="confirm_password">
                        <span>Confirm Password</span>
                        @if ($errors->any('confirm_password'))
                            <span class="errors">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>
                    <button class="btn-save-password-changes btn btn-primary" type="submit">Save</button>
                </div>
            </form>

        @endauth

    </div>
@endsection
