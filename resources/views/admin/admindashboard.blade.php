@extends('layout.adminlayout')
@section('admindashboard')
    {{-- -------------------------------END-OF-ASIDE-------------------- --}}
    <main>
        <h1>Dashboard</h1>

        <h2 style="margin-top: 30px">Pending Reservations</h2>
        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}
            <div class="totalreservation">
                <span class="ri-key-2-line"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Pending Reservations</h3>
                        <h1>
                            {{ $totalPendingCount }}
                        </h1>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
            <div class="gymreservation">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Pending Gym Reservations</h3>
                        <h1>
                            {{ $gymsPendingCount }}
                        </h1>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
            <div class="dormreservations">
                <span class="ri-hotel-bed-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Pending Dorm Reservations</h3>
                        <h1>
                            {{ $dormsPendingCount }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <h2 style="margin-top: 30px">For Payment</h2>
        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}
            <div class="totalreservation">
                <span class="ri-key-2-line"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Paid Reservations</h3>
                        <h1>
                            {{ $totalForPaymentCount }}
                        </h1>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
            <div class="gymreservation">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Paid Gym Reservations</h3>
                        <h1>
                            {{ $gymsForPaymentCount }}
                        </h1>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
            <div class="dormreservations">
                <span class="ri-hotel-bed-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Paid Dorm Reservations</h3>
                        <h1>
                            {{ $dormsForPaymentCount }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <h2 style="margin-top: 30px">Reserved</h2>
        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}
            <div class="totalreservation">
                <span class="ri-key-2-line"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Reservations</h3>
                        <h1>
                            {{ $totalReservedCount }}
                        </h1>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
            <div class="gymreservation">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Gym Reservations</h3>
                        <h1>
                            {{ $gymsReservedCount }}
                        </h1>
                    </div>
                </div>
            </div>
            {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
            <div class="dormreservations">
                <span class="ri-hotel-bed-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Dorm Reservations</h3>
                        <h1>
                            {{ $dormsReservedCount }}
                        </h1>
                    </div>
                </div>
            </div>
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
    
    </div>
@endsection
