@extends('layout.receivinglayout')

@section('receivingdashboard')
    <main>
        <h1>Received</h1>

    
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
                        <td>{{ \Carbon\Carbon::parse($gym->reservation_date)->format('F j, Y') }}</td>
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
                        
                        <td class="buttons">
                            <a href="{{ route('receiving.viewGym', $gym->id) }}" class="btn btn-view-details rounded-pill" id="receivingViewFormbtn">
                                View Details
                            </a>
                            <a href="{{ route('receiving.viewPDF', $gym->id) }}" target="_blank" class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn">
                                Generate PDF
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection

<?php
function formatTime($time) {
    return \Carbon\Carbon::createFromFormat('H:i:s', $time)->format('g:i a');
}
?>

