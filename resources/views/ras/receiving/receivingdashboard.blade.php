@extends('layout.receivinglayout')

@section('receivingdashboard')
    <!-- @include('ras.receiving.receiving-side-bar') -->
    <main>
        <h1>Dashboard</h1>


        <div class="insights">
            {{-- -------------------------------END-OF-SALES-------------------- --}}


            {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
            <div class="gymreservation">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Daily Total Reservations</h3>
                        <h4>{{ $today->format('F j, Y') }}</h4>
                        <h1>{{ $dailyTotalReservations }}
                        </h1>
                    </div>

                </div>
            </div>
            {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}
            <div class="dormreservations">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Weekly Total Reservations</h3>
                        <h4>{{ $weekStart }} - {{ $weekEnd }}</h4>
                        <h1>{{ $weeklyTotalReservations }}</h1>
                    </div>
                </div>
            </div>
            <div class="dormreservations">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Monthly Total Reservations</h3>
                        <h4> {{ $currentMonth }}</h4>
                        <h1>{{ $monthlyTotalReservations }}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="dormreservations">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>This Month's Reservations</h3>
                        <h1>{{ $thisMonthGymReceivedCount }}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="dormreservations">
                <span class="ri-basketball-fill"></span>
                <div class="middle">
                    <div class="left">
                        <h3>Last Month's Reservations</h3>
                        <h1>{{ $lastMonthGymReceivedCount }}</h1>
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
<script>
    // Get current month
    const currentDate = new Date();
    const currentMonth = currentDate.toLocaleString('default', {
        month: 'long'
    });

    // Update placeholder with current month
    document.getElementById('currentMonth').textContent = currentMonth;
</script>
