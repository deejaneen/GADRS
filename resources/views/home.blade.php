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
                        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="gymTableToggleBtn"> <span
                                class="fa-solid fa-repeat"> Dorm</button>
                        <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="dormTableToggleBtn"
                            style="display: none;"> <span class="fa-solid fa-repeat"> Gym</button>
                    </li>
                    <div class="card" id="GymReservationsTableCard">
                        <div>
                            <h4 class="card-header text-center home">GYM</h4>
                        </div>
                        <table class="table-home table-hover" id="GymReservationsTable" >
                            <thead>
                                <tr>
                                    <th scope="col">Reservation Number</th>
                                    <th scope="col">Reservation Date</th>
                                    <th scope="col">Time Start</th>
                                    <th scope="col">Time End</th>
                                    <th scope="col">Purpose</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
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
                                        <td>₱{{ $gym->price }}</td>
                                        <td class="
                                        @if ($gym->status == 'Pending')
                                            status-pending
                                        @elseif ($gym->status == 'Received' )
                                            status-received-for-payment
                                        @elseif ($gym->status == 'Paid' || $gym->status == 'Reserved')
                                            status-paid-reserved
                                        @elseif ($gym->status == 'Cancelled' || $gym->status == 'Unavailable')
                                            status-cancelled
                                        @endif
                                        ">{{ $gym->status }}</td>                                    
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
                                    <th scope="col">Time Start</th>
                                    <th scope="col">Reservation End Date</th>
                                    <th scope="col">Time End</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dorms as $dorm)
                                    <tr class="table-active">
                                        <th>{{ $dorm->Form_number }}</th>
                                        <td>{{ date('F j, Y', strtotime($dorm->reservation_start_date)) }}</td>
                                        <td>{{ date('g:i A', strtotime($dorm->reservation_start_time)) }}</td>
                                        <td>{{ date('F j, Y', strtotime($dorm->reservation_end_date)) }}</td>
                                        <td>{{ date('g:i A', strtotime($dorm->reservation_end_time)) }}</td>
                                        <td>₱{{ $dorm->price }}</td>
                                        <td class="
                                        @if ($dorm->status == 'Pending')
                                            status-pending
                                        @elseif ($dorm->status == 'Received' )
                                            status-received-for-payment
                                        @elseif ($dorm->status == 'Paid' || $dorm->status == 'Reserved')
                                            status-paid-reserved
                                        @elseif ($dorm->status == 'Cancelled' || $gym->status == 'Unavailable')
                                            status-cancelled
                                        @endif
                                        ">{{ $dorm->status }}</td>               
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
        });
    </script>
@endsection
