@extends('layout.adminlayout')



@section('admindashboard')
 
    <main>
        <h1 class="page-title">ADMIN CHANGE PASSWORD</h1>
        <div class="card" id="AdminChangePasswordCard" style="border-radius: 20px;">
            <form action="{{ route('update_password_admin') }}" id="change_password_admin_form" method="post">
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

            @auth()
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>{{ Auth::user()->first_name }}</b></p>
                        <small class="text-muted">{{ Auth::user()->role }}</small>
                    </div>
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
                    </div>
                </div>
            @endauth
        </div>

        {{-- ------------------END OF TOP------------------ --}}
        {{-- <div class="recent-updates">
            <h2>Recent Updates</h2>
            <div class="updates">
                <div class="update">
                    <div class="profile-photo">
                        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
</div>
<div class="message">
    <p><b>Mike Tyson </b>Loreendis, cupiditate ipsam, saepe orro tempora.</p>
    <small class="text-muted">2 Minutes Ago</small>
</div>
</div>
<div class="update">
    <div class="profile-photo">
        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
    </div>
    <div class="message">
        <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque
            aspernatur nostrum, </p>
        <small class="text-muted">2 Minutes Ago</small>
    </div>
</div>
<div class="update">
    <div class="profile-photo">
        <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
    </div>
    <div class="message">
        <p><b>Mike Tyson </b>Lorem ipsum dolor sit amet consectetur adae illo, nulla voluptates
            porro tempora.</p>
        <small class="text-muted">2 Minutes Ago</small>
    </div>
</div>
</div>
</div> --}}
        {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
        {{-- <div class="sales-analytics">
    <h2>Add New Gym Reservation Date</h2> --}}
        {{-- <div class="item online">
                <div class="icon">
                    <span class="ri-shopping-cart-2-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>NEW RESERVATIONS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="success">+39%</h5>
                    <h3>3849</h3>
                </div>
            </div> --}}
        {{-- <div class="item offline">
                <div class="icon">
                    <span class="ri-shopping-bag-line"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>OFFLINE ORDERS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="danger">-17%</h5>
                    <h3>3849</h3>
                </div>
            </div> --}}
        {{-- <div class="item customers">
                <div class="icon">
                    <span class="ri-user-fill"></span>
                </div>
                <div class="right">
                    <div class="info">
                        <h3>NEW USERS</h3>
                        <small class="text-muted">Last 24 Hours</small>
                    </div>
                    <h5 class="success">+225%</h5>
                    <h3>3849</h3>
                </div>
            </div> --}}
        {{-- <div class="item add-product">
        <div class="icon">
            <span class="ri-add-line"></span>
        </div>
        <div class="right">
            <div class="info">
                <h3>ADD NEW GYM DATE</h3>

            </div>

        </div>
    </div> --}}

    </div>
    </div>
@endsection
