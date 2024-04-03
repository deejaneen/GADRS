@extends('layout.weblayout')

@section('banner')
    <div class="container">
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
                    </li>
                    <table class="table-home table-hover" id="myTable">
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
                                    <td>{{ $gym->reservation_date }}</td>
                                    <td>{{ $gym->reservation_time_start }}</td>
                                    <td>{{ $gym->reservation_time_end }}</td>
                                    <td>{{ $gym->purpose }}</td>
                                    <td>₱{{ $gym->price }}</td>
                                    <td>{{ $gym->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
