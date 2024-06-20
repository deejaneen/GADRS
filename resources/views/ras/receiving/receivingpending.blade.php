@extends('layout.receivinglayout')

@section('receivingdashboard')
<!-- @include('ras.receiving.receiving-side-bar') -->
<main>
    <h1>Pending</h1>


    <div class="insights">
        {{-- -------------------------------END-OF-SALES-------------------- --}}

        {{-- -------------------------------END-OF-GYM-RESERVATIONS-------------------- --}}
        <div class="gymreservation">
            <span class="ri-basketball-fill"></span>
            <div class="middle">
                <div class="left">
                    <h3>Total Pending Reservations - Gym</h3>
                    <h1>
                        {{ $gymsPendingCount }}
                    </h1>
                </div>

            </div>
        </div>
        {{-- -------------------------------END-OF-DORM-RESERVATIONS-------------------- --}}

    </div>

    {{-- ------------------END OF INSIGHTS------------------ --}}

</main>

<!-- <div class="right">
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

    {{-- ------------------ END OF RECENT UPDATES ------------------ --}}

</div> -->
<div class="card" id="ReceivingPendingTableCard">
    <div>
        <h2 class="card-header text-center home">Assign a Form Number</h2>
    </div>
    <table class="table-home table-hover stripe" id="ReceivingPendingTable" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">Reservation Number</th>
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
                    <a href="{{ route('receiving.editGym', $gym->id) }}" class="btn btn-assign-number rounded-pill" id="receivingAssignNumberbtn">
                        Assign Number
                    </a>
                    <a href="{{ route('receiving.viewGym', $gym->id) }}" class="btn btn-view-details rounded-pill" id="receivingViewFormbtn" >
                        View Details
                    </a>
                    <a href="{{ route('receiving.viewPDF', $gym->id) }}" target="_blank" class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn" >
                        Generate PDF
                    </a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
