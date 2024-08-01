@extends('layout.cashierlayout')

@section('cashierdashboard')

{{-- -------------------------------END-OF-ASIDE-------------------- --}}
<main>
    <h1>Dashboard</h1>
    <div class="insights">
        {{-- -------------------------------END-OF-SALES-------------------- --}}
        <div class="totalreservation">
            <span class="ri-basketball-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Gym Reservations - Pending Payment</h3>
                    <h1>
                        {{ $gymsCount }}
                    </h1>
                </div>
            </div>
        </div>
        {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
        <div class="gymreservation">
            <span class="ri-basketball-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Gym Reservations - Paid</h3>
                    <h1>
                        {{ $gymsCountPaid }}
                    </h1>
                </div>
            </div>
        </div>
        {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
        <div class="dormreservations">
            <span class="ri-basketball-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Gym Reservations</h3>
                    <h1>
                        {{ $gymsCountTotal }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="insights">
        {{-- -------------------------------END-OF-SALES-------------------- --}}
        <div class="totalreservation">
            <span class="ri-key-2-line"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Dorm Reservations - Pending Payment</h3>
                    <h1>
                        {{ $dormsCount }}
                    </h1>
                </div>
            </div>
        </div>
        {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
        <div class="gymreservation">
            <span class="ri-key-2-line"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Dorm Reservations - Paid</h3>
                    <h1>
                        {{ $dormsCountPaid }}
                    </h1>
                </div>
            </div>
        </div>
        {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
        <div class="dormreservations">
            <span class="ri-key-2-line"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Dorm Reservations</h3>
                    <h1>
                        {{ $dormsCountTotal }}
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
