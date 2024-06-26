@extends('layout.adminlayout')

@section('admindashboard')
    {{-- -------------------------------END-OF-ASIDE-------------------- --}}
    <main>
        <h1 class="page-title">DORM</h1>

        {{-- ------------------END OF INSIGHTS------------------ --}}

    </main>
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
                </tr>
            </thead>            <tbody>
                @foreach ($dorms as $dorm)
                    <tr class="table-active">
                        <td>{{ $dorm->form_number_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($dorm->reservation_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($dorm->reservation_end_date)->format('F j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($dorm->reservation_start_time)->format('g:i a') }}</td>
                        <td>{{ \Carbon\Carbon::parse($dorm->reservation_end_time)->format('g:i a') }}</td>
                        <td>{{ $dorm->quantity }} {{ $dorm->gender }}</td>
                        <td>{{ $dorm->occupant_type }}</td>
                        <td>{{ $dorm->price }}</td>
                        <td class="
                            @if ($dorm->status == 'Pending') status-pending
                            @elseif ($dorm->status == 'Received') status-received-for-payment
                            @elseif ($dorm->status == 'Paid' || $dorm->status == 'Reserved') status-paid-reserved
                            @elseif ($dorm->status == 'Cancelled'|| $dorm->status == 'Unavailable') status-cancelled
                            @endif
                        ">{{ $dorm->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card" id="DormReservationCartTableCard">
        <div>
            <h4 class="card-header text-center home">Dorm Reservations (Currently In Cart)</h4>
        </div>
        <table class="table-home table-hover stripe" id="DormReservationCartTable" style="width: 100%">
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
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr class="table-active">
                        <td>{{ $cart->form_number_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($cart->reservation_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($cart->reservation_end_date)->format('F j, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cart->reservation_start_time)->format('g:i a') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cart->reservation_end_time)->format('g:i a') }}</td>
                        <td>{{ $cart->quantity }} {{ $cart->gender }}</td>
                        <td>{{ $cart->occupant_type }}</td>
                        <td>{{ $cart->price }}</td>
                        <td class="
                            @if ($cart->status == 'Pending') status-pending
                            @elseif ($cart->status == 'Received') status-received-for-payment
                            @elseif ($cart->status == 'Paid' || $cart->status == 'Reserved') status-paid-reserved
                            @elseif ($cart->status == 'Cancelled'|| $cart->status == 'Unavailable') status-cancelled
                            @endif
                        ">{{ $cart->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- ------------------END OF MAIN------------------ --}}
@endsection
