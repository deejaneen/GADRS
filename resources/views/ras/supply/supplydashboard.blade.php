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
    </div>
    {{-- ------------------END OF TOP------------------ --}}

    {{-- ------------------ END OF RECENT UPDATES ------------------ --}}

</div>
@endsection
