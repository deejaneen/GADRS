@extends('layout.weblayout')
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const gymToggleBtn = document.getElementById('gymTableHistoryToggleBtn');
            const dormToggleBtn = document.getElementById('dormTableHistoryToggleBtn');
            const gymCard = document.getElementById('GymReservationsHistoryTableCard');
            const dormCard = document.getElementById('DormReservationsHistoryTableCard');

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

@section('profileview')
    <div class="profileview-container">
        @include('profile.leftcolumn_sidebar')
        <div class="right-column reservation">
            <div class="recent-orders">
                <h2>Recent Orders</h2>
                {{-- <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Number</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fdhsajkdakdh</td>
                        <td>Adska</td>
                        <td>Due</td>
                        <td class="warning">Pending</td>
                        <td class="warning-orange">Details</td>
                    </tr>

                </tbody>
            </table> --}}
                <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="gymTableHistoryToggleBtn"> <span
                        class="fa-solid fa-repeat"> Dorm</button>
                <button class="btn btn-primary btn-lg rounded-pill toogle-btn" id="dormTableHistoryToggleBtn"
                    style="display: none;">
                    <span class="fa-solid fa-repeat"> Gym</button>
                <div class="card" id="GymReservationsHistoryTableCard">
                    <div>
                        <h4 class="card-header text-center home">GYM</h4>
                    </div>
                    <table class="table-home table-hover" id="GymReservationsTableHistory" style="width: 100%">
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
                                    <td>{{ $gym->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card" style="display: none" id="DormReservationsHistoryTableCard">
                    <div>
                        <h4 class="card-header text-center home">DORM</h4>
                    </div>
                    <table class="table-home table-hover" id="DormReservationsTableHistory" style="width: 100%">
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
                                    <td>{{ $dorm->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="#">Show All</a>
            </div>
        </div>

    </div>
@endsection
