@extends('layout.supplylayout')

@section('supplydashboard')
@include('ras.supply.supply-sidebar')

<main>
    <h1>Dashboard</h1>


    <div class="insights">
        <div class="dormreservations">
            <span class="ri-hotel-bed-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Reservations - Pending</h3>
                    <h1>
                        {{ $dormsPendingCount }}
                    </h1>
                </div>
            </div>
        </div>
        <div class="dormreservations">
            <span class="ri-hotel-bed-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Reservations - Received</h3>
                    <h1>
                        {{ $dormsPendingCountReceived }}
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

        <div class="profile">
            <div class="info">
                <p>Hey, <b>{{ Auth::user()->first_name }}</b></p>
                <small class="text-muted">{{ Auth::user()->role }}</small>
            </div>
            <div class="profile-photo">
                <img src="{{ asset('images/COA CAR logo.png') }}" alt="">
            </div>
        </div>
    </div>
    {{-- ------------------END OF TOP------------------ --}}

    {{-- ------------------ END OF RECENT UPDATES ------------------ --}}
    <div class="sales-analytics">
        <h2>Sales Analytics</h2>

        <div class="item add-product">
            <div class="icon">
                <span class="ri-add-line"></span>
            </div>
            <div class="right">
                <div class="info">
                    <h3>ADD RESERVATION</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
