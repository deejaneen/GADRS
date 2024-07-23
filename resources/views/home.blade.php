@extends('layout.weblayout')

@section('banner')
<div class="container" id="contentcontainer">
    {{-- <div class="row login-success">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
</div> --}}

<div class="row-top">
    <div class="welcome-section">
        <div class="welcome-title1">
            <h3>WELCOME TO</h3>
        </div>
        <div class="welcome-title2">
            <h1>GYM AND DORM <span style="color: var(--color-warning)">RESERVATION SYSTEM</span></h1>
        </div>
        <div class="welcome-name">
            <h3>Hi <span style="color: var(--color-orange)">{{ Auth::user()->first_name }}</span></h3>
        </div>
    </div>

    <div class="column-bar"></div>
    <div class="column-left-top">
    </div>
    <div class="column-left-bottom">
    </div>
    <div class="column-right-top">


    </div>
    <div class="column-right-bottom">
    </div>
</div>

<div class="row-bottom">
    <div class="column-bottom">

        <ul class="home-reservation-table">
            <li class="reservation-table-home">
                <h1><i class="ri-key-2-fill"></i> MY RESERVATIONS<i class="ri-receipt-fill"></i></h1>
                <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="gymTableToggleBtn"> <span class="fa-solid fa-repeat"> Dorm</button>
                <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="dormTableToggleBtn" style="display: none;"> <span class="fa-solid fa-repeat"> Gym</button>
            </li>
            <div class="card" id="GymReservationsTableCard">
                <div>
                    <h4 class="card-header text-center home">GYM</h4>
                </div>
                <table class="table-home table-hover" id="GymReservationsTable">
                    <thead>
                        <tr>
                            <th scope="col">Reservation Number</th>
                            <th scope="col">Reservation Date</th>
                            <th scope="col">Time Start</th>
                            <th scope="col">Time End</th>
                            <th scope="col">Purpose</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gyms as $gym)
                        <tr class="table-active">
                            <th>{{ $gym->reservation_number }}</th>
                            <td>{{ date('F j, Y', strtotime($gym->reservation_date)) }}</td>
                            <td>{{ date('g:i A', strtotime($gym->reservation_time_start)) }}</td>
                            <td>{{ date('g:i A', strtotime($gym->reservation_time_end)) }}</td>
                            <td>{{ $gym->purpose }}</td>
                            <td>₱{{ $gym->total_price }}</td>
                            <td class="{{ $gym->status === 'Pending'
                                                ? 'status-pending'
                                                : ($gym->status === 'Received' || $gym->status === 'For Payment'
                                                    ? 'status-received'
                                                    : ($gym->status === 'Paid' || $gym->status === 'Reserved'
                                                        ? 'status-paid'
                                                        : ($gym->status === 'Cancelled' || $gym->status === 'Unavailable'
                                                            ? 'status-cancelled'
                                                            : ''))) }}">
                                {{ $gym->status }}
                            </td>
                            <td class="actions-home">
                                <form class="delete-form-gym" id="guestGymIdDelete_{{ $gym->id }}" method="POST" action="{{ route('gym.delete', $gym->id) }}">
                                    @csrf
                                    @method('delete')
                                    @if ($gym->status === 'Pending')
                                    <a href="{{ route('gym.edit', $gym->id) }}" class="btn btn-edit-reservation-details rounded-pill" id="gymHomeTableEditButton">
                                        Edit Details
                                    </a>
                                    <button type="button" class="btn btn-delete-reservation rounded-pill" id="gymHomeTableDeleteButton" onclick="confirmDelete(event, {{ $gym->id }})">
                                        Delete Reservation
                                    </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card" style="display: none" id="DormReservationsTableCard">
                <div>
                    <h4 class="card-header text-center home">DORM</h4>
                </div>
                <table class="table-home table-hover" id="DormReservationsTable">
                    <thead>
                        <tr>
                            <th scope="col">Form Number</th>
                            <th scope="col">Reservation Start Date</th>
                            <th scope="col">Reservation End Date</th>
                            <th scope="col">Time Start</th>
                            <th scope="col">Time End</th>
                            <th scope="col">Total Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dorms as $dorm)
                        <tr class="table-active">
                            <th>{{ $dorm->Form_number }}</th>
                            <td>{{ date('F j, Y', strtotime($dorm->reservation_start_date)) }}</td>
                            <td>{{ date('F j, Y', strtotime($dorm->reservation_end_date)) }}</td>
                            <td>{{ date('g:i A', strtotime($dorm->reservation_start_time)) }}</td>
                            <td>{{ date('g:i A', strtotime($dorm->reservation_end_time)) }}</td>
                            <td>₱{{ $dorm->total_price }}</td>
                            <td class="{{ $dorm->status === 'Pending'
                                                ? 'status-pending'
                                                : ($dorm->status === 'Received' || $dorm->status === 'For Payment'
                                                    ? 'status-received'
                                                    : ($dorm->status === 'Paid' || $dorm->status === 'Reserved'
                                                        ? 'status-paid'
                                                        : ($dorm->status === 'Cancelled' || $dorm->status === 'Unavailable'
                                                            ? 'status-cancelled'
                                                            : ''))) }}">
                                {{ $dorm->status }}
                            </td>
                            <td class="actions-home">
                                <form class="delete-form-dorm" id="guestDormIdDelete_{{ $dorm->id }}" method="POST" action="{{ route('dorm.delete', $dorm->id) }}">
                                    @csrf
                                    @method('delete')
                                    @if ($dorm->status === 'Pending')
                                    <a href="{{ route('dorm.edit', $dorm->id) }}" class="btn btn-edit-reservation-details rounded-pill" id="dormHomeTableEditButton">
                                        Edit Details
                                    </a>
                                    <button type="button" class="btn btn-delete-reservation rounded-pill" id="dormHomeTableDeleteButton" onclick="confirmDelete(event, {{ $dorm->id }})">
                                        Delete Reservation
                                    </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>



        </ul>
    </div>
</div>
{{-- <div class="row">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
</div> --}}
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const gymToggleBtn = document.getElementById('gymTableToggleBtn');
        const dormToggleBtn = document.getElementById('dormTableToggleBtn');
        const gymCard = document.getElementById('GymReservationsTableCard');
        const dormCard = document.getElementById('DormReservationsTableCard');

        gymToggleBtn.addEventListener('click', function() {
            gymCard.style.display = 'block';
            dormCard.style.display = 'none';
            gymToggleBtn.style.display = 'none';
            dormToggleBtn.style.display = 'block';
        });

        dormToggleBtn.addEventListener('click', function() {
            dormCard.style.display = 'block';
            gymCard.style.display = 'none';
            dormToggleBtn.style.display = 'none';
            gymToggleBtn.style.display = 'block';

        });

        //To make sure the user returns to the right card after updating records
        // Ensure $card is defined and holds the correct value
        var $card = '{{ session("card") }}';

        if ($card == "dorm") {
            dormCard.style.display = 'block';
            gymCard.style.display = 'none';
            gymToggleBtn.style.display = 'none';
            dormToggleBtn.style.display = 'block';

        }
    });

    function confirmDelete(event, id) {
        event.preventDefault(); // Prevent default form submission

        // Show confirmation dialog
        Swal.fire({
            title: "Are you sure you want to delete this item?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
            customClass: {
                popup: 'small-modal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the delete form associated with the clicked button
                const form = document.getElementById(`guestGymIdDelete_${id}`) || document.getElementById(
                    `guestDormIdDelete_${id}`);
                if (form) {
                    form.submit();
                }
            }
        });
    }
</script>
@endsection