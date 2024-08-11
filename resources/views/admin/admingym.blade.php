@extends('layout.adminlayout')



@section('admindashboard')
    <main class="">
        <h1 class="page-title mt-3">GYM</h1>



        {{-- ------------------END OF INSIGHTS------------------ --}}

    </main>
    <div class="card" id="GymReservationTableCard">
        <div>
            <h4 class="card-header text-center home">Gym Reservations</h4>
        </div>
        <table class="table-home table-hover stripe" id="GymReservationTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">User Full Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gyms as $gym)
                    <tr class="table-active">
                        <td>{{ $gym->userDetails->first_name . ' ' . $gym->userDetails->middle_name . ' ' . $gym->userDetails->last_name }}
                        </td>
                        <td>{{ \Carbon\Carbon::parse($gym->reservation_date)->format('F j, Y')  }}</td>
                        <td>{{ formatTime($gym->reservation_time_start) }}</td>
                        <td>{{ formatTime($gym->reservation_time_end) }}</td>
                        <td>{{ $gym->occupant_type }}</td>
                        <td>{{ $gym->total_price }}</td>
                        <td class="{{ 
                            $gym->status === 'Pending' ? 'status-pending' : (
                            $gym->status === 'Received' || $gym->status === 'For Payment' ? 'status-received' : (
                            $gym->status === 'Paid' || $gym->status === 'Reserved' ? 'status-paid' : (
                            $gym->status === 'Cancelled' || $gym->status === 'Unavailable' ? 'status-cancelled' : '')))
                        }}">
                            {{ $gym->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card" id="GymReservationCartTableCard">
        <div>
            <h4 class="card-header text-center home">Gym Reservations (Currently In Cart)</h4>
        </div>
        <table class="table-home table-hover stripe" id="GymReservationCartTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">User Full Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr class="table-active">
                        <td>{{ $cart->userDetails->first_name . ' ' . $cart->userDetails->middle_name . ' ' . $cart->userDetails->last_name }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($cart->reservation_date)->format('F j, Y') }}</td>
                        <td>{{ formatTime($cart->reservation_time_start) }}</td>
                        <td>{{ formatTime($cart->reservation_time_end) }}</td>
                        <td>{{ $cart->occupant_type }}</td>
                        <td>{{ $cart->total_price }}</td>
                        <td class="{{ 
                            $cart->status === 'Pending' ? 'status-pending' : (
                            $cart->status === 'Received' || $cart->status === 'For Payment' ? 'status-received' : (
                            $cart->status === 'Paid' || $cart->status === 'Reserved' ? 'status-paid' : (
                            $cart->status === 'Cancelled' || $cart->status === 'Unavailable' ? 'status-cancelled' : '')))
                        }}">
                            {{ $cart->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ------------------END OF MAIN------------------ --}}
@endsection
<?php
function formatTime($time) {
    return \Carbon\Carbon::createFromFormat('H:i:s', $time)->format('g:i a');
}
?>