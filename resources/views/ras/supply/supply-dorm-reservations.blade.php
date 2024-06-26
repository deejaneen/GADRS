@extends('layout.supplylayout')

@section('supplydashboard')
@include('ras.supply.supply-sidebar')
<div class="card" id="ReceivingPendingTableCard">
    <div>
        <h2 class="card-header text-center home">Dorm Pending Reservations</h2>
    </div>

    <table class="table-home table-hover stripe" id="SupplyPendingTable" style="width: 100%">
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
                <td>{{ \Carbon\Carbon::parse($dorm->reservation_start_date)->format('F j, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($dorm->reservation_start_time)->format('g:i a') }}</td>
                <td>{{ \Carbon\Carbon::parse($dorm->reservation_end_date)->format('F j, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($dorm->reservation_end_time)->format('g:i a') }}</td>
                <td>{{ $dorm->price }}</td>
                <td class="
                @if ($dorm->status == 'Pending')
                    status-pending
                @elseif ($dorm->status == 'Received' )
                    status-received-for-payment
                @elseif ($dorm->status == 'Paid' || $dorm->status == 'Reserved')
                    status-paid-reserved
                @elseif ($dorm->status == 'Cancelled' || $dorm->status == 'Unavailable')
                    status-cancelled
                @endif
                ">{{ $dorm->status }}</td>    
                <td class="buttons">
                    <a href="{{ route('supply.editDorm', $dorm->id) }}" class="btn btn-assign-number rounded-pill" id="receivingAssignNumberbtn">
                        Assign Number
                    </a>
                    <a href="{{ route('supply.viewDorm', $dorm->id) }}" class="btn btn-view-details rounded-pill" id="receivingViewFormbtn" >
                        View Details
                    </a>
                    <a href="{{ route('supply.viewPDF', $dorm->id) }}" target="_blank" class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn" >
                       Generate PDF
                    </a>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
