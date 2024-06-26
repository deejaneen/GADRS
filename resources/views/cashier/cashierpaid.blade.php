@extends('layout.cashierlayout')

@section('cashierdashboard')
    {{-- -------------------------------END-OF-ASIDE-------------------- --}}
    <main style="grid-column: 2 / span 2;">
        <h1>PAID RESERVATIONS</h1>
        <h1 class="page-title" style="color: var(--color-orange);">GYM</h1>

        <div class="card" id="GymReservationTableCard">
            <div>
                <h4 class="card-header text-center home">Gym Reservations</h4>
            </div>
            <table class="table-home table-hover stripe" id="GymReservationTable" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Reservation Number</th>
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
                            <td>{{ \Carbon\Carbon::parse($gym->reservation_date)->format('F j, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($gym->reservation_time_start)->format('g:i a') }}</td>
                            <td>{{ \Carbon\Carbon::parse($gym->reservation_time_end)->format('g:i a') }}</td>
                            <td>{{ $gym->occupant_type }}</td>
                            <td>{{ $gym->price }}</td>
                            <td
                                class="
                            @if ($gym->status == 'Pending') status-pending
                            @elseif ($gym->status == 'Received')
                                status-received-for-payment
                            @elseif ($gym->status == 'Paid' || $gym->status == 'Reserved')
                                status-paid-reserved
                            @elseif ($gym->status == 'Cancelled' || $gym->status == 'Unavailable')
                                status-cancelled @endif
                    ">
                                @if ($gym->status === 'Reserved')
                                    Paid
                                @else
                                    {{ $gym->status }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('cashier.viewPDFGym', $gym->id) }}" target="_blank"
                                    class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn">
                                    View PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h1 class="page-title" style="margin-top: 30px; color: var(--color-orange);">DORM</h1>

        <div class="card" id="DormReservationTableCard">
            <div>
                <h4 class="card-header text-center home">Dorm Reservations</h4>
            </div>
            <table class="table-home table-hover stripe" id="DormReservationTable" style="width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Form Number</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time Start</th>
                        <th scope="col">Time End</th>
                        <th scope="col">Dorm Type/Quantity</th>
                        <th scope="col">Occupant Type</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dorms as $dorm)
                        <tr class="table-active">
                            <td>{{ $dorm->Form_number }}</td>
                            <td>{{ \Carbon\Carbon::parse($dorm->reservation_start_date)->format('F j, Y') }} -
                                {{ \Carbon\Carbon::parse($dorm->reservation_end_date)->format('F j, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($dorm->reservation_start_time)->format('g:i a') }}</td>
                            <td>{{ \Carbon\Carbon::parse($dorm->reservation_end_time)->format('g:i a') }}</td>
                            <td>{{ $dorm->quantity }} {{ $dorm->gender }} </td>
                            <td>{{ $dorm->occupant_type }}</td>
                            <td>{{ $dorm->price }}</td>
                            <td
                                class="
                                @if ($dorm->status == 'Pending') status-pending
                                @elseif ($dorm->status == 'Received')
                                    status-received-for-payment
                                @elseif ($dorm->status == 'Paid' || $dorm->status == 'Reserved')
                                    status-paid-reserved
                                @elseif ($dorm->status == 'Cancelled' || $dorm->status == 'Unavailable')
                                    status-cancelled @endif
                        ">
                                @if ($dorm->status === 'Reserved')
                                    Paid
                                @else
                                    {{ $dorm->status }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('cashier.viewPDFDorm', $dorm->id) }}" target="_blank"
                                    class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn">
                                    View PDF
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ------------------END OF INSIGHTS------------------ --}}
    </main>

    {{-- ------------------END OF MAIN------------------ --}}
@endsection
