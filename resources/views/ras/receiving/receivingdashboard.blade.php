@extends('layout.receivinglayout')

@section('receivingdashboard')
<!-- @include('ras.receiving.receiving-side-bar') -->
    <main>
        <h1>Dashboard</h1>


        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}
            <div class="totalreservation">
                <span class="ri-key-2-line"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Reservations - Pending</h3>
                        <h1>
                            {{ $totalReservationCount }}
                        </h1>
                    </div>

                </div>
            </div>
            {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
            <div class="gymreservation">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Reservations - Received</h3>
                        <h4>{{ $currentMonth }}</h4>
                        <h1>
                            {{ $thisMonthTotalReservationReceived }}
                        </h1>
                    </div>

                </div>
            </div>
            {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
            <div class="dormreservations">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Total Reservations - Received</h3>
                        <h4> {{ $lastMonth }}</h4>
                        <h1>
                            {{ $lastMonthTotalReservationReceived }}
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
<script>
    // Get current month
    const currentDate = new Date();
    const currentMonth = currentDate.toLocaleString('default', { month: 'long' });

    // Update placeholder with current month
    document.getElementById('currentMonth').textContent = currentMonth;
</script>
