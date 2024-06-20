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
                <td>{{ $dorm->reservation_start_date }}</td>
                <td>{{ $dorm->reservation_start_time }}</td>
                <td>{{ $dorm->reservation_end_date }}</td>
                <td>{{ $dorm->reservation_end_time }}</td>
                <td>{{ $dorm->price }}</td>
                <td style="color:var(--color-orange);">{{ $dorm->status }}</td>
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