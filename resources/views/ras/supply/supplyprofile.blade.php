@extends('layout.supplylayout')

@section('supplydashboard')
@include('ras.supply.supply-sidebar')
    <main>
        <h1 class="page-title">CHANGE PASSWORD</h1>
        <div class="card" id="AdminChangePasswordCard">
            <form action="{{ route('update_password_supply') }}" id="change_password_supply_form" method="post">
                @csrf
                @method('post')
                <div class="right-column password">
                    <h3 class="profile-title">Change your password</h3>

                    <div class="inputBox current-password">
                        <span>Enter Current Password</span>
                        <input type="password" name="current_password" id="current_password">
                        @if ($errors->any('current_password'))
                            <span class="errors">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>
                    <hr>
                    <a href="{{route("forget.password")}}" class="forgot-password">Forgot Password?</a>
                    <div class="inputbox-container">
                        <div class="inputBox new-password">
                            <span>Enter New Password</span>
                            <input type="password" name="new_password" id="new_password">
                            @if ($errors->any('new_password'))
                                <span class="errors">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>

                        <div class="inputBox confirm-password">
                            <span>Confirm Password</span>
                            <input type="password" name="confirm_password" id="confirm_password">
                            @if ($errors->any('confirm_password'))
                                <span class="errors">{{ $errors->first('confirm_password') }}</span>
                            @endif
                        </div>
                    </div>

                    <button class="btn-save-password-changes btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>

        {{-- ------------------END OF INSIGHTS------------------ --}}

    </main>

    {{-- ------------------END OF MAIN------------------ --}}
    <div class="right">
        <div class="top">
            <button id="menu-btn">
                <span class="ri-menu-line"></span>
            </button>
        </div>

     

    </div>
    </div>
@endsection
