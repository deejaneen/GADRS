@extends('layout.adminlayout')

@section('admindashboard')
    <main>
        <h1 class="page-title">Gym</h1>

        {{-- ------------------END OF INSIGHTS------------------ --}}

    </main>
    <div class="card" id="GymReservationTableCard">
        <div>
            <h4 class="card-header text-center home">Gym Reservations</h4>
        </div>
        <table class="table-home table-hover stripe" id="GymReservationTable" style="width: 100%">
            <thead>
                <tr>
                    <th scope="col">Form Number</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gyms as $gym)
                    <tr class="table-active">
                        <td>{{ $gym->form_number_id }}</td>
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
                            {{ $gym->status }}</td>
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
                    <th scope="col">Date</th>
                    <th scope="col">Time Start</th>
                    <th scope="col">Time End</th>
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr class="table-active">
                        <td>{{ \Carbon\Carbon::parse($cart->reservation_date)->format('F j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cart->reservation_time_start)->format('g:i a') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cart->reservation_time_end)->format('g:i a') }}</td>
                        <td>{{ $cart->occupant_type }}</td>
                        <td>{{ $cart->price }}</td>
                        <td
                            class="
                @if ($cart->status == 'Pending') status-pending
                @elseif ($cart->status == 'Received')
                    status-received-for-payment
                @elseif ($cart->status == 'Paid' || $cart->status == 'Reserved')
                    status-paid-reserved
                @elseif ($cart->status == 'Cancelled' || $gym->status == 'Unavailable')
                    status-cancelled @endif
                ">
                            {{ $cart->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ------------------END OF MAIN------------------ --}}
@endsection
