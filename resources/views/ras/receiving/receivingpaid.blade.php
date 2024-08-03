@extends('layout.receivinglayout')

@section('receivingdashboard')
<div class="fullspan">
    <main>
        <h1 style="margin: 1rem 0 2.5rem 0;">Paid</h1>

    </main>

    <div class="card" id="ReceivingPaidTableCard">
        <div>
            <h2 class="card-header text-center home">Assign a Form Number</h2>
        </div>
        <table class="table-home table-hover stripe" id="ReceivingPaidTable" style="width: 100%" data-order=''>
            <thead>
                <tr>
                    <th scope="col">Reservation Number</th>
                    <th scope="col">Form Group Number</th>
                    <th scope="col">Date</th>
                    {{-- <th scope="col">Time Start</th>
                    <th scope="col">Time End</th> --}}
                    <th scope="col">Occupant Type</th>
                    <th scope="col">Total Price</th>
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
                    <td>{{ $gym->occupant_type }}</td>
                    <td>{{ $gym->total_price }}</td>
                    <td class="{{ 
                        $gym->status === 'Pending' ? 'status-pending' : (
                        $gym->status === 'Received/For Payment' ? 'status-received' : (
                        $gym->status === 'Reserved' ? 'status-paid' : (
                        $gym->status === 'Cancelled/Unavailable' ? 'status-cancelled' : '')))
                    }}">{{ $gym->status }}</td>
                    <td class="buttons">
                        @if (!$gym->reservation_number)
                        <a href="{{ route('receiving.addFormNumberPaid', $gym->id) }}" class="btn btn-assign-number rounded-pill" id="receivingAssignNumberbtn">
                            Assign Number
                        </a>
                        @endif
                      
                        <a href="{{ route('receiving.viewGym', $gym->id) }}" class="btn btn-view-details rounded-pill" id="receivingViewFormbtn">
                            View Details
                        </a>
                        <a href="{{ route('receiving.viewPDF', $gym->id) }}" target="_blank" class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn">
                            Generate PDF(GRF)
                        </a>
                        <a href="{{ route('receiving.viewPDFOoP', $gym->id) }}" target="_blank" class="btn btn-generate-pdf rounded-pill" id="receivingViewFormbtn">
                            Generate PDF(OoP)
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
