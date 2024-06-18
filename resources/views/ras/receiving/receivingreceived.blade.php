@extends('layout.receivinglayout')

@section('receivingdashboard')
<!-- @include('ras.receiving.receiving-side-bar') -->
<main>
    <h1>Received</h1>

    <div class="insights">
        {{-- -------------------------------END-OF-SALES-------------------- --}}
        <div class="totalreservation">
            <span class="ri-key-2-line"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Reservations - Received</h3>
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
                    <h3>Total Received Reservations - Gym</h3>
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
                    <h3>Total Received Reservations - Dorm</h3>
                    <h1>
                        {{ $dormsPendingCount }}
                    </h1>
                </div>

            </div>
        </div>
    </div>

    {{-- ------------------END OF INSIGHTS------------------ --}}

</main>

<div class="card" id="ReceivingPendingTableCard">
    <div>
        <h2 class="card-header text-center home">Gym Received Reservations</h2>
    </div>
    <table class="table-home table-hover stripe" id="ReceivingPendingTable" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Form Number</th>
                <th scope="col">Form Group Number</th>
                <th scope="col">Date</th>
                <th scope="col">Time Start</th>
                <th scope="col">Time End</th>
                <th scope="col">Occupant Type</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gyms as $gym)
            <tr class="table-active">
                <td>{{ $gym->reservation_number }}</td>
                <td>{{ $gym->form_group_number }}</td>
                <td>{{ $gym->reservation_date }}</td>
                <td>{{ $gym->reservation_time_start }}</td>
                <td>{{ $gym->reservation_time_end }}</td>
                <td>{{ $gym->occupant_type }}</td>
                <td>{{ $gym->price }}</td>
                <td style="color:var(--color-orange);">{{ $gym->status }}</td>
                <td class="buttons">
                    <a href="{{ route('receiving.viewGym', $gym->id) }}" class="btn btn-primary btn-lg rounded-pill" id="receivingViewFormbtn" style="color: var(--color-orange);">
                        View
                    </a>
                    <a href="{{ route('receiving.viewPDF', $gym->id) }}" target="_blank" class="btn btn-primary btn-lg rounded-pill" id="receivingViewFormbtn" style="color: var(--color-orange);">
                        PDF
                    </a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>

<div class="card" id="ReceivingPendingTableCard">
    <div>
        <h2 class="card-header text-center home">Dorm Received Reservations</h2>
    </div>
    <table class="table-home table-hover stripe" id="ReceivingReceivedTable" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Form Number</th>
                <th scope="col">Form Group Number</th>
                <th scope="col">Reservation Start Date</th>
                <th scope="col">Reservation Start Time</th>
                <th scope="col">Reservation End Date</th>
                <th scope="col">Reservation End Time</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dorms as $dorm)
            <tr class="table-active">
                <td>{{ $dorm->Form_number }}</td>
                <td>{{ $dorm->form_group_number }}</td>
                <td>{{ $dorm->reservation_start_date }}</td>
                <td>{{ $dorm->reservation_start_time }}</td>
                <td>{{ $dorm->reservation_end_date }}</td>
                <td>{{ $dorm->reservation_end_time }}</td>
                <td>{{ $dorm->price }}</td>
                <td style="color:var(--color-orange);">{{ $dorm->status }}</td>
                <td class="buttons">
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection